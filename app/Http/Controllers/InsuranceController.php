<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CurrencyDataTable;
use App\Models\Insurance;
use DataTables;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Validator;
use App\Models\Currency;
use Illuminate\Support\Facades\Storage;

class InsuranceController extends Controller
{
    public function __construct()
    {
        $this->middleware('Permissions:Insurance_View',['only'=>['index']]);
        $this->middleware('Permissions:Insurance_Create',['only'=>['create']]);
        $this->middleware('Permissions:Insurance_Edit',['only'=>['edit']]);
        $this->middleware('Permissions:Insurance_delete',['only'=>['destroy']]);

    }
    
    public function index()
    {
        return view('insurance.index');
    }
    public function datatable(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Insurance::with('country')->with('state')->with('city')
        ->when($search[1],function($query,$search){   return $query->where('comapany_name','like',"%{$search}%");   })
        ->when($search[2],function($query,$search){   return $query->where('legal_name','like',"%{$search}%");   })
        ->when($search[3],function($query,$search){   return $query->where('have_tax',$search);   })
        ->when($search[4],function($query,$search){   return $query->where('taxation_number','like',"%{$search}%");   })
        // ->when($search[5],function($query,$search){   return $query->where('register_on','like',"%{$search}%");   })
        // ->when($search[6],function($query,$search){   return $query->where('consultant_type','like',"%{$search}%");   })
        ->when($search[7],function($query,$search){   return $query->where('register_address','like',"%{$search}%");   })
        ->when($search[8],function($query,$search){ return $query->where('country_id',$search);   })
        ->when($search[9],function($query,$search){ return $query->where('state_id',$search);   })
        ->when($search[10],function($query,$search){ return $query->where('city_id',$search);   })
        ->when($search[11],function($query,$search){ return $query->where('zipcode','like',"%{$search}%");   })
        ->when($search[12],function($query,$search){ return $query->where('cname','like',"%{$search}%");   })
        ->when($search[13],function($query,$search){ return $query->where('ctitle','like',"%{$search}%");   })
        ->when($search[14],function($query,$search){ return $query->where('cemail','like',"%{$search}%");   })
        ->when($search[15],function($query,$search){ return $query->where('cmobile','like',"%{$search}%");   })
        ->when($search[16],function($query,$search){ return $query->where('cphone','like',"%{$search}%");   })
        ->orderBy('id','desc')->get();

        return DataTables::of($datas)
                			->addIndexColumn()
                            ->editColumn('comapany_name', function(Insurance $data) {
                                return $data->comapany_name;
                            })
                            ->editColumn('country_id', function(Insurance $data){
                                $country = $data->country;
                                return ($country)?$country->country_name : '';
                            })
                            ->editColumn('state_id', function(Insurance $data){
                                $state = $data->state;
                                return ($state)?$state->state_name : '';
                            })
                            ->editColumn('city_id', function(Insurance $data){
                                $city = $data->city;
                                return ($city)?$city->city_name : '';
                            })
                            ->editColumn('legal_name', function(Insurance $data) {
                                return $data->legal_name;
                            }) 
                            ->editColumn('have_tax', function(Insurance $data) {
                                if($data->have_tax == 1) return 'Yes';
                                return 'No';
                            })
                            ->editColumn('taxation_number', function(Insurance $data) {
                                return $data->taxation_number;
                            })
                            ->editColumn('register_on', function(Insurance $data) {
                                return $data->register_on;
                            })
                            ->editColumn('register_address',function(Insurance $data){
                                return $data->register_address;
                            })
                            ->editColumn('logo', function(Insurance $data){
                                $exists = Storage::disk('public_custom')->exists($data->logo);
                                if($exists) return asset("storage/$data->logo");
                                return "";
                            })
                            ->editColumn('consultant_type',function(Insurance $data){
                                $consultant_type = \explode(',',$data->consultant_type);
                                $return = null;
                                if(\in_array('video_consultation',$consultant_type)) $return .= "Video Consultation<br>";
                                if(\in_array('audio_voice_call_consultation',$consultant_type)) $return .= "Audio Voice Call Consultation<br>";
                                if(\in_array('text_consultation',$consultant_type)) $return .= "Text Consultation<br>";
                                if(\in_array('direct_consultation',$consultant_type)) $return .= "Direct Consultation<br>";
                                return $return;
                            })
                            ->addColumn('status', function(Insurance $data) {
                                $status = ($data->status == 1)?'checked':'' ;
                                $route = \route('user.insurance.status',$data->id);
                                return "<div class='form-check form-switch form-check-custom form-check-solid'>
                                        <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                                    </div>";
                            })
                            ->editColumn('action', function(Insurance $data){
                                return ['Delete'=> \route('user.insurance.destroy',$data->id),'edit'=> \route('user.insurance.edit',$data->id)];
                            })
                            ->rawColumns(['status','comapany_name','legal_name','taxation_number','register_on','register_address','consultant_type'])
                            ->toJson();
    }
    public function destroy(Insurance $Insurance)
    {
        $Insurance->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
    }

