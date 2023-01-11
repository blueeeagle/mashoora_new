<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Consultantcategory;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;
use App\Models\Category;
use App\Models\Consultant;
use App\Models\Companysetting;
use App\Models\Discount;

class ConsultantCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('Permissions:Specialization_View',['only'=>['index']]);
        $this->middleware('Permissions:Specialization_Create',['only'=>['create']]);
        $this->middleware('Permissions:Specialization_Edit',['only'=>['edit']]);
        $this->middleware('Permissions:Specialization_delete',['only'=>['destroy']]);
    }

    public function index(){
        $Category = Category::where('type',0)->get();
        $ChildCategory = Category::where('type',0)->get();
        return view('consultantcategory.index',['Category'=>$Category,'ChildCategory'=>$ChildCategory]);
    }

    public function datatable(Request $request){
        $Companysetting = Companysetting::where('id',1)->first();
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Consultantcategory::with(['Category' => function ($query)
                    { $query->orderBy('name','ASC');} ])
        ->with('SubCategory')
        ->when($search[1],function($query,$search){  return $query->where('title','LIKE',"%{$search}%"); })
        ->when($search[2],function($query,$search){  $search = \explode(',',$search);  return $query->whereIn('categorie_id',$search); })
        ->when($search[3],function($query,$search){  $search = \explode(',',$search);  return $query->whereIn('subcategorie_id',$search);  })
        ->get();

        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('categorie_id', function(Consultantcategory $data){
            if($data->Category) return $data->Category->name;
            return '';
        })
        ->editColumn('subcategorie_id', function(Consultantcategory $data){
            if($data->SubCategory) return $data->SubCategory->name;
            return '';
        })
        ->editColumn('created_at', function(Consultantcategory $data) use($Companysetting){
           if($data->created_at){
                    $temp = $Companysetting->custom_date_time($data->created_at);
                    return $temp;
                }
                return '-';
           
        })->editColumn('updated_at', function(Consultantcategory $data) use($Companysetting){
            if($data->updated_at){
                    $temp = $Companysetting->custom_date_time($data->updated_at);
                    return $temp;
                }
                return '-';
        })
        ->editColumn('status', function(Consultantcategory $data) {
            $status = ($data->status == 1)?'checked':'' ;
            $route = \route('master.consultantcategory.status',$data->id);
            return "<div class='form-check form-switch form-check-custom form-check-solid'>
                    <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                </div>";
        })
        ->addColumn('action', function(Consultantcategory $data){
            return ['Delete'=> \route('master.specialization.destroy',$data->id),'edit'=> \route('master.specialization.edit',$data->id)];
        })
        ->rawColumns(['status','action'])
        ->toJson();
    }

    public function create(){
        $Category = Category::where('type',0)->orderBy('name','ASC')->get();
        $ChildCategory = Category::where('type',1)->orderBy('name','ASC')->get();
        return \view('consultantcategory.create',['Category'=>$Category,'ChildCategory'=>$ChildCategory]);
    }

    public function edit(Consultantcategory $specialization){
        $Category = Category::where('type',0)->get();
        $ChildCategory = Category::where('type',1)->where('id',$specialization->subcategorie_id)->get();
        return \view('consultantcategory.edit',['consultantcategory'=>$specialization,'Category'=>$Category,'ChildCategory'=>$ChildCategory]);
    }
    public function store(Request $Request){

        $rules=[
			'title' => 'required|unique:consultantcategories,title,'.$Request->input('title'),
		];

		$customs=[
			'title.required'  => 'Title Name should be filled',
			'title.unique'      	=> 'Title Name already taken',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $Consultantcategory = new Consultantcategory();
        $Consultantcategory->title = $Request->title;
        $Consultantcategory->categorie_id = $Request->categorie_id;
        $Consultantcategory->subcategorie_id = $Request->subcategorie_id;
        $Consultantcategory->status =  1;
        $Consultantcategory->save();
        return response()->json(['msg'=>'Added']);
    }

	public function update(Request $Request,$id){
        $rules=[
			'title' => 'required|unique:consultantcategories,title,'.$id,
		
		];

		$customs=[
			'title.required'  => 'Title Name should be filled',
			'title.unique' => 'Title Name already taken',
		];
        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
		$Consultantcategory = Consultantcategory::findOrFail($id);
        $Consultantcategory->title = $Request->title;
        $Consultantcategory->categorie_id = $Request->categorie_id;
        $Consultantcategory->subcategorie_id = $Request->subcategorie_id;
        $Consultantcategory->update();
        return response()->json(['msg'=>'Update']);

    }
    public function status(Request $request,Consultantcategory $Consultantcategory){
        $Consultantcategory->status = $request->status;
        $Consultantcategory->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }
    public function destroy(Consultantcategory $specialization){
        $Discount = Discount::where('specialization_id',$specialization->id)->exists();
        $consultant = Consultant::all()->filter(function($value) use ($specialization) {
            $temp = in_array($specialization->id,explode(',',$value->specialized));
            return $temp;
        })->toArray();


        if($consultant != null ||  $Discount){
            $temp = ($consultant)?'Consultant':'';
            $temp .= ($Discount)?',Discount':'';
            $data1['error'] = 'Specialization is Mapped with ' .$temp.'.so cannot delete';
           
            $data1['status'] = false;
            return response()->json($data1);
        }

        $specialization->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
    }

}
