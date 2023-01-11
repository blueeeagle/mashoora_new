<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Wallet;
use App\Models\Payment;
use App\Models\AppointmentLog;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;

//JOB
use App\Jobs\ConsultantCancelJob;
use App\Jobs\ConsultantCompletdJob;
use App\Jobs\CustomerCancelAppAGJob;
use App\Jobs\CustomerCancelAppBGJob;
use App\Jobs\NoShowAppJob;
use App\Jobs\ConsultantAcceptAppJob;
use App\Jobs\ConsultantRejectAppJob;

class AppointmentController extends Controller
{

   public function index(){
        return view('history.appointment.index');
    }

    public function datatable(Request $request){
        if($request->searchTable == 'pending') $datas = Appointment::with('customer','consultant')->where('status','Pending')->orderBy('id','desc')->get();
        if($request->searchTable == 'booked') $datas = Appointment::with('customer','consultant')->where('status','Confirmed')->orderBy('id','desc')->get();
        if($request->searchTable == 'cancelled') $datas = Appointment::with('customer','consultant')->where('status','Cancelled')->orderBy('id','desc')->get();
        if($request->searchTable == 'noShow') $datas = Appointment::with('customer','consultant')->whereIn('status',['NoShowByCustomer','NoShowByConsultant'])->orderBy('id','desc')->get();
        if($request->searchTable == 'completed') $datas = Appointment::with('customer','consultant')->where('status','Completed')->orderBy('id','desc')->get();
        
        return  DataTables::of($datas)
        ->editColumn('customer_id', function(Appointment $datas) {
            $datas->booking;
            if(isset($datas->customer)) $datas->customer->country;
            return $datas->customer;
        })
        ->addColumn('consultant_id', function(Appointment $datas) {
            return $datas->booking->consultant;
        })
        ->editColumn('status', function(Appointment $datas) {
            return $datas->status;
        })
        ->addColumn('cus_date_slot', function(Appointment $datas){
            if(!isset($datas->booking)) return [];
            $date = date_create($datas->appointment_date);
            $Time = date_format($date,"h:i a")." - ". date("h:i a",strtotime(date_format($date,"Y-m-d H:i")) + $datas->booking->consultant->preferre_slot*60);
            return ['Date'=>date_format($date,"M d,Y,l"),'Time'=>$Time,'Amount'=>$datas->booking->customercurrnecy->currencycode.' ' .number_format($datas->booking->amount,2)];
        })
        ->addColumn('cons_date_slot', function(Appointment $datas){
            if(!isset($datas->booking)) return [];
            $date = strtotime($datas->appointment_date) - ($datas->booking->diff);
            $date = date("Y-m-d H:i",$date);
            $date = date_create($date);
            $Time = date_format($date,"h:i a")." - ". date("h:i a",strtotime(date_format($date,"Y-m-d H:i")) + $datas->booking->consultant->preferre_slot*60);
            return ['Date'=>date_format($date,"M d,Y,l"),'Time'=>$Time,'Amount'=>$datas->booking->consultantcurrency->currencycode.' '.number_format(($datas->booking->amount/$datas->booking->customercurrnecy->price)*$datas->booking->consultantcurrency->price,2)];
        })
        ->addColumn('customer_currency', function(Appointment $datas){
            return $datas->booking->customercurrnecy;
        })
        ->addColumn('customer_currency', function(Appointment $datas){
            return $datas->booking->consultantcurrency;
        })
        ->addColumn('action', function(Appointment $datas){
            return '';
        })
        ->addColumn('amount', function(Appointment $datas){
            return $amount=0;
        })
        ->toJson();
    }

