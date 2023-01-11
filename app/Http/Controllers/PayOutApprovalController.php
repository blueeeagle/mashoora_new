<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\PayApproval;
use App\Models\Payment;
use App\Models\Wallet;

use Auth;
use Validator;
use DataTables;
use DB;
use Carbon\Carbon;

use App\Jobs\ConsultantRejectPayoutJob;
use App\Jobs\ConsultantAcceptPayoutJob;

class PayOutApprovalController extends Controller
{

    public function __construct()
    {
        // $this->middleware('Permissions:Consultant_Approval_View',['only'=>['index']]);

    }

	public function datatables(Request $request){
        $datas = PayApproval::with('consultant')->where('pay_out',1)->orderBy('id','desc')->get();
        if($request->searchTable == 'Approved') $datas = PayApproval::with('consultant')->where('pay_out',2)->orderBy('id','desc')->get();
        if($request->searchTable == 'Decline') $datas = PayApproval::with('consultant')->where('pay_out',3)->orderBy('id','desc')->get();

        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('pay_req_date', function(PayApproval $datas) {
            return  date('Y-m-d',\strtotime($datas->created_at));
        })
        ->addColumn('pay_updated_date', function(PayApproval $datas) {
            $updatedDate = ($datas->updated_date)?date('Y-m-d',\strtotime($datas->updated_date)):'--';
            return  ['Request_date'=>date('Y-m-d',\strtotime($datas->created_at)),'updated'=>$updatedDate];
        })
        ->addColumn('consultant', function(PayApproval $datas) {
            $consultant = unserialize(bzdecompress(utf8_decode($datas->consultantraw)));
            return  $consultant;
        })
        ->addColumn('consultant_amount', function(PayApproval $datas) {
            $consultant = unserialize(bzdecompress(utf8_decode($datas->consultantraw)));
            return  ['amount'=>$consultant->country->currency->currencycode.' '.$datas->amount];
        })
        ->addColumn('admin_amount', function(PayApproval $datas) {
            $consultant = unserialize(bzdecompress(utf8_decode($datas->consultantraw)));
            $amount = $datas->amount/$consultant->admin->country->currency->price;
            return  ['amount'=>$consultant->admin->country->currency->currencycode.' '.$amount];
        })
        ->addColumn('isbank', function(PayApproval $datas) {
            $consultant = unserialize(bzdecompress(utf8_decode($datas->consultantraw)));
            return $datas->consultant->bank_status;
        })
        ->toJson();
    }


	public function index(){
		return view('approval.pay_approvals.pay_out');
	}

	public function status(Request $request){

        $PayApproval = PayApproval::where('id',$request->id)->first();
        $PayApproval->pay_out = $request->status;
        $PayApproval->Txid = $request->Txid;
        $PayApproval->type = $request->type;
        $PayApproval->updated_date = date('Y-m-d H:i');
        $PayApproval->pay_date = $request->pay_date;
        $PayApproval->commands = $request->commands;
        $PayApproval->update();

        if($request->status == 2){
            $this->dispatch(new ConsultantAcceptPayoutJob($PayApproval));
            return response()->json(['status'=>true,'msg'=>'Approved']);
        }
            
        if($request->status == 3){
            $this->dispatch(new ConsultantRejectPayoutJob($PayApproval));
            $Payment = new Payment;
            $Payment->amount = $PayApproval->amount;
            $Payment->type = 'add';
            $Payment->action = 'Pay Out Return';
            $Payment->consultant_id = $PayApproval->consultant_id;
            $Payment->save();

            $Wallet = Wallet::where('consultant_id',$PayApproval->consultant_id)->first();
            $Wallet->balance = $Wallet->balance + $PayApproval->amount;
            $Wallet->update();
            return response()->json(['status'=>true,'msg'=>'Declined']);
        }

    }


}
