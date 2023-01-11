<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CurrencyDataTable;
use App\Models\Companysetting;
use DataTables;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Validator;
use App\Models\Currency;
use Illuminate\Support\Facades\Storage;
use File;

class CompanysettingsController extends Controller
{
     public function __construct()
    {
        $this->middleware('Permissions:Company_Settings_View',['only'=>['index']]);
    }
    
    public function index()
    {
        
        $Companysetting = Companysetting::where('id',1)->first();
        $countrys = Country::with('currency')->where('status',1)->get();
        $state = State::where('country_id',$Companysetting->country_id)->where('status',1)->get();
        $city = City::where('state_id',$Companysetting->state_id)->where('status',1)->get();
        $currency = Country::with('currency')->where('id',$Companysetting->country_id)->first();
        $cname = \explode(',',$Companysetting->cname);
        $ctitle = \explode(',',$Companysetting->ctitle);
        $cemail = \explode(',',$Companysetting->cemail);
        $cmobile = \explode(',',$Companysetting->cmobile);
        $cphone = \explode(',',$Companysetting->cphone);

        // dd($Companysetting->have_tax);
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
        $Time_Zone = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $Companysetting->country->country_code)[0];
        return view('companysetting.create',['Time_Zone'=>$Time_Zone,'Companysetting'=>$Companysetting,'countrys'=>$countrys,'state'=>$state,'city'=>$city,'contact'=>$Contact,'currency'=>$currency->currency]);
    }

    public function store(Request $Request,Companysetting $config){

        $cname = [];$ctitle = [];$cemail = [];$cmobile = [];$cphone = [];
        foreach ($Request->kt_docs_repeater_basic as $key => $value) {
            # code...
            $cname[] = $value['cname'];$ctitle[] = $value['ctitle'];$cemail[] = $value['cemail'];$cmobile[] = $value['cmobile'];$cphone[] = $value['cphone'];
        }
        $Country = Country::where('id',$Request->country_id)->first();
        if($Country){
            $currencySelect = Currency::where('countryname',$Country->country_name)->first();
            if($currencySelect) $Request['currencie_id'] = $currencySelect->id;
        }

        $Request['cname'] = \implode(',',$cname);
        $Request['ctitle'] = \implode(',',$ctitle);
        $Request['cemail'] = \implode(',',$cemail);
        $Request['cmobile'] = \implode(',',$cmobile);
        $Request['cphone'] = \implode(',',$cphone);
        $Request->status = (isset($Request->status)?1:0);
        $config->currencie_id = $Request->currencie_id;
        $config->time_zone = $Request->time_zone;
        $config->update($Request->all());

       return response()->json(['msg'=>'Updated']);
    }

