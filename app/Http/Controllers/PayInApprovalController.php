<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\PayApproval;
use App\Models\OfferPurchase;
use App\Models\Wallet;
use App\Models\Payment;
use App\Models\Adminpayment;
use Auth;
use Validator;
use DataTables;
use DB;
use App\Jobs\PayinApproveJob;
use App\Jobs\PayinDeclineJob;

class PayInApprovalController extends Controller
{

    public function __construct()
    {
        // $this->middleware('Permissions:Consultant_Approval_View',['only'=>['index']]);

    }
    public function offerDatatable(Request $request){
        $datas = OfferPurchase::with('customer','consultant')->where('pay_in',1)->orderBy('id','desc')->get();
        if($request->searchTable == 'Approved') $datas = OfferPurchase::with('customer','consultant')->where('pay_in',2)->orderBy('id','desc')->get();
        if($request->searchTable == 'Decline') $datas = OfferPurchase::with('customer','consultant')->where('pay_in',3)->orderBy('id','desc')->get();

        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('customer_id', function(OfferPurchase $datas) {
            if(isset($datas->customer)) $datas->customer->country;
            return $datas->customer;
        })
        ->addColumn('consultant_id', function(OfferPurchase $datas) {
            return $datas->offer->consultant;
        })
        ->addColumn('cus_amount', function(OfferPurchase $datas){
            $admin_amount = $datas->amount/$datas->offer->consultant_currency->price;
            return ['customer_currency'=>$datas->offer->customer_currency,'customer_amount'=>$datas->offer->amount_converted,
            'admin_currency'=>$datas->offer->admincurrnecy,'admin_amount'=>$admin_amount];
        })
        ->addColumn('consultant_amount', function(OfferPurchase $datas){
           
            $ComissionAmount = empty($datas->offer->consultant->com_off_amount) || $datas->offer->consultant->com_off_amount == NULL?'Consultant Offer Not Added':$datas->offer->consultant_currency->currencycode."  ".$this->calcomamount($datas->offer->consultant->com_off_type,$datas->offer->amount,$datas->offer->consultant->com_off_amount);
            $admin_amount = empty($datas->offer->consultant->com_off_amount) || $datas->offer->consultant->com_off_amount == NULL ?'Consultant Offer Not Added':$datas->offer->admincurrnecy->currencycode." ".($this->calcomamount($datas->offer->consultant->com_off_type,$datas->offer->amount,$datas->offer->consultant->com_off_amount))/$datas->offer->consultant_currency->price;
            return ['consultant_currenct'=>$datas->offer->consultant_currency,'consultant_amount'=>$datas->offer->amount,'ComissionAmount'=>$ComissionAmount,
            'admin_currency'=>$datas->offer->admincurrnecy,'admin_comission'=>$admin_amount];
        })
        ->addColumn('checkofferfee', function($datas){
            return $datas->offer->consultant->checkofferfee();
        })
        ->addColumn('action', function($datas){
            return $datas->offer->consultant->checkofferfee();
        })
        ->toJson();
    }
    
