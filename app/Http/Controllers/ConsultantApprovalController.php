<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Consultant;
use App\Models\Category;
use Auth;
use Validator;
use DataTables;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ConsultantProfileDeclineJob;
use App\Jobs\ConsultantProfileApprovelJob;

class ConsultantApprovalController extends Controller
{

    public function __construct()
    {
        $this->middleware('Permissions:Consultant_Approval_View',['only'=>['index']]);

    }

	public function datatables(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Consultant::with('Addcountry','state','city')->where('approval',0)->orderBy('id','desc')->get();
        if($request->searchTable == 'Approved') $datas = Consultant::with('Addcountry','state','city')->where('approval',2)->orderBy('id','desc')->get();
        if($request->searchTable == 'Decline') $datas = Consultant::with('Addcountry','state','city')->where('approval',1)->orderBy('id','desc')->get();

        return DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('picture', function(Consultant $data){
                if(!isset($data->picture)) return "";
                $exists = Storage::disk('public_custom')->exists($data->picture);
                if($exists) return asset("storage/$data->picture");
                return "";
            })
            ->editColumn('phone_no', function(Consultant $data){
                return $data->country->dialing." ".$data->phone_no;
            })
            ->editColumn('name', function(Consultant $data){
                return "Name : ".$data->name."<br/> Email : ".$data->email;
            })
            ->addColumn('step', function(Consultant $data){
                if($data->mobile_step) return "$data->mobile_step of 10";
                return "$data->step of 11";
            })
            ->addColumn('address', function (Consultant $data){
                return html_entity_decode($data->register_address);
            })
            ->addColumn('commission_fee', function (Consultant $data){
                return $data->country;
            })
            ->addColumn('app_status', function (Consultant $data){
                return $data->com_off_amount != null && $data->com_con_amount != null && $data->com_pay_amount != null;
            })
            ->editColumn('action', function(Consultant $data){
                return ['Delete'=> \route('consultant.consultant.destroy',$data->id),'view'=> \route('consultant.consultant.view',$data->id),'edit'=> \route('consultant.consultant.edit',$data->id)];
            })
            ->rawColumns(['action','status','categorie_id','address','name'])
            ->toJson();
    }


	public function index(){
		return view('approval.consultant.index');
	}

	public function status(Request $request){
        // dd($request);
        if($request->status == 1){
            foreach ($request->id as $key => $id) {
                $approval = Consultant::where('id',$id)->first();
                $approval->approval = 1;
                $approval->update();
                $this->dispatch(new ConsultantProfileDeclineJob($approval));
            }
            return response()->json(['status'=>true,'msg'=>'Declined']);
        }
        if($request->status == 2){
            foreach ($request->id as $key => $id) {
                $approval = Consultant::where('id',$id)->first();
                $approval->approval = 2;
                $approval->update();
                $this->dispatch(new ConsultantProfileApprovelJob($approval));
            }
            return response()->json(['status'=>true,'msg'=>'Approved']);
        }
    }


}
