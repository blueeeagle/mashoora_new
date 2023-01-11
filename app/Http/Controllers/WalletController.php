<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Firm;
use App\Models\PurchaseHistory;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;

class WalletController extends Controller
{
  
    public function index(){
        return view('consultant.wallet.index');
    }

    public function datatable(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Wallet::with('consultant')->orderBy('id','desc')->get();

        // dd($datas);
        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('date_time', function(Wallet $datas) {
            return date('d-m-Y H:i:s',strtotime($datas->date_time));;
        })
        ->editColumn('created_by', function(Wallet $datas) {
            return  $datas->created_at->format('d/m/Y H:i:s');
        })
        ->editColumn('consultant_id', function(Wallet $datas) {
            $consultant = $datas->consultant;
            return ($consultant)? 'Appointment Cancelled by '.$consultant->name.'and Booking ID - '. $datas->booking_id: '';
        })
        
        ->editColumn('type', function(Wallet $datas) {
            if($datas->type == 1) return 'Audio';
            if($datas->status == 2) return 'Video';
            if($datas->status == 3) return 'Text';
           
           
        })
        ->editColumn('status', function(Wallet $datas) {
            if($datas->status == 1) return '<button class="btn btn-success btn-sm">PAYMENT IN</button>';
            if($datas->status == 2) return '<button class="btn btn-danger btn-sm">PAYMENT OUT</button>';
            else return '<button class="btn btn-secondary btn-sm">N/A</button>';
           
        })
        ->rawColumns(['status'])
        ->toJson();
    }

    

}
