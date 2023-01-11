<?php
namespace App\Http\Controllers;

use DataTables;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Adminpayment;
use App\Models\Wallet;
use App\Models\Appointment;
use App\Models\OfferPurchase;
use DB;
class Adminpaymentcontroller extends Controller{

    public function index(){
        $Wallet = Wallet::where('id',0)->first();
        $profit = Adminpayment::sum('com_amount');
        return view('Report.report',['wallet'=>$Wallet,'profit'=>$profit]);
    }

    public function datatable(Request $request){
        $Adminpayment = Adminpayment::with('customer','consultant')->orderBy('id','desc')->get();
        
        return DataTables::of($Adminpayment)
        ->addIndexColumn()
        ->editColumn('amount', function(Adminpayment $datas) {
            return round($datas->amount,2);
        })
        ->editColumn('com_amount', function(Adminpayment $datas) {
            return round($datas->com_amount,2);
        })
        ->editColumn('customer_id', function(Adminpayment $datas) {
            return $datas->customer;
        })
        ->editColumn('consultant_id', function(Adminpayment $datas) {
            return $datas->consultant;
        })
         ->editColumn('Details', function(Adminpayment $datas) {
            if($datas->appointment_id) return ['type'=>'Booking','id'=>$datas->appointment_id];
            else if ($datas->offerpurchase_id) return ['type'=>'Offer purchase','id'=>$datas->offerpurchase_id];
            else return ['type'=>'','id'=>""];
        })
        ->toJson();
    }
    public function revenue(Request $request){
        $profit = Adminpayment::sum('com_amount');
        return view('Report.revenue',['profit'=>$profit]);
    }

