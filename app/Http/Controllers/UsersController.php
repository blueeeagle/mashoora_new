<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function __construct()
    {
        $this->middleware('Permissions:Admin_View',['only'=>['index']]);
        $this->middleware('Permissions:Admin_Create',['only'=>['create']]);
        $this->middleware('Permissions:Admin_Edit',['only'=>['edit']]);
        $this->middleware('Permissions:Admin_delete',['only'=>['destroy']]);

    }
    
    public function index()
    {
        // $config = theme()->getOption('page');
		return view('user.index');
        return User::all();
    }

    public function datatable(Request $request){

        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = User::with('country','state','city')->orderBy('first_name','ASC')
        ->when($search[1],function($query,$search){
            return $query->where('first_name','LIKE',"%{$search}%")->orwhere('last_name','LIKE',"%{$search}%");
        })
        ->when($search[2],function($query,$search){
            return $query->where('email','LIKE',"%{$search}%");
        })
        ->when($search[3],function($query,$search){
            return $query->where('phone','LIKE',"%{$search}%");
        })
        ->get();

        return DataTables::of($datas)
                			->addIndexColumn()
                            ->addColumn('name', function(User $data) {
                                return $data->first_name.' '.$data->last_name;
                            })
                            ->addColumn('status', function(User $data) {

                                $status = ($data->status == 1)?'checked':'' ;
                                $statusName = ($data->status ==1)?'Active':'InActive';
                                $route = \route('admin.user.status',$data->id);
                                    return "<div class='form-check form-switch form-check-custom form-check-solid'>
                                            <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                                        </div>";
                            })
                            ->editColumn('picture', function(User $data){
                                if(!$data->picture) return '';
                                    $exists = Storage::disk('public_custom')->exists($data->picture);
                                    if($exists) return asset("storage/$data->picture");;
                                return "";
                            })
                            ->addColumn('action', function(User $data) {

                                return ['Delete'=> \route('admin.user.destroy',$data->id),'edit'=> \route('admin.user.edit',$data->id)];
                            })
                            ->rawColumns(['name','action','status','picture'])
                            ->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $countrys = Country::where('status',1)->get();
        $state = State::where('status','1')->get();
        $city = City::where('status','1')->get();

        return \view('user.create',['countrys'=>$countrys,'state'=>$state,'city'=>$city]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $Request)
    {
        // dd($Request);
        $rules=[ 'email' => 'required|unique:users,email,'.$Request->email ];

		$customs=[ 'email.unique'  => 'Email already taken' ];

        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->picture")){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->picture","/uploadFiles/user/$Request->picture");
            $Request['picture'] =  "/uploadFiles/user/$Request->picture";
        }

        $user = new User;
        $user->email = $Request->email;
        $user->first_name = $Request->first_name;
        $user->last_name = $Request->last_name;
        $user->password = Hash::make('1234');
        $user->api_token = Str::random(60);
        $user->remember_token = Str::random(60);
        $user->phone = $Request->phone;
        $user->country_id = $Request->country_id;
        $user->state_id = $Request->state_id;
        $user->city_id = $Request->city_id;
        $user->zipcode = $Request->zipcode;
        $user->picture = $Request->picture;
        $user->register_address = $Request->register_address;
        $user->permission = ($Request->permession == null)?'':\implode(',',$Request->permession);
        if($Request->is_two_way_auth){$user->is_two_way_auth=$Request->is_two_way_auth;}
        $user->save();

        return response()->json(['msg'=>'user Addes']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $config = theme()->getOption('page');

        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // dd($user);
        $countrys = Country::where('status',1)->get();
        $state = State::where('country_id',$user->country_id)->where('status',1)->get();
        $city = City::where('country_id',$user->country_id)->when($user->state_id, function($query,$search){ return $query->where('state_id',$search); })->where('status',1)->get();
        return \view('user.edit',['user'=>$user,'countrys'=>$countrys,'state'=>$state,'city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $Request, User $user){
        // dd($Request);
        $rules=[ 'email ' => "unique:users,email,$user->id,id" ];

		$customs=[ 'email.unique'  => 'Email already taken' ];

        $validator = Validator::make($Request->all(),$rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->picture") && $Request->picture){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->picture","/uploadFiles/user/$Request->picture");
            $Request['picture'] =  "/uploadFiles/user/$Request->picture";
        }else{
            $Request['picture'] =  $user->picture;
        }
        //  dd($Request->picture);
        $user->email = $Request->email;
        $user->first_name = $Request->first_name;
        $user->last_name = $Request->last_name;
        $user->password = Hash::make('1234');
        $user->api_token = Str::random(60);
        $user->remember_token = Str::random(60);
        $user->phone = $Request->phone;
        $user->country_id = $Request->country_id;
        $user->state_id = $Request->state_id;
        $user->city_id = $Request->city_id;
        $user->zipcode = $Request->zipcode;
        $user->picture = $Request->picture;
        $user->register_address = $Request->register_address;
        $user->permission = ($Request->permession == null)?'':\implode(',',$Request->permession);
        $user->is_two_way_auth = isset($Request->is_two_way_auth)?2:1;
        
        $user->update();
        return response()->json(['msg'=>'Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
    }
    public function status(Request $request,User $user){
        $user->status = $request->status;
        $user->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }
}