	public function datatables(Request $request){

        if($request->searchTable == 'Approved') $datas =  Appointment::with('consultant','customer','transaction')->where('pay_in',2)->orderBy('id','desc')->get();
        else if($request->searchTable == 'Decline') $datas = Appointment::with('consultant','customer','transaction')->where('pay_in',3)->orderBy('id','desc')->get();
        else $datas =  Appointment::with('consultant','customer','transaction')->where('pay_in',1)->orderBy('id','desc')->get();

        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('customer_id', function(Appointment $datas) {
            $datas->booking;
            if(isset($datas->customer)) $datas->customer->country;
            return $datas->customer;
        })
        ->addColumn('consultant_id', function(Appointment $datas) {
            return $datas->booking->consultant;
        })
        ->addColumn('cus_date_slot', function(Appointment $datas){

            if(!isset($datas->booking)) return [];
            $date = date_create($datas->appointment_date);
            $Time = date_format($date,"h:i a")." - ". date("h:i a",strtotime(date_format($date,"Y-m-d H:i")) + $datas->booking->consultant->preferre_slot*60);
            $Admin_amount = ($datas->booking->amount/$datas->booking->customercurrnecy->price);
            return ['Date'=>date_format($date,"M d,Y,l"),'Time'=>$Time,'Amount'=>$datas->booking->customercurrnecy->currencycode.' ' .number_format($datas->booking->amount,2),'Admin_currency'=>$datas->booking->Companysetting->country->currency->currencycode,'Admin_amount'=>$Admin_amount];

        })
        ->addColumn('cons_date_slot', function(Appointment $datas){
            if(!isset($datas->booking)) return [];
            $date = strtotime($datas->appointment_date) - ($datas->booking->diff);
            $date = date("Y-m-d H:i",$date);
            $date = date_create($date);
           
            $Time = date_format($date,"h:i a")." - ". date("h:i a",strtotime(date_format($date,"Y-m-d H:i")) + $datas->booking->consultant->preferre_slot*60);
            $consultantAmount = ($datas->booking->amount/$datas->booking->customercurrnecy->price)*$datas->booking->consultantcurrency->price;
            $ComissionAmount = empty($datas->booking->consultant->com_con_amount) || $datas->booking->consultant->com_con_amount == NULL?'Consultant Fee Not Added':$this->calcomamount($datas->booking->consultant->com_con_type,$consultantAmount,$datas->booking->consultant->com_con_amount);

            $Admin_amount = ($datas->booking->amount/$datas->booking->customercurrnecy->price);
            return ['Admin_currency'=>$datas->booking->Companysetting->country->currency->currencycode,'Admin_amount'=>$Admin_amount,'Date'=>date_format($date,"M d,Y,l"),'Time'=>$Time,'Amount'=>$datas->booking->consultantcurrency->currencycode.' '.number_format($consultantAmount,2),'ComissionAmount'=>$datas->booking->consultantcurrency->currencycode.' '.$ComissionAmount];
        })
        ->addColumn('checkcomfee', function($datas){ 
            return $datas->consultant->checkcomfee();
        })
        ->addColumn('pay_in_status', function($datas){
        
            if($datas->pay_in == 2){
            return $temp = "<span class='badge badge-success'>Approved</span>";
            }
            if($datas->pay_in == 3){
                return  $temp = "<span class='badge badge-danger'>Decline</span>";
            }
            return "<span class='badge badge-primary'>Pending</span>";
        })     
      
        ->addColumn('action',function($datas){
            return [];
        })
        ->rawColumns(['pay_in_status','cons_date_slot','cus_date_slot'])
        ->toJson(); //--- Returning Json Data To Client Side
    }


	public function index(){
		return view('approval.pay_approvals.pay_in');
	}

    function GETComm_Amount($consultant,$customercurrnecy,$consultantcurrency,$amount){
        if($consultant->com_con_type == 0){
            $comm_Amount =  ($consultant->com_con_amount/$consultantcurrency->price)*$customercurrnecy->price;
            return (($amount - $comm_Amount)/$customercurrnecy->price)*$consultantcurrency->price;
        }else{
            $comm_Amount = ($amount/100)*$consultant->com_con_amount;
            return (($amount - $comm_Amount)/$customercurrnecy->price)*$consultantcurrency->price;
        }
        //log
    }

    public function offstatus(Request $request){
        $OfferPurchase = OfferPurchase::whereIn('id',$request->id)->get();

        if($request->status == 'Approve'){
            foreach ($OfferPurchase as $key => $value) {
                # code...
                if($value->pay_in ==  1) {
                    try {
                        $offer = $value->offer;
                        $consultant = $offer->consultant;
                        if(!$consultant->checkcomfee()) continue;
                        $value->pay_in = 2;
                        $value->update();
                        $wallet = wallet::where('consultant_id',$value->consultant_id)->first();
                        $amount = $value->offer->amount - $this->calcomamount($value->offer->consultant->com_off_type,$value->offer->amount,$value->offer->consultant->com_off_amount);
                        $this->addsubammountconsultant($amount,'add','Offer purchase',$wallet,'');
                        
                        $rawoffer = unserialize(bzdecompress(utf8_decode($value->rawoffer)));
                        $base_amount = $amount;
                        $com = $this->calcomamount($value->offer->consultant->com_off_type,$value->offer->amount,$value->offer->consultant->com_off_amount);
                        $Adminpayment = new Adminpayment;
                        $Adminpayment->type = 'sub';
                        $Adminpayment->offerpurchase_id = $value->id;
                        $Adminpayment->base_amount = $base_amount;
                        $Adminpayment->base_amount_currenct = json_encode($rawoffer->consultant_currency);
                        $Adminpayment->amount = $base_amount/$rawoffer->consultant_currency->price;
                        $Adminpayment->consultant_id = $consultant->id;
                        $Adminpayment->customer_id = $value->customer_id;
                        $Adminpayment->com_amount = $com/$rawoffer->consultant_currency->price;
                        $Adminpayment->action = 'Offer purchase';
                        $Adminpayment->save();

                        $Wallet = Wallet::where('id',0)->first();
                        $Wallet->balance = $Wallet->balance - ($base_amount/$rawoffer->consultant_currency->price);
                        // $Wallet->update();
                        
                    } catch (\Throwable $th) {
                        //throw $th;
                        $failed[] = $value->id;

                    }
                }
            }
            return response()->json(['status'=>true,'msg'=>'Approved']);
        }
        if($request->status == 'Decline'){
            foreach ($OfferPurchase as $key => $value) {
                # code...
                if($value->pay_in ==  1) {
                    try {
                        $value->pay_in = 3;
                        $value->update();
                        $wallet = Wallet::where('customer_id',$value->customer_id)->first();
                        $this->addsubammountconsultantcustomer($value->offer->amount_converted,'add','Offer Refumd',$wallet,'');

                    } catch (\Throwable $th) {
                        //throw $th;
                        $failed[] = $value->id;

                    }
                }
            }
            return response()->json(['status'=>true,'msg'=>'Decline']);
        }
    }

