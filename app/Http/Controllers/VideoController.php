<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\User;
use App\Models\Firm;
use App\Models\Consultant;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;

class VideoController extends Controller
{
    public function __construct(){
        $this->middleware('Permissions:Video_View',['only'=>['index']]);
        $this->middleware('Permissions:Video_Create',['only'=>['create']]);
        $this->middleware('Permissions:Video_Edit',['only'=>['edit']]);
        $this->middleware('Permissions:Video_delete',['only'=>['destroy']]);
    }
    
    public function index(){
        return view('video.index');
    }

    public function datatable(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Video::when($search[1],function($query,$search){ return $query->where('post_from',$search); })
        ->when($search[2],function($query,$search){ return $query->where('video_title','like',"%{$search}%");   })
        ->when($search[3],function($query,$search){ return $query->where('video_url','like',"%{$search}%");   })
        ->when($search[4],function($query,$search){ return $query->where('sort_no','like',"%{$search}%");   })
        ->orderBy('sort_no')->get();

        //  dd($datas);
        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('fromuser', function(Video $data) {
            if($data->post_from == 0) return 'Firm';
            if($data->post_from == 1) return 'Consultant';
            if($data->post_from == 2) return 'Admin';
        })
        ->editColumn('status', function(Video $data) {
            $status = ($data->status == 1)?'checked':'' ;
            $route = \route('other.video.status',$data->id);
                return "<div class='form-check form-switch form-check-custom form-check-solid'>
                        <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                    </div>";
        })
        ->addColumn('action', function(Video $data){
            return ['Delete'=> \route('other.video.destroy',$data->id),'edit'=> \route('other.video.edit',$data->id)];
        })
        ->rawColumns(['status','action','fromuser'])
        ->toJson();
    }

    public function create(){
        return \view('video.create');
    }
    public function edit(Video $video ){
        $firm = Firm::where('status',1)->get();
        $consultant = Consultant::where('status',1)->get();
        $user = User::get();
        
        return \view('video.edit',['video'=>$video,'firm'=>$firm,'consultant'=>$consultant,'user'=>$user]);
    }
    public function store(Request $Request){
        $rules=[
			'video_title' => 'required|unique:videos,video_title,'.$Request->video_title,
            'post_from' => 'required',
            'video_url' => 'required',
		];

		$customs=[
			'video_title.required'  => 'Title Name should be filled',
			'video_title.unique'      	=> 'Title Name already taken',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $Video = new Video;
        // dd($Request->all());
        $Video->fill($Request->all());
        $Video->save();

       return response()->json(['msg'=>'Video Addes']);
    }

	public function update(Request $Request,Video $video){
        $rules=[
			'video_title' => "required|unique:videos,video_title,$video->id,id",
            'post_from' => 'required',
            'video_url' => 'required',
            'sort_no' => 'required',
		];

		$customs=[
            'video_title.required'  => 'Title Name should be filled',
			'video_title.unique'      	=> 'Title Name already taken',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        
        $video->update($Request->all());
        if(!$Request->has('display_in_home')){ $video->display_in_home = 0; }
        $video->update();
        return response()->json(['msg'=>'Video Updated Successfully']);

    }

   public function search(Request $Request){
        $Firm = Firm::where('company_name','like',"%{$Request->search}%")->orWhere('legal_name','like',"%{$Request->search}%")->select(['id','company_name as text'])->get();
        return response()->json([["title"=>'Firm','children'=> $Firm]]);
    }

    public function consultantSearch(Request $Request)
    {
        $Consultant = Consultant::where('name','like',"%{$Request->search}%")->orWhere('phone_no','like',"%{$Request->search}%")->orWhere('email','like',"%{$Request->search}%")->select(['id','name as text'])->get();
        return response()->json([["title"=>'Consultant','children'=> $Consultant]]);
    }

    public function userSearch(Request $Request)
    {
        $User = User::where('first_name','like',"%{$Request->search}%")->orWhere('last_name','like',"%{$Request->search}%")->orWhere('email','like',"%{$Request->search}%")->orWhere('phone','like',"%{$Request->search}%")->select(['id','first_name as text'])->get();
        return response()->json([["title"=>'User','children'=> $User]]);
    }

    public function status(Request $request,Video $video){
        $video->status = $request->status;
        $video->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }


    public function destroy(Video $video)
    {
        $video->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
        //--- Redirect Section Ends
    }

}
