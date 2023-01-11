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
use Illuminate\Support\Facades\Storage;
class ScheduleController extends Controller{

    public function index(Request $request){
        $Schedule = Schedule::all();
        $getslots = $this->getslots($Schedule);
        return \view('schedule.index',['getslots'=>$getslots]);
    }

    public function create2(Request $request,Consultant $consultant){
        $Schedule = Schedule::where('consultant_id',$consultant->id)->get();
        $getslots = $this->getslots($Schedule);
       
        $schedule = Schedule::where('consultant_id',$consultant->id)->orderBy('id','desc')->first();
        return \view('schedule.create',['consultant'=>$consultant,'schedule'=>$schedule]);
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
            return 'From: '.$data->from_date.' <br/>To: '.$data->to_date;
        })
        ->addColumn('action', function(Schedule $data){
            return ['Delete'=> \route('activities.schedules.destroy',$data->id)];
        })
        ->addColumn('copy', function(Schedule $data){
            return ['copy'=> \route('activities.schedules.copy',$data->id)];
        })
        ->rawColumns(['action','fromto'])
        ->toJson();
    }

    public function copyschedule(Request $request,Schedule $schedule){
        $copy = $schedule->replicate();
        $copy->from_date = $request->from_date;
        $copy->to_date = $request->to_date;
        $copy->save();
        return response()->json(['status'=>true], 200);
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

    public function datatable(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Consultant::with('Allschedule')
        ->when($search[2],function($query,$search){  $search = \explode(',',$search);  return $query->whereIn('categorie_id',$search); })
        ->when($search[2],function($query,$search){  $search = \explode(',',$search);  return $query->whereIn('categorie_id',$search); })
        ->when($search[2],function($query,$search){  $search = \explode(',',$search);  return $query->whereIn('categorie_id',$search); })
        ->when($search[2],function($query,$search){  $search = \explode(',',$search);  return $query->whereIn('categorie_id',$search); })
        ->orderBy('id','desc')->get();

        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('Last_Config',function(Consultant $data){
            $schedule = $data->Allschedule->last();
            if($schedule) return 'From: '.$schedule->from_date.' <br/>To: '.$schedule->to_date;
            return '';
        })
         ->addColumn('details',function(Consultant $data){
            return "Name :".$data->name."<br/>Mobile : ".$data->country->dialing.' '.$data->phone_no.'<br/> TimeZone : '.$data->gettimeZone()->format('e P');
        })
         ->addColumn('country',function(Consultant $data){
            return $data->country->country_name ?? '';
        })
        ->editColumn('categorie_id', function(Consultant $data){
            $category = $data->parentcat();
            $subCategory = $data->subcat()->pluck('name')->toArray();
            return ['cat'=>$category->name ?? '','sub'=>$subCategory];
        })
        ->addColumn('Schedule_type',function(Consultant $data){
            $schedule = $data->Allschedule->last();
            if($schedule) return ($schedule->schedule_type == 0)?'standard':'varient';
            return '';
        })
        ->editColumn('picture', function(Consultant $data){
            if(!isset($data->picture)) return "";
            $exists = Storage::disk('public_custom')->exists($data->picture);
            if($exists) return asset("storage/$data->picture");
            return "";
        })
        ->addColumn('lastUpDate',function(Consultant $data){
            $schedule = $data->Allschedule->last();
            if($schedule) return date('m/d/y', strtotime($schedule->created_at));
            return '';
        })
        ->addColumn('scheduleOrNot',function(Consultant $data){
            if(!$data->Schedule->isEmpty()) return 1;
            return 0;
        })
        ->addColumn('view', function(Consultant $data){
            return ['view'=> \route('activities.schedules.create2',$data->id)];
        })
        ->rawColumns(['view','Last_Config','details'])
        ->toJson();
    }

    public function getAllschedule(Consultant $consultant){

        $Schedule = $consultant->Allschedule;
        $getslots = $this->getslots($Schedule);
        $fromDate = $consultant->Schedule->last()->to_date ?? date('m/d/Y');
        return ['getslots'=>$getslots,'fromDate'=>$fromDate];
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

        //Assaning Date for repeat
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
        $AppointmentCount = Appointment::where('schedule_id',$schedule->id)->count();
        if($AppointmentCount != 0){
            $data1['msg'] = 'Schedule has Appointment.';
            $data1['status'] = false;
            return response()->json($data1);
        }
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
        $Schedule->from_date = $request->from_date;
        $Schedule->to_date = $request->to_date;
        $Schedule->recurring = $request->to_date;
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
        return $request->kt_docs_repeater_nested_outer;
    }
}