	public function status(Request $request){
         
        $approval = Appointment::whereIn('id',$request->id)->get();
        $failed = [];
        
        if($request->status == 'Approve'){
            foreach ($approval as $key => $value) {
                # code...
                if($value->pay_in ==  1) {
                    try {
                        $Booking = unserialize(bzdecompress(utf8_decode($value->rawdata)));
                        
                        $consultant = $Booking->consultant;
                        if(!$consultant->checkcomfee()) continue;
                        $Amount = $this->GETComm_Amount($consultant,$Booking->customercurrnecy,$Booking->consultantcurrency,$Booking->amount);
                        $value->pay_in = 2;                
                        $value->update();
                        $this->dispatch(new PayinApproveJob($value));
                        $wallet = wallet::where('consultant_id',$value->consultant_id)->first();
                        $this->addsubammountconsultant($Amount,'add','Pay In',$wallet,$value->id);
                        $base_amount = ($Booking->amount/$Booking->customercurrnecy->price)*$Booking->consultantcurrency->price;
                        
                        $com = $base_amount - $Amount;
                        $Adminpayment = new Adminpayment;
                        $Adminpayment->type = 'sub';
                        $Adminpayment->appointment_id = $value->id;
                        $Adminpayment->base_amount = $Amount;
                        $Adminpayment->base_amount_currenct = json_encode($Booking->consultantcurrency);
                        $Adminpayment->amount = $Amount/$Booking->consultantcurrency->price;
                        $Adminpayment->consultant_id = $consultant->id;
                        $Adminpayment->com_amount = $com/$Booking->consultantcurrency->price;
                        $Adminpayment->action = 'Booking Complete';
                        $Adminpayment->customer_id = $value->customer_id;
                        $Adminpayment->save();
                        
                        
                        $Wallet = Wallet::where('id',0)->first();
                        $Wallet->balance = $Wallet->balance - ($Amount/$Booking->consultantcurrency->price);
                        $Wallet->update();
                       
                    } catch (\Throwable $th) {
                        //throw $th;
                        $failed[] = $value->id;
                       
                    }                
                }
            }
            return response()->json(['status'=>true,'msg'=>'Approved']);
        }else{
            foreach ($approval as $key => $value) {
                # code...
                if($value->pay_in ==  1) {
                    try {
                        $Booking = unserialize(bzdecompress(utf8_decode($value->rawdata)));
                        
                        $Amount = $Booking->amount;
                        $value->pay_in = 3;
                        $value->update();
                        $this->dispatch(new PayinDeclineJob($value));
                        $wallet = Wallet::where('customer_id',$value->customer_id)->first();
                        $this->addsubammountconsultantcustomer($Amount,'add','Refund',$wallet,$value->id);


                    } catch (\Throwable $th) {
                        //throw $th;
                        $failed[] = $value->id;

                    }
                }
            }
            return response()->json(['status'=>true,'msg'=>'Decline']);
        }
    }

    function addsubammountconsultantcustomer($amount,$type,$action,$Wallet,$appointment_id){

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

    function addsubammountconsultant($amount,$type,$action,$Wallet,$appointment_id){
        
        $Payment = new Payment;
        $Payment->amount = $amount;
        $Payment->type = $type;
        $Payment->action = $action;
        $Payment->consultant_id = $Wallet->consultant_id;
        $Payment->appointment_id = $appointment_id;
        $Payment->save();

        // dd($Payment);
        if($type == 'add') $Wallet->balance = $Wallet->balance + $amount;
        else $Wallet->balance = $Wallet->balance - $amount;
        $Wallet->update();

        return $Payment;
    }

    public function view(Request $request)
    {
        $appointment = Appointment::with('consultant','customer','transaction','pay_approvals')->where('id',$request->id)->first();

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
       $appointment['ComissionAmount']= empty($appointment->booking->consultant->com_con_amount) || $appointment->booking->consultant->com_con_amount == NULL?'Consultant Fee Not Added':$appointment->booking->consultant->com_con_amount;
       
       
       // dd($customerTime);
       unset($appointment->rawdata);
       return response()->json(['status'=>true,'App_data'=>$appointment]);
    }

    function calcomamount($type,$amount,$com){
        
        if((int)$type == 0) return $com;
        return ((float)$amount/100)*(float)$com;
    }
}
