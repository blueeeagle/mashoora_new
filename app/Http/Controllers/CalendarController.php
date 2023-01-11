<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Consultant;
use App\Models\Appointment;
use Auth;
use Validator;
use DataTables;
use Illuminate\Support\Str;

class CalendarController extends Controller{

    public function index(Request $request){
        $Schedule = Schedule::all();
        $getslots = $this->getslots($Schedule);
        return \view('calendar.index',['getslots'=>$getslots]);
    }
    public function getappdetails(Request $request){
        
        $Appointment = Appointment::with('customer')->with('consultant')->where('map',$request->id)->first();
        $status =  isset($Appointment->status) ? ($Appointment->status) : 'Booked';
        
        if($status == 1) $status = 'Completed';
        if($status == 2) $status = 'Cancelled By Consultant';
        if($status == 3) $status = 'Cancelled By Customer';
        if($status == 4) $status = 'Cancelled By Admin';
        
        return ['appointment'=>$Appointment,'status'=>$status];
    }
    public function appointmentIndex(Request $Request,Consultant $consultant)
    {
        return \view('schedule.appointment',['consultant'=>$consultant]);
    }

    public function appStatus(Request $request){
        // dd($request);
        $Appointment = Appointment::where('map',$request->map)->first();
        $Appointment->status = $request->status;
        $Appointment->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }

    public function create2(Request $request,Consultant $consultant){
        // dd($consultant);
        return \view('schedule.create',['consultant'=>$consultant]);
    }

    public function getscheduleDatatable(Request $request){

        $datas = Schedule::where('consultant_id',$request->id)->orderBy('id','desc')->get();

        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('created_at', function(Schedule $data){
            $date = date_create($data->created_at);
            return date_format($date,"Y-m-d");
        })
        ->addColumn('fromto', function(Schedule $data){
            $from_date = date_create($data->from_date);
            $to_date = date_create($data->to_date);
            return 'From : '.date_format($from_date,"Y-m-d").' <br>To : '.date_format($to_date,"Y-m-d");
        })
        ->addColumn('scheduleType', function(Schedule $data){
            return ($data->schedule_type==1)?'Variant':'Standard';
        })
        ->addColumn('action', function(Schedule $data){
            return ['Delete'=> \route('activities.schedules.destroy',$data->id)];
        })
        ->rawColumns(['action','fromto'])
        ->toJson();
    }

    public function datatable(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Consultant::with('Schedule')
        ->when($search[2],function($query,$search){  $search = \explode(',',$search);  return $query->whereIn('categorie_id',$search); })
        ->when($search[2],function($query,$search){  $search = \explode(',',$search);  return $query->whereIn('categorie_id',$search); })
        ->when($search[2],function($query,$search){  $search = \explode(',',$search);  return $query->whereIn('categorie_id',$search); })
        ->when($search[2],function($query,$search){  $search = \explode(',',$search);  return $query->whereIn('categorie_id',$search); })
        ->orderBy('id','desc')->get();

        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('Last_Config',function(Consultant $data){
            $schedule = $data->Schedule->last();
            if($schedule) return 'From: '.$schedule->from_date.' To: '.$schedule->to_date;
            return '';
        })
        ->addColumn('Schedule_type',function(Consultant $data){
            $schedule = $data->Schedule->last();
            if($schedule) return ($schedule->schedule_type == 0)?'standard':'varient';
            return '';
        })
        ->addColumn('lastUpDate',function(Consultant $data){
            $schedule = $data->Schedule->last();
            if($schedule) return date('y-m-d', strtotime($schedule->updated_at));
            return '';
        })
        ->addColumn('scheduleOrNot',function(Consultant $data){
            if(!$data->Schedule->isEmpty()) return 'Scheduled';
            return 'Not Scheduled';
        })
        ->addColumn('view', function(Consultant $data){
            return ['view'=> \route('activities.schedules.appointmentIndex',$data->id)];
        })
        ->rawColumns(['view'])
        ->toJson();
    }

    public function getAllschedule(Consultant $consultant){
        $Schedule = $consultant->Schedule;
        $getslots = $this->getslots($Schedule);
        return ['getslots'=>$getslots];
    }

    public function store(Request $request){
        if($request->schedule_type == 0){
            $this->Standard($request,null);
        }else{
            $this->Variant($request,null);
        }
    }

    
    

    public function editget(Schedule $schedules){

        $currntDay = strtotime($schedules->from_date);
        $toDay = strtotime($schedules->to_date);
        $schedule = json_decode($schedules->schedule);
        $days = [];
        $formData = [];

        //Assigning Date for repeat
        if($schedules->schedule_type == 0) $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        else {
            for ( $i = $currntDay; $i <= $toDay; $i = $i + 86400 ) {
                $days[]  = date("d/m/y", $i);
            }
        }

        foreach ($schedule as $key => $value) {
            # code...
            $inner = [];
            foreach ($value->kt_docs_repeater_nested_inner as $key1 => $value1) {
                # code...
                $inner[] = ['from'=>$value1->from,'to'=>$value1->to,'video'=>(isset($value1->video)?1:0),'voice'=>(isset($value1->voice)?1:0),'text'=>(isset($value1->text)?1:0),'direct'=>(isset($value1->direct)?1:0)];
            }
            if(!isset($value->day)) $formData[] = ['title'=>$days[$key],'day'=>$days[$key].',Off','kt_docs_repeater_nested_inner'=>$inner];
            else $formData[] = ['title'=>$value->day[0],'day'=>$value->day[0],'kt_docs_repeater_nested_inner'=>$inner];
        }
        dd($formData);
        return response()->json(['data'=>$formData,'schedules'=>$schedules,'url'=> route('activities.schedules.update',$schedules->id)]);

    }

    public function update(Request $request, Schedule $schedules){

        if($request->schedule_type == 0){
            $this->Standard($request,$schedules);
        }else{
            $this->Variant($request,$schedules);
        }
    }

    public function destroy(Request $request,Schedule $schedule){
        $schedule->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
    }

    function Standard($request,$Schedule){
        if($Schedule == null){
            $Schedule = new Schedule;
            $Schedule->consultant_id = $request->Consultamt_id;
        }
        $Schedule->schedule_type = 0;
        $Schedule->description = $request->description;
        $Schedule->from_date = \date('m/d/y');
        $Schedule->to_date = $request->recurring;
        $Schedule->recurring = $request->recurring;
        $Schedule->schedule = json_encode($this->generateSchedule($request));
        $Schedule->save();
       return response()->json(['msg'=>($Schedule)?'Schedule Updated':'Standard Add']);

    }

    function Variant($request,$Schedule){
        if($Schedule == null){
            $Schedule = new Schedule;
            $Schedule->consultant_id = $request->Consultamt_id;
        }
        $Schedule->schedule_type = 1;
        $Schedule->description = $request->description;
        $Schedule->from_date = $request->from_date;
        $Schedule->to_date = $request->to_date;
        $Schedule->schedule = json_encode($this->generateSchedule($request));
        $Schedule->save();
       return response()->json(['msg'=>($Schedule)?'Variant Updated':'Variant Add']);

    }

    function generateSchedule($request){
        // dd(json_encode($request->kt_docs_repeater_nested_outer));
        return $request->kt_docs_repeater_nested_outer;
    }
}
