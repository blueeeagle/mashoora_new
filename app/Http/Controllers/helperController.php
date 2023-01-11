<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CurrencyDataTable;
use App\Models\Firm;
use App\Models\Category;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use DataTables;
use App\Models\Country;
use Validator;
use App\Models\Currency;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\Companysetting;
use App\Models\Language;
use App\Models\Appointment;
use App\Models\Agorachat;
use App\Models\NotificationTemplate;
use Auth;
use Illuminate\Support\Facades\Hash;
Use Log;

class helperController extends Controller
{
    public function getcountry(){
        $Country  = Country::where('status','1')->get();
        return DataTables::of($Country)->addIndexColumn()->toJson();
        // return response()->json(array('Country' => $Country));
    }
    public function getState(Request $request){

        $rules=[ 'id' => 'required' ];
		$customs=[ 'id.required'  => 'Choose Country' ];
        $validator = Validator::make($request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $Country  = Country::where('id',$request->id)->first();
        if(!$Country){ return response()->json('country not found', 200);  }

        if($Country->has_state){
            $State = State::where('status',1)->where('country_id',$Country->id)->get();
            return response()->json(array('has_state'=>true,'state'=>$State), 200);
        }else{
            $City = City::where('status',1)->where('country_id',$Country->id)->get();
            return response()->json(array('has_state'=>false,'city'=>$City), 200);
        }
    }

    public function getCity(Request $request){

        $rules=[ 'id' => 'required' ];
		$customs=[ 'id.required'  => 'Choose State' ];
        $validator = Validator::make($request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

    	$City = City::where('status',1)->where('state_id',$request->id)->get();
        return response()->json(array('city'=>$City), 200);
    }

    public function company(Request $request){
        $Companysetting = Companysetting::with('country')->first();
    	return response()->json($Companysetting);
    }
public function firm(){
        if(Auth::guard('consultant')->check()){
            $Firm = Firm::where('status',1)->where('approval',2)->where('country_id',Auth::guard('consultant')->user()->country->id)->get();
            return response()->json(['firm'=>$Firm]);
        }
        $Firm = Firm::where('status',1)->where('approval',2)->get();
        return response()->json(['firm'=>$Firm]);
    }
    public function language(){
        $Language = Language::where('status',1)->get();
        return response()->json(['langauge'=>$Language]);
    }
    public function uploadimage(Request $Request){
        if($Request->has('image')){
            $img = explode(";", $Request->image);
            $img = explode(",", $img[1]);
            $data = base64_decode($img[1]);
            $imageName = time() . '.png';
            file_put_contents(public_path().'/storage/uploadFiles/temp/'.$imageName, $data);
            return response()->json(['Name'=>$imageName], 200);
        }
    }
    
    public function getCategory(Request $request)
    
    {
        $mainCategory = Category::where('type',0)->where('status',1)->orderBy('sort_no_list')->get();
        $subCategory = Category::where('categories_id',$request->category_id)->where('status',1)->orderBy('sort_no_list')->get();
        return response()->json(['mainCategory'=>$mainCategory,'subCategory'=>$subCategory], 200);
    }

    public function get_user(Request $request)
    {   $password = Hash::make($request->password);
        $user = User::where('email',$request->email)->first();

        if(!password_verify($request->password, optional($user)->getAuthPassword())) return response()->json(['status'=>false], 200);
        $phone = $user->country->dialing.' '.$user->phone;
        
        return response()->json(['status'=>true,'is_two_way'=>$user->is_two_way_auth,'phone'=>$phone], 200);
    }

    public static function email($user,$data,$type)
    {
        $notification = NotificationTemplate::where('type',$type)->first();
        if($notification){
            //try {
            
                $body = (new static)->generateBody($data,$notification->description,$type);
                
                \Mail::send('email', ['notification' => $notification,'body' => strip_tags($body),'title' => $notification->title], function($message) use($notification,$user){
                    $message->to($user['email'], $user['name'])->subject($notification->title);
                });
                
                echo "Email sent successfully";
            // } catch (\Throwable $th) {
            //     //throw $th;
            //     return;
            // }
        }      
    }
    
    public function send_email()
    {
        // $body="Testing";
        
        // return view('email',compact('body'));
        
        $id=115;
        $user = User::find($id);
        
        $user1=array('email'=>$user->email,'name'=>$user->first_name);

        $template1=NotificationTemplate::where('type','=',2)->first();
        $template2=NotificationTemplate::where('type','=',5)->first();
        $template3=NotificationTemplate::where('type','=',8)->first();    
       
        $data=array($user->first_name,$user->email,$user->phone,$user->created_at);

        if($template1)
        {
            helperController::email($user1,$data,2);
        }
        if($template2)
        {
            helperController::email($user1,$data,5);
        }
        if($template3)
        {
            helperController::email($user1,$data,8);
        } 
    }

    public static function generateBody($data,$str,$type){
        $replace=NotificationController::variables($type);
        return str_replace($replace, $data, $str);
    }
    public function getchild(Request $Request){
        $child = Category::where('categories_id',$Request->id)->where('status',1)->orderBy('name','ASC')->get();
    	return response()->json(['child'=>$child]);
    }
    public function SaveChatData(Request $request, Appointment $Appointment){
        $consultant_id = $Appointment->consultant_id;
        $customer_id = $Appointment->customer_id;
        $appointment_id = $Appointment->id;

        if(!$request->chat){
            return response()->json(['status'=>false,'msg'=>'Required Chat Data']);
        }
        $UploadData = [];
        $Chat = \json_decode($request->chat);
        foreach ($Chat->text as $key => $value) {
            # code...
            $UploadData[] = [
                'consultant_id' =>$consultant_id,
                'customer_id' =>$customer_id,
                'appointment_id' =>$appointment_id,
                'text' =>$value->text,
                'fromId' =>$value->fromId,
                'toId' =>$value->toId,
                'timeStamp' =>$value->timeStamp,
                'dateTime' =>$value->dateTime,
            ];

        }
        $response = Agorachat::insert($UploadData);
        return response()->json(['status'=>true,'msg'=>'Data Saved']);
    }
    public function getchatdata(Request $request, Appointment $Appointment){
        $data = Agorachat::where('appointment_id',$Appointment->id)->get();
        return response()->json(['status'=>true,'data'=>$data]);
    }
    
    public function paymentsuccess(Request $request){
        Log::info($request->all());
    }
    public function paymentfail(Request $request){
        Log::info($request->all());
    }
    
}