public function detailsupdate(Request $Request){
        $Companysetting = Companysetting::where('id',1)->first();
        $Request['have_tax'] = isset($Request->have_tax)?1:0;
        // dd($Request->all());
        $Companysetting->update($Request->all());
       return response()->json(['status'=>true,'msg'=>'Details updated']);

    }
    public function addressupdate(Request $Request){
        $Companysetting = Companysetting::where('id',1)->first();
        $Companysetting->update($Request->all());
        $Time_Zone = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $Companysetting->country->country_code)[0];
        $this->setEnv("timezone",$Time_Zone);
       return response()->json(['status'=>true,'msg'=>'Address updated']);
    }
    public function settingupdate(Request $Request){
        $Companysetting = Companysetting::where('id',1)->first();
        if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->logo_login_page") && $Request->logo_login_page){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->logo_login_page","/uploadFiles/user/$Request->logo_login_page");
            $Request['logo_login_page'] =  "/uploadFiles/user/$Request->logo_login_page";
        }else{
            $Request['logo_login_page'] =  $Companysetting->logo_login_page;
        }

        if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->logo_header") && $Request->logo_header){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->logo_header","/uploadFiles/user/$Request->logo_header");
            $Request['logo_header'] =  "/uploadFiles/user/$Request->logo_header";
        }else{
            $Request['logo_header'] =  $Companysetting->logo_header;
        }
        $Companysetting->update($Request->all());
       return response()->json(['status'=>true,'msg'=>'Setting updated']);
    }
    public function contactupdate(Request $Request){
      
        $Companysetting = Companysetting::where('id',1)->first();
        $cname = [];$ctitle = [];$cemail = [];$cmobile = [];$cphone = [];
        foreach ($Request->kt_docs_repeater_basic as $key => $value) {
            # code...
            $cname[] = $value['cname'];$ctitle[] = $value['ctitle'];$cemail[] = $value['cemail'];$cmobile[] = $value['cmobile'];$cphone[] = $value['cphone'];
        }
        $Country = Country::where('id',$Request->country_id)->first();
        if($Country){
            $currencySelect = Currency::where('countryname',$Country->country_name)->first();
            if($currencySelect) $Request['currencie_id'] = $currencySelect->id;
        }

        $Request['cname'] = \implode(',',$cname);
        $Request['ctitle'] = \implode(',',$ctitle);
        $Request['cemail'] = \implode(',',$cemail);
        $Request['cmobile'] = \implode(',',$cmobile);
        $Request['cphone'] = \implode(',',$cphone);
        $Companysetting->update($Request->all());
       return response()->json(['status'=>true,'msg'=>'Contact updated']);
    }
    
    public function update(Request $Request){
        $Companysetting = Companysetting::where('id',1)->first();
        
//          $rules=[
// 			'logo_login_page' => 'required:companysettings,logo_login_page,'.$Companysetting->id,
// 			'logo_header' => 'required:companysettings,logo_header,'.$Companysetting->id,
// 		];

// 		$customs=[
// 			'logo_login_page.required' => 'Logo (Login) should be filled',
// 			'logo_header.required' => 'Logo (Header) should be filled',
// 		];

//         $validator = Validator::make($Request->all(), $rules,$customs);

//         if ($validator->fails()) {
//           return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
//         }
        
        $cname = [];$ctitle = [];$cemail = [];$cmobile = [];$cphone = [];
        foreach ($Request->kt_docs_repeater_basic as $key => $value) {
            # code...
            $cname[] = $value['cname'];$ctitle[] = $value['ctitle'];$cemail[] = $value['cemail'];$cmobile[] = $value['cmobile'];$cphone[] = $value['cphone'];
        }
        $Country = Country::where('id',$Request->country_id)->first();
        if($Country){
            $currencySelect = Currency::where('countryname',$Country->country_name)->first();
            if($currencySelect) $Request['currencie_id'] = $currencySelect->id;
        }

        $Request['cname'] = \implode(',',$cname);
        $Request['ctitle'] = \implode(',',$ctitle);
        $Request['cemail'] = \implode(',',$cemail);
        $Request['cmobile'] = \implode(',',$cmobile);
        $Request['cphone'] = \implode(',',$cphone);

        // dd(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->logo_login_page"));
        // if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->logo_login_page")){
        //     Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->logo_login_page","/uploadFiles/setting/$Request->logo_login_page");
        // }
        // if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->logo_header")){
        //     Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->logo_header","/uploadFiles/setting/$Request->logo_header");
        // }
        // $Request['logo_login_page'] =  "/uploadFiles/setting/$Request->logo_login_page";
        // $Request['logo_header'] =  "/uploadFiles/setting/$Request->logo_header";


        if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->logo_login_page") && $Request->logo_login_page){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->logo_login_page","/uploadFiles/user/$Request->logo_login_page");
            $Request['logo_login_page'] =  "/uploadFiles/user/$Request->logo_login_page";
        }else{
            $Request['logo_login_page'] =  $Companysetting->logo_login_page;
        }
        
        if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->logo_header") && $Request->logo_header){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->logo_header","/uploadFiles/user/$Request->logo_header");
            $Request['logo_header'] =  "/uploadFiles/user/$Request->logo_header";
        }else{
            $Request['logo_header'] =  $Companysetting->logo_header;
        }
        
          
        $Request->status = (isset($Request->status)?1:0);

        $Companysetting->fill($Request->all());
        $Companysetting->currencie_id = $Request->currencie_id;
        $Companysetting->time_zone = $Request->time_zone;
        $Companysetting->logo_login_page = $Request->logo_login_page;
        $Companysetting->logo_header = $Request->logo_header;
        $Companysetting->status = $Request->status;
        $Companysetting->update();

       return response()->json(['msg'=>'Company updated']);
    }
}
