<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Consultant;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;
use App\Models\Companysetting;

class LanguagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('Permissions:Language_View',['only'=>['index']]);
        $this->middleware('Permissions:Language_Create',['only'=>['create']]);
        $this->middleware('Permissions:Language_Edit',['only'=>['edit']]);
        $this->middleware('Permissions:Language_delete',['only'=>['destroy']]);

    }

    public function index(){
        return view('language.index');
    }

    public function datatable(Request $request){
         $Companysetting = Companysetting::where('id',1)->first();
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Language::when($search[1],function($query,$search){
            return $query->where('title','LIKE',"%{$search}%");
        })->orderBy('title','ASC')->get();


        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('created_at', function(Language $data) use($Companysetting){
           if($data->created_at){
                    $temp = $Companysetting->custom_date_time($data->created_at);
                    return $temp;
                }
                return '-';
           
        })->editColumn('updated_at', function(Language $data) use($Companysetting){
          if($data->updated_at){
                    $temp = $Companysetting->custom_date_time($data->updated_at);
                    return $temp;
                }
                return '-';
           
        })
        ->addColumn('status', function(Language $datas) {
            $status = ($datas->status == 1)?'checked':'' ;
            $route = \route('master.language.status',$datas->id);
            return "<div class='form-check form-switch form-check-custom form-check-solid'>
                    <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                </div>";
        })
        ->addColumn('action', function(Language $datas){
            return ['Delete'=> \route('master.language.destroy',$datas->id),'edit'=> \route('master.language.edit',$datas->id)];
        })
        ->rawColumns(['status','action'])
        ->toJson();
    }

    public function create(){
        return \view('language.create');
    }
    public function edit(Language $language ){
        return \view('language.edit',['language'=>$language]);
    }
    public function store(Request $Request){

        $rules=[
			'title' => 'required|unique:languages,title,'.$Request->input('title'),
		];

		$customs=[
			'title.required'  => 'Title Name should be filled',
			'title.unique'      	=> 'Title Name already taken',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $language = new Language();
        $language->title = $Request->title;
        $language->status = 1;
        $language->save();
        return response()->json(['msg'=>'Language Added']);
    }

	public function update(Request $Request,Language $language){
        // dd($Document);
        $rules=[
			'title' => "required|unique:languages,title,$language->id,id",
		];

		$customs=[
			'title.required'  => 'Title Name should be filled',
			'title.unique' => 'Title Name already taken',
		];
        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $language->title = $Request->title;
        $language->update();
        return response()->json(['msg'=>'Update']);
    }

    public function status(Request $request,Language $language){
        $language->status = $request->status;
        $language->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }

    public function destroy(Language $language){
        
        $consultant = Consultant::all()->filter(function($value) use ($language) {
            $temp = in_array($language->id,explode(',',$value->language));
            return $temp;
        })->toArray();


        if($consultant != null ){
            $temp = ($consultant)?'Consultant':'';
            $data1['error'] = 'Language is Mapped with ' .$temp.'.so cannot delete';
           
            $data1['status'] = false;
            return response()->json($data1);
        }
        
        $language->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
    }

}