    public function chartrevenue(Request $request){
        $Mounth = [];
        if(is_numeric($request->year) == 1){
            $Mounth = ['Jan'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0],'Feb'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0],'Mar'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0],
            'Apr'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0],'May'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0],'Jun'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0],
            'Jul'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0],'Aug'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0],'Sep'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0],
            'Oct'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0],'Nov'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0],'Dec'=>['year'=>$request->year,'app_com'=>0,'off_com'=>0,'total'=>0]];


            $Appointment = Adminpayment::where( DB::raw("year(`created_at`)"), '=', $request->year)->whereNotNull('appointment_id')
            ->select(DB::raw("DATE_FORMAT(`created_at`, '%b') as month, DATE_FORMAT(`created_at`, '%Y') as Year, COUNT(com_amount) as total, sum(com_amount) as con_com"))
            ->groupBy(['month','Year'])
            ->get();

            $offerpurchases = Adminpayment::where( DB::raw("year(`created_at`)"), '=', $request->year)->whereNotNull('offerpurchase_id')
            ->select(DB::raw("DATE_FORMAT(`created_at`, '%b') as month, DATE_FORMAT(`created_at`, '%Y') as Year, COUNT(com_amount) as total, sum(com_amount) as con_com"))
            ->groupBy(['month','Year'])
            ->get();

        }else{

            $Appointment = Adminpayment::where('created_at', '<=', now())->where('created_at', '>=', DB::raw("Date_add(Now(),interval - 12 month)"))->whereNotNull('appointment_id')
            ->select(DB::raw("DATE_FORMAT(`created_at`, '%b') as month, DATE_FORMAT(`created_at`, '%Y') as Year, COUNT(com_amount) as total, sum(com_amount) as con_com"))
            ->groupBy(['month','Year'])
            ->get();

            $offerpurchases = Adminpayment::where('created_at', '<=', now())->where('created_at', '>=', DB::raw("Date_add(Now(),interval - 12 month)"))->whereNotNull('offerpurchase_id')
            ->select(DB::raw("DATE_FORMAT(`created_at`, '%b') as month, DATE_FORMAT(`created_at`, '%Y') as Year, COUNT(com_amount) as total, sum(com_amount) as con_com"))
            ->groupBy(['month','Year'])
            ->get();

            for ($i=0; $i <= 11; $i++) { $Mounth[date("M",strtotime("-$i month"))] = ['year'=>date("Y",strtotime("-$i month")),'app_com'=>0,'off_com'=>0,'total'=>0];}
        }

        $total = 0;

        foreach ($Mounth as $key => &$value) {
            foreach ($Appointment as $key1 => $value1) {
                if($value1->month == $key){
                    $total += $value1->con_com;
                    $value['app_com'] = $value1->con_com;
                }
            }
            foreach ($offerpurchases as $key1 => $value1) {
                if($value1->month == $key){
                    $total += $value1->con_com;
                    $value['off_com'] = $value1->con_com;
                }
            }
            $value['total'] = $value['app_com'] + $value['off_com'];
        }

        return response()->json(['chart'=>$Mounth,'total'=>$total], 200);
    }
    
    public function appChart(Request $request){
        $Total = Appointment::count();
        $Pending = Appointment::where('status','Pending')->count();
        $Cancelled = Appointment::where('status','Cancelled')->count();
        $Confirmed = Appointment::where('status','Confirmed')->count();
        $NoShowByCustomer = Appointment::where('status','NoShowByCustomer')->count();
        $NoShowByConsultant = Appointment::where('status','NoShowByConsultant')->count();
        $Completed = Appointment::where('status','Completed')->count();

        return view('Report.appoinment',['total' => $Total,'Pending' => $Pending,'Cancelled' => $Cancelled,'Confirmed' => $Confirmed,'NoShowByCustomer' => $NoShowByCustomer,'NoShowByConsultant' => $NoShowByConsultant,'Completed' => $Completed,]);
    }

    public function appChartdata(Request $request){
        $Mounth = [];
        if(is_numeric($request->year) == 1){
            $Mounth = ['Jan'=>['year'=>$request->year,'total'=>0],'Feb'=>['year'=>$request->year,'total'=>0],'Mar'=>['year'=>$request->year,'total'=>0],
            'Apr'=>['year'=>$request->year,'total'=>0],'May'=>['year'=>$request->year,'total'=>0],'Jun'=>['year'=>$request->year,'total'=>0],
            'Jul'=>['year'=>$request->year,'total'=>0],'Aug'=>['year'=>$request->year,'total'=>0],'Sep'=>['year'=>$request->year,'total'=>0],
            'Oct'=>['year'=>$request->year,'total'=>0],'Nov'=>['year'=>$request->year,'total'=>0],'Dec'=>['year'=>$request->year,'total'=>0]];


            $Appointment = Appointment::where( DB::raw("year(`created_at`)"), '=', $request->year)
            ->select(DB::raw("DATE_FORMAT(`created_at`, '%b') as month, DATE_FORMAT(`created_at`, '%Y') as Year , status"))
            ->get();

        }else{

            $Appointment = Appointment::where('created_at', '<=', now())->where('created_at', '>=', DB::raw("Date_add(Now(),interval - 12 month)"))
            ->select(DB::raw("DATE_FORMAT(`created_at`, '%b') as month, DATE_FORMAT(`created_at`, '%Y') as Year, status"))
            ->get();

            for ($i=0; $i <= 11; $i++) { $Mounth[date("M",strtotime("-$i month"))] = ['year'=>date("Y",strtotime("-$i month")),'total'=>0];}
        }
        foreach ($Mounth as $key => $value) {
            $Mounth[$key]['data'] = ['Pending'=>0,'Cancelled'=>0,'Started'=>0,'Completed'=>0,'Confirmed'=>0,'NoShowByCustomer'=>0,'NoShowByConsultant'=>0,'Reject'=>0];
        }
        $total = 0;
        foreach ($Appointment as $key => $value) {
            # code...
            $Mounth[$value->month]['data'][$value->status] += 1;
            $Mounth[$value->month]['total'] += 1;
            $total += 1;
        }

        return response()->json(['chart'=>$Mounth,'highest'=>$total+5], 200);
    }
}
