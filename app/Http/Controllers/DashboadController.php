<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer;
use App\Models\Consultant;
use App\Models\Firm;
use App\Models\Appointment;
use App\Models\PayApproval;
use DataTables;
use Validator;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DB;

class DashboadController extends Controller
{
    public function __construct(){ }

    public function index(Request $request){
        $Firmapprovel = Firm::where('approval',0)->count();
        $Appointment = Appointment::where('pay_in',1)->count();
        $PayApproval = PayApproval::where('pay_out',0)->count();
        return view('pages.index',[
            'customer'=>$this->getcustomer_data(),
            'consultant'=>$this->getconsultant_data(),
            'Firmapprovel'=>$Firmapprovel,
            'payIn'=>$Appointment,
            'PayOut'=> $PayApproval
        ]);
    }

    public function customer_filter(Request $request){
        $Mounth = [];
        if(is_numeric($request->year) == 1){
             $Mounth = ['Jan'=>['year'=>$request->year,'total'=>0],'Feb'=>['year'=>$request->year,'total'=>0],'Mar'=>['year'=>$request->year,'total'=>0],
            'Apr'=>['year'=>$request->year,'total'=>0],'May'=>['year'=>$request->year,'total'=>0],'Jun'=>['year'=>$request->year,'total'=>0],
            'Jul'=>['year'=>$request->year,'total'=>0],'Aug'=>['year'=>$request->year,'total'=>0],'Sep'=>['year'=>$request->year,'total'=>0],
            'Oct'=>['year'=>$request->year,'total'=>0],'Nov'=>['year'=>$request->year,'total'=>0],'Dec'=>['year'=>$request->year,'total'=>0]];
            $Customer = Customer::where( DB::raw("year(`created_at`)"), '=', $request->year)
            ->select(DB::raw(" DATE_FORMAT(`created_at`, '%b') as month, COUNT(*) as total"))
            ->groupBy('month')
            ->get()->pluck('total','month');
        }else{
            $Customer = Customer::where('created_at', '<=', now())->where('created_at', '>=', DB::raw("Date_add(Now(),interval - 12 month)"))
            ->select(DB::raw(" DATE_FORMAT(`created_at`, '%b') as month, COUNT(*) as total"))
            ->groupBy('month')
            ->get()->pluck('total','month');
            for ($i=0; $i <= 11; $i++) { $Mounth[date("M",strtotime("-$i month"))] = ['year'=>date("Y",strtotime("-$i month")),'total'=>0];}
        }
        $chartData = [];
        $total = 0;
        $highest = 0;
        foreach ($Mounth as $key => &$value) { 
            foreach ($Customer as $key1 => $value1) {
                if($key1 == $key){ 
                    $total += $value1;
                    $Mounth[$key]['total'] = $value1;
                    ($highest < $value1)?$highest = $value1 :'';
                }   
            }
        }
        
        return response()->json(['chart'=>$Mounth,'total'=>$total,'highest'=>$highest+5], 200);
    }

    public function consultant_filter(Request $request){
        $Mounth = [];
        if(is_numeric($request->year) == 1){
            $Mounth = ['Jan'=>['year'=>$request->year,'total'=>0],'Feb'=>['year'=>$request->year,'total'=>0],'Mar'=>['year'=>$request->year,'total'=>0],
            'Apr'=>['year'=>$request->year,'total'=>0],'May'=>['year'=>$request->year,'total'=>0],'Jun'=>['year'=>$request->year,'total'=>0],
            'Jul'=>['year'=>$request->year,'total'=>0],'Aug'=>['year'=>$request->year,'total'=>0],'Sep'=>['year'=>$request->year,'total'=>0],
            'Oct'=>['year'=>$request->year,'total'=>0],'Nov'=>['year'=>$request->year,'total'=>0],'Dec'=>['year'=>$request->year,'total'=>0]];
            $Consultant = Consultant::where( DB::raw("year(`created_at`)"), '=', $request->year)
            ->select(DB::raw(" DATE_FORMAT(`created_at`, '%b') as month, COUNT(*) as total"))
            ->groupBy('month')
            ->get()->pluck('total','month');
        }else{
            $Consultant = Consultant::where('created_at', '<=', now())->where('created_at', '>=', DB::raw("Date_add(Now(),interval - 12 month)"))
            ->select(DB::raw(" DATE_FORMAT(`created_at`, '%b') as month, COUNT(*) as total"))
            ->groupBy('month')
            ->get()->pluck('total','month');
            for ($i=0; $i <= 11; $i++) { $Mounth[date("M",strtotime("-$i month"))] = ['year'=>date("Y",strtotime("-$i month")),'total'=>0];}
        }
        $chartData = [];
        $total = 0;
        $highest = 0;
        foreach ($Mounth as $key => &$value) { 
            foreach ($Consultant as $key1 => $value1) {
                if($key1 == $key){ 
                    $total += $value1;
                    $Mounth[$key]['total'] = $value1;
                    ($highest < $value1)?$highest = $value1 :'';
                }   
            }
        }

        return response()->json(['chart'=>$Mounth,'total'=>$total,'highest'=>$highest+5], 200);
    }


    function getcustomer_data(){
        $Total_customer = Customer::count();
        $Active_customer = Customer::where('status',1)->count();
        $Dective_customer = Customer::where('status',0)->count();
        return ['Total'=>$Total_customer,'Active'=>$Active_customer,'Deactive'=>$Dective_customer];
    }
    function getconsultant_data(){
        $Total_consultant = Consultant::count();
        $Active_consultant = Consultant::where('approval',2)->count();
        $Dective_consultan = Consultant::where('approval',1)->count();
        $pending_consultant = Consultant::where('approval',0)->count();

        return ['Total'=>$Total_consultant,'Active'=>$Active_consultant,'Deactive'=>$Dective_consultan,'pending'=>$pending_consultant];
    }
}