    public function view(Request $request)
    { 
        $appointment = Appointment::with('customer','consultant','insurance')->where('id',$request->id)->first();
       $AppointmentLog = AppointmentLog::where('appointment_id',$request->id)->get();

        $data = DataTables::of($AppointmentLog)
        ->addColumn('appointment_id', function(AppointmentLog $datas) {
            return 'BK-'.$datas->appointment_id;
        })
        ->addColumn('created_at', function(AppointmentLog $datas) {
            return date('Y-m-d h:i a',\strtotime($datas->created_at));
        })
        ->toJson();
      
         $customerTimeZone ='';
         $consultantTimeZone ='';
        // Consultant time
        $date = strtotime($appointment->appointment_date) - ($appointment->booking->diff);
        $date = date("Y-m-d H:i",$date);
        $date = date_create($date);
        $con_date_model = date_format($date,"M d,Y,l");
        
        // customer time
        $cus_date = date_create($appointment->appointment_date);
        $cus_date_model = date_format($cus_date,"M d,Y,l");
        
        $conAmount = $appointment->booking->consultantcurrency->currencycode.' '.number_format(($appointment->booking->amount/$appointment->booking->customercurrnecy->price)*$appointment->booking->consultantcurrency->price,2);
        $cusAmount = $appointment->booking->customercurrnecy->currencycode.' ' .number_format($appointment->booking->amount,2);
        
        if(isset($appointment->customer)){
            $customerTimeZone = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $appointment->customer->country_code);
        }
        
