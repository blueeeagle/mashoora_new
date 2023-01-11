<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Firm;
use App\Models\Consultant;
use App\Models\Appointment;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;
use Illuminate\Support\Facades\Storage;

class ArticelController extends Controller
{
    public function __construct()
    {
        $this->middleware('Permissions:Article_View',['only'=>['index']]);
        $this->middleware('Permissions:Article_Create',['only'=>['create']]);
        $this->middleware('Permissions:Article_Edit',['only'=>['edit']]);
        $this->middleware('Permissions:Article_delete',['only'=>['destroy']]);
    }
    
    public function index(){
        //  $Appointment  = Appointment::all();
        // foreach ($Appointment as $key => &$value) {
        //     # code...
            
        //     $value->appointment;
        //      unset($value->rawdata);
        // }
        // dd($Appointment);
        return view('article.index');
    }

    public function datatable(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Article::with('firm')->with('consultant')->with('user')
        ->when($search[1],function($query,$search){ return $query->where('from_user',$search);   })
        ->when($search[2],function($query,$search){ return $query->where('f_c_a','like',"%{$search}%");   })
        ->when($search[3],function($query,$search){ return $query->where('title','like',"%{$search}%");   })
        ->when($search[5],function($query,$search){ return $query->where('describtion','like',"%{$search}%");   })
        ->orderBy('id','desc')->get();

    //dd($datas);
        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('fromuser', function(Article $data) {
            if($data->from_user == 0) return 'Firm';
            if($data->from_user == 1) return 'Consultant';
            if($data->from_user == 2) return 'Admin';
        })
         ->addColumn('f_c_a', function(Article $data) {
            if($data->firm != '') return $data->firm->comapany_name;
            if($data->consultant != '') return $data->consultant->name;
            if($data->user != '') return $data->user->first_name;
        })
        ->editColumn('status', function(Article $data) {
            $status = ($data->status == 1)?'checked':'' ;
            $route = \route('other.articel.status',$data->id);
                return "<div class='form-check form-switch form-check-custom form-check-solid'>
                        <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                    </div>";
        })
        ->editColumn('image', function(Article $data){
                                $exists = Storage::disk('public_custom')->exists($data->image);
                                if($exists) return asset("storage/$data->image");
                                return "";
                            })
        ->addColumn('action', function(Article $data){
            return ['Delete'=> \route('other.article.destroy',$data->id),'edit'=> \route('other.article.edit',$data->id)];
        })
        ->rawColumns(['status','action','fromuser','image'])
        ->toJson();
    }

    public function create(){
        $firm = Firm::where('status',1)->where('approval',2)->get();
        $consultant = Consultant::where('status',1)->get();
        $user = User::get();

        return \view('article.create',['firm'=>$firm,'consultant'=>$consultant,'user'=>$user]);
    }
    public function edit(Article $article ){
        $firm = Firm::where('status',1)->where('approval',2)->get();
        $consultant = Consultant::where('status',1)->get();
        $user = User::get();

        return \view('article.edit',['articel'=>$article,'firm'=>$firm,'consultant'=>$consultant,'user'=>$user]);
    }
    public function store(Request $Request){
        $rules=[
			'title' => 'required|unique:articles,title,'.$Request->input('title'),
		];

		$customs=[
			'title.required'  => 'Title Name should be filled',
			'title.unique'      	=> 'Title Name already taken',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $Article = new Article;
        $Article->fill($Request->all());
        
        if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->image")){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->image","/uploadFiles/Articel/$Request->image");
            $Request['image'] =  "/uploadFiles/Articel/$Request->image";
        }
        
        
        $Article->image = $Request->image;
        $Article->status = (isset($Request->status)?1:0);
        $Article->save();

       return response()->json(['msg'=>'Articel Addes']);
    }

	public function update(Request $Request,Article $articel){
        $rules=[
			'title' => "required|unique:articles,title,$articel->id,id",
		];

		$customs=[
			'title.required'  => 'Title Name should be filled',
			'title.unique'      	=> 'Title Name already taken',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        
        if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->image") && $Request->image){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->image","/uploadFiles/Articel/$Request->image");
            $Request['image'] =  "/uploadFiles/Articel/$Request->image";
        }else{
            $Request['image'] = $articel->image;
        }
        
        $Request->image = $Request->image;
        $Request->status = (isset($Request->status)?1:0);
        $articel->update($Request->all());
        return response()->json(['msg'=>'Update']);

    }

     public function search(Request $Request){
        $Firm = Firm::where('comapany_name','like',"%{$Request->search}%")->orWhere('legal_name','like',"%{$Request->search}%")->select(['id','comapany_name as text','logo'])->get();
        return response()->json([["title"=>'Firm','children'=> $Firm]]);
    }

    public function consultantSearch(Request $Request)
    {
        $Consultant = Consultant::where('name','like',"%{$Request->search}%")->orWhere('phone_no','like',"%{$Request->search}%")->orWhere('email','like',"%{$Request->search}%")->select(['id','name as text','phone_no'])->get();
        return response()->json([["title"=>'Consultant','children'=> $Consultant]]);
    }

    public function userSearch(Request $Request)
    {
        $User = User::where('first_name','like',"%{$Request->search}%")->orWhere('last_name','like',"%{$Request->search}%")->orWhere('email','like',"%{$Request->search}%")->orWhere('phone','like',"%{$Request->search}%")->select(['id','first_name as text','phone'])->get();
        return response()->json([["title"=>'User','children'=> $User]]);
    }

    public function status(Request $request,Article $articel){
        $articel->status = $request->status;
        $articel->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }


    public function destroy(Article $article)
    {
        $article->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
        //--- Redirect Section Ends
    }

}
