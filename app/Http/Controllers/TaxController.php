<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tax;
use App\Models\Companysetting;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;

class TaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('Permissions:Tax',['only'=>['index']]);
        $this->middleware('Permissions:Tax_Create',['only'=>['create']]);
        $this->middleware('Permissions:Tax_Edit',['only'=>['edit']]);
        $this->middleware('Permissions:Tax_delete',['only'=>['destroy']]);

    }
    public function index(){
        return view('tax.index');
    }

    public function datatable(Request $request){
        $Companysetting = Companysetting::where('id',1)->first();
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Tax::when($search[1],function($query,$search){
            return $query->where('title','LIKE',"%{$search}%");
        })->orderBy('title','ASC')->get();


        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('status', function(Tax $data) {
            $status = ($data->status == 1)?'checked':'' ;
            $route = \route('master.tax.status',$data->id);
            return "<div class='form-check form-switch form-check-custom form-check-solid'>
                    <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                </div>";
        })
        ->editColumn('created_at', function(Tax $data) use($Companysetting){
          if($data->created_at){
                    $temp = $Companysetting->custom_date_time($data->created_at);
                    return $temp;
                }
                return '-';
        })
        ->editColumn('updated_at', function(Tax $data) use($Companysetting){
         if($data->updated_at){
                    $temp = $Companysetting->custom_date_time($data->updated_at);
                    return $temp;
                }
                return '-';
        })
        ->addColumn('action', function(Tax $data){
            return ['Delete'=> \route('master.tax.destroy',$data->id),'edit'=> \route('master.tax.edit',$data->id)];
        })
        ->rawColumns(['status','action'])
        ->toJson();
    }

    public function create(){
        return \view('tax.create');
    }
    public function edit(Tax $tax ){
        return \view('tax.edit',['tax'=>$tax]);
    }
    public function store(Request $Request){
      
        $rules=[
			'title' => 'required|unique:taxes,title,'.$Request->input('title'),
		];

		$customs=[
			'title.required'  => 'Title Name should be filled',
			'title.unique'      	=> 'Title Name already taken',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $tax = new Tax();
        $tax->title = $Request->title;
         $tax->tax_value = $Request->tax_value;
        $tax->save();
        return response()->json(['msg'=>'Tax Added']);
    }

	public function update(Request $Request,Tax $tax){
        // dd($Request); 
        $rules=[
			'title' => "required|unique:taxes,title,$tax->id,id",
		];

		$customs=[
			'title.required'  => 'Title Name should be filled',
			'title.unique' => 'Title Name already taken',
		];
        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $tax->title = $Request->title;
        $tax->tax_value = $Request->tax_value;
        $tax->update();
        return response()->json(['msg'=>'Update']);
    }

    public function status(Request $request,Tax $tax){
        $tax->status = $request->status;
        $tax->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }

    public function destroy(Tax $tax){
        $tax->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
    }

}