        $consultantTimeZone = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $appointment->booking->consultant->country_code);
        $consultantTime = date_format($date,"h:i a")." - ". date("h:i a",strtotime(date_format($date,"Y-m-d H:i")) + $appointment->booking->consultant->preferre_slot*60);
        $customerTime = date_format($cus_date,"h:i a")." - ". date("h:i a",strtotime(date_format($cus_date,"Y-m-d H:i")) + $appointment->booking->consultant->preferre_slot*60);
        
        $appointment['conAmount']= $conAmount;
        $appointment['cusAmount']= $cusAmount;
        $appointment['consultantTimeZone']= $customerTimeZone;
        $appointment['consultantTimeZone']= $consultantTimeZone;
        $appointment['consultantTime']= $consultantTime;
        $appointment['customerTime']= $customerTime;
        $appointment['customerDate']= $cus_date_model;
        $appointment['consultantDate']= $con_date_model;
        
        
        // dd($customerTime);
        unset($appointment->rawdata);
        return response()->json(['status'=>true,'App_data'=>$appointment,'App_log'=>$data]);
    }

    public function status(Request $request){
        // dd($request);
      if($request->status == 'Confirmed'){
        $approval = Appointment::whereIn('id',$request->id)->get();
        foreach ($approval as $key => $value) {
            $value->status = 'Confirmed';
            $value->update();
            $this->dispatch(new ConsultantAcceptAppJob($value));
        }
        return response()->json(['status'=>true,'msg'=>'Status Changed']);
      }
      if($request->status == 'Reject'){
        $approval = Appointment::whereIn('id',$request->id)->get();
        foreach ($approval as $key => $value) {
            $value->status = 'Cancelled';
            $value->update();
            $this->dispatch(new ConsultantRejectAppJob($value));
        }
        return response()->json(['status'=>true,'msg'=>'Status Changed']);
      }

      if($request->status == 'Completed'){
        $approval = Appointment::whereIn('id',$request->id)->get();
        foreach ($approval as $key => $value) {
            # code...
            if($value->status != 'Cancelled' && $value->status != 'Completed') {
                $value->status = 'Completed';
                if(empty($value->insurance_id)){ $value->pay_in = 1; }
                $value->update();
                $this->dispatch(new ConsultantCompletdJob($value));
            }
        }
        return response()->json(['status'=>true,'msg'=>'Status Changed']);
      }

      if($request->status == 'Cancelled_by_customer'){
        $approval = Appointment::whereIn('id',$request->id)->get();
        foreach ($approval as $key => $value) {
            # code...
            if($value->status != 'Cancelled' && $value->status != 'Completed') {
                $Booking = unserialize(bzdecompress(utf8_decode($value->rawdata)));
                date_default_timezone_set($Booking->customerTimeZone);
                $Booking->cancellconsultant = ['status'=> true,'msg'=>'Appointment have be cancelled sucessfully','now'=> date("Y-m-d H:i")];
                $countdown = strtotime($value->appointment_date) - strtotime('now');
                $Companysetting = $Booking->Companysetting;
                $value->status = 'Cancelled';
                $value->cancell_customer = $value->customer_id;
                $value->update();

                if($countdown > $this->strtotimeconvert($Companysetting->discard_cut_off_time)){
                    $wallet = Wallet::where('customer_id',$value->customer_id)->first();
                    $Amount = $Booking->amount;
                    $value->pay_in = 5;
                    $value->update();
                    $this->dispatch(new CustomerCancelAppAGJob($value));
                    if(!$value->insurance_id) $this->addsubammountcustomer($Amount,'add','Refund',$wallet,$value->id);
                }else{
                    $value->pay_in = 1;
                    $value->update();
                    $this->dispatch(new CustomerCancelAppBGJob($value));
                }
            }
        }
        return response()->json(['status'=>true,'msg'=>'Status Changed']);
      }

      if($request->status == 'Cancelled_by_consultant'){
        $approval = Appointment::whereIn('id',$request->id)->get();
        foreach ($approval as $key => $value) {
            # code...
            if($value->status != 'Cancelled' && $value->status != 'Completed') {

                $Booking =  unserialize(bzdecompress(utf8_decode($value->rawdata)));
                date_default_timezone_set($Booking->consultantTimeZone);
                $Booking->cancellconsultant = ['status'=> true,'msg'=>'Appointment have be cancelled sucessfully','now'=> date("Y-m-d H:i")];
                $value->rawdata = utf8_encode(bzcompress(serialize($Booking), 9));
                $value->status = 'Cancelled';
                $value->pay_in = 4;
                $value->cancell_consultant = $value->consultant_id;
                $value->update();
                $this->dispatch(new ConsultantCancelJob($value));
                $wallet = Wallet::where('customer_id',$value->customer_id)->first();
                if($wallet){
                    $Amount = $Booking->amount;
                    if(!$value->insurance_id) $this->addsubammountcustomer($Amount,'add','Refund',$wallet,$value->id);
                }
            }
        }
        return response()->json(['status'=>true,'msg'=>'Status Changed']);
      }

      if($request->status == 'NoShowByConsultant'){
        $approval = Appointment::whereIn('id',$request->id)->get();
        foreach ($approval as $key => $value) {
            # code...
            if($value->status != 'Cancelled' && $value->status != 'Completed') {
                $value->status = 'NoShowByConsultant';
                $value->pay_in = 4;
                $value->update();
                $this->dispatch(new NoShowAppJob($value));
                $wallet = Wallet::where('customer_id',$value->customer_id)->first();
                if($wallet){
                    $Booking =  unserialize(bzdecompress(utf8_decode($value->rawdata)));
                    $Amount = $Booking->amount;
                    if(!$value->insurance_id) $this->addsubammountcustomer($Amount,'add','Refund',$wallet,$value->id);
                }
            }
        }
        return response()->json(['status'=>true,'msg'=>'Status Changed']);
      }

      if($request->status == 'NoShowByCustomer'){
        $approval = Appointment::whereIn('id',$request->id)->get();
        foreach ($approval as $key => $value) {
            # code...
            if($value->status != 'Cancelled' && $value->status != 'Completed') {
                $value->status = 'NoShowByCustomer';
                $value->pay_in = 1;
                $value->update();
                $this->dispatch(new NoShowAppJob($value));
            }
        }
        return response()->json(['status'=>true,'msg'=>'Status Changed']);
      }

    }

    function addsubammount($amount,$type,$action,$Wallet,$appointment){
        $Payment = new Payment;
        $Payment->amount = $amount;
        $Payment->type = $type;
        $Payment->action = $action;
        $Payment->consultant_id = $Wallet->consultant_id;
        $Payment->appointment_id = $appointment;
        $Payment->save();

        if($type == 'add') $Wallet->balance = $Wallet->balance + $amount;
        else $Wallet->balance = $Wallet->balance - $amount;
        $Wallet->update();

        return $Payment;
    }

    function addsubammountcustomer($amount,$type,$action,$Wallet,$appointment_id){

        $Payment = new Payment;
        $Payment->amount = $amount;
        $Payment->type = $type;
        $Payment->action = $action;
        $Payment->customer_id = $Wallet->customer_id;
        $Payment->appointment_id = $appointment_id;
        $Payment->save();

        if($type == 'add') $Wallet->balance = $Wallet->balance + $amount;
        else $Wallet->balance = $Wallet->balance - $amount;
        $Wallet->update();

        return $Payment;
    }

    function strtotimeconvert($data){
        $data = \explode(':',$data);
        return ($data[0]*60*60) + ($data[1]*60);
    }
}