    public function create(){
        $countrys = Country::where('status',1)->get();
        return \view('insurance.create',['countrys'=>$countrys]);
    }

    public function edit(Insurance $insurance){
        $countrys = Country::where('status',1)->get();
        $state = State::where('country_id',$insurance->country_id)->where('status',1)->get();
        $city = City::where('state_id',$insurance->state_id)->where('status',1)->get();
        $insurance->consultant_type = \explode(',',$insurance->consultant_type);
        
        $cname = \explode(',',$insurance->cname);
        $ctitle = \explode(',',$insurance->ctitle);
        $cemail = \explode(',',$insurance->cemail);
        $cmobile = \explode(',',$insurance->cmobile);
        $cphone = \explode(',',$insurance->cphone);

        $Contact = [];
        foreach ($cname as $key => $value) {
            # code...
            $data = [];
            $data['cname'] = $cname[$key];
            $data['ctitle'] = $ctitle[$key];
            $data['cemail'] = $cemail[$key];
            $data['cmobile'] = $cmobile[$key];
            $data['cphone'] = $cphone[$key];
            $Contact[] = $data;
        }
        
        return \view('insurance.edit',['insurance'=>$insurance,'countrys'=>$countrys,'state'=>$state,'city'=>$city,'contact'=>$Contact]);
    }

    public function store(Request $Request){

        $rules=[
			'taxation_number' => 'required|unique:insurances,taxation_number,'.$Request->taxation_number,
		];

		$customs=[
			'taxation_number.required'  => 'taxation number Name should be filled',
			'taxation_number.unique'      	=> 'taxation number Name already taken',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $cname = [];$ctitle = [];$cemail = [];$cmobile = [];$cphone = [];
        foreach ($Request->kt_docs_repeater_basic as $key => $value) {
            # code...
            $cname[] = $value['cname'];$ctitle[] = $value['ctitle'];$cemail[] = $value['cemail'];$cmobile[] = $value['cmobile'];$cphone[] = $value['cphone'];
        }


        $Request['cname'] = \implode(',',$cname);
        $Request['ctitle'] = \implode(',',$ctitle);
        $Request['cemail'] = \implode(',',$cemail);
        $Request['cmobile'] = \implode(',',$cmobile);
        $Request['cphone'] = \implode(',',$cphone);
        $Request['consultant_type'] = \implode(',',$Request->consultant_type);
        
        if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->logo")){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->logo","/uploadFiles/logo/$Request->logo");
            $Request['logo'] =  "/uploadFiles/logo/$Request->logo";
        }

        $Request->register_on = date("Y-m-d H:i:s", strtotime($Request->register_on));
        $Request->status = (isset($Request->status)?1:0);
        $Companysetting = new Insurance;
        $Companysetting->fill($Request->all());
        $Companysetting->logo = $Request['logo'];
        $Companysetting->save();

       return response()->json(['msg'=>'Insurance Added']);
    }
    public function update(Request $Request,Insurance $insurance){
        $rules=[
			'taxation_number' => "required|unique:insurances,taxation_number,$insurance->id,id",
		];

		$customs=[
			'taxation_number.required'  => 'taxation number Name should be filled',
			'taxation_number.unique'      	=> 'taxation number Name already taken',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $cname = [];$ctitle = [];$cemail = [];$cmobile = [];$cphone = [];
        foreach ($Request->kt_docs_repeater_basic as $key => $value) {
            # code...
            $cname[] = $value['cname'];$ctitle[] = $value['ctitle'];$cemail[] = $value['cemail'];$cmobile[] = $value['cmobile'];$cphone[] = $value['cphone'];
        }

        $Request['cname'] = \implode(',',$cname);
        $Request['ctitle'] = \implode(',',$ctitle);
        $Request['cemail'] = \implode(',',$cemail);
        $Request['cmobile'] = \implode(',',$cmobile);
        $Request['cphone'] = \implode(',',$cphone);
        $Request['consultant_type'] = \implode(',',$Request->consultant_type);
        
        if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->logo") && $Request->logo){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->logo","/uploadFiles/logo/$Request->logo");
            $Request['logo'] =  "/uploadFiles/logo/$Request->logo";
        }else{
            $Request['logo'] = $insurance->logo;
        }
        
        $Request->logo = $Request['logo'];
        $Request->register_on = date("Y-m-d H:i:s", strtotime($Request->register_on));
        $Request->status = (isset($Request->status)?1:0);
        $insurance->update($Request->all());
        return response()->json(['msg'=>'Update']);
    }

    public function status(Request $request,Insurance $insurance){
        $insurance->status = $request->status;
        $insurance->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }
}
