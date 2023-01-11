<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Firm;
use App\Models\Category;
use Auth;
use Validator;
use DataTables;
use DB;


class FirmApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('Permissions:Firm_Approval_View',['only'=>['index']]);

    }
    public function datatables(Request $request){

        $datas = Firm::with('country','country','state')->where('is_new',1)->orderBy('id','desc')->get();
        if($request->searchTable == 'Approved') $datas = Firm::with('country','country','state')->where('approval',2)->orderBy('id','desc')->get();
        if($request->searchTable == 'Decline') $datas = Firm::with('country','country','state')->where('approval',1)->orderBy('id','desc')->get();

        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('created_at', function (Firm $datas){
           return  $datas->created_at->format('Y-m-d');
        })
        ->editColumn('updated_at', function(Firm $datas){
            return $datas->updated_at->format('d/m/Y H:i:s');
        })
        ->addColumn('category', function(Firm $datas){
            $cat = Category::whereIn('id',explode(',',$datas->categorie_id))->get();
            $template='';
            for($i = 0;$i<count($cat); $i++){
                $template .= "<span class='badge badge-success'>".$cat[$i]->name."</span>"."<br/>";
            }
            return $template;
        })
        ->editColumn('approval',function(Firm $datas){
            if($datas->approval == 2){
                return $temp = "<span class='badge badge-success'>Approved</span>";
            }
            if($datas->approval == 3){
                return  $temp = "<span class='badge badge-danger'>Decline</span>";
            }
        })
        ->addColumn('option',function($datas){
            return ['view'=> \route('user.firms.edit',$datas->id)];
        })
        ->addColumn('select',function($datas){
            return ['select'];
        })
        ->rawColumns(['category','approval','action'])
        ->toJson(); //--- Returning Json Data To Client Side
    }


	public function index(){
		return view('approval.firm.index');
	}

	public function status(Request $request){
    //    dd($request);
        if($request->status == 1){
            foreach ($request->id as $key => $id) {
                $approval = Firm::where('id',$id)->first();
                $approval->approval = 1;
                $approval->is_new = 0;
                $approval->deapp_date = date('Y-m-d');
                $approval->update();
            }
            return response()->json(['status'=>true,'msg'=>'Declined']);
        }
        if($request->status == 2){
            foreach ($request->id as $key => $id) {
                $approval = Firm::where('id',$id)->first();
                $approval->approval = 2;
                $approval->is_new = 0;
                $approval->app_date = date('Y-m-d');
                $approval->update();
            }
            return response()->json(['status'=>true,'msg'=>'Approved']);
        }
    }
}
