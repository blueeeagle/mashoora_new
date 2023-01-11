<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Appointment;
use App\Models\NotificationSetting;
use App\Models\NotificationTemplate;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;

class NotificationController extends Controller
{

    public function index(){
        $datas = NotificationSetting::where('status',1)->get()->pluck('id')->toArray();
        return view('notification.index',compact('datas'));
    }

    public function store(Request $request)
    {
        $type = $request->type;
        $not = NotificationSetting::whereIn('id',$type)->update(['status'=>1]);
        $not = NotificationSetting::whereNotIn('id',$type)->update(['status'=>0]);
        $data1['msg'] = 'Created Successfully';
        return response()->json($data1);
    }

    public function template_store(Request $request)
    {
        $requestedData=$request->all();
        $rules=[
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];
        $customs=[
            'title.required'  => 'Title Should be filled',
            'description.required'  => 'Description Should be filled',
        ];
		$validator = Validator::make($request->all(), $rules,$customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $notify=NotificationSetting::where('type',$request->type)->first();
        if($notify)
        {
            $notify->title=$request->title;
            $notify->description=$request->description;
            $notify->update();
        }else{
            $notify->type=$request->type;
            $notify->title=$request->title;
            $notify->description=$request->description;
            $notify->update();
        }

		$data1['msg'] = 'Created Successfully';
        $data1['status'] = true;
        return response()->json($data1);
    }


    public function variables($value){
        
        $notify=NotificationSetting::where('id',$value)->first();
        
        if($notify) return response()->json(['variable'=>$notify->getVariable(),'notify'=>$notify,'status'=>true]);
        else return ['status'=>false];
    }
}
