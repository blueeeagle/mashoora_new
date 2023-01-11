<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Firm;
use App\Models\PurchaseHistory;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;

class PurchaseHistoryController extends Controller
{
  
    public function index(){
        return view('history.purchase.index');
    }

    public function datatable(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = PurchaseHistory::orderBy('id','desc')->get();

        // dd($datas);
        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('created_at', function(PurchaseHistory $datas) {
            return  $datas->created_at->format('d/m/Y H:i:s');
        })
        ->editColumn('status', function(PurchaseHistory $datas) {
            if($datas->status == 0) return '<button class="btn btn-success btn-sm">Completed</button>';
            if($datas->status == 1) return '<button class="btn btn-danger btn-sm">Cancelled</button>';
            if($datas->status == 2) return '<button class="btn btn-primary btn-sm">Booked</button>';
            if($datas->status == 3) return '<button class="btn btn-info btn-sm">In Process</button>';
        })
        ->rawColumns(['status'])
        ->toJson();
    }

    

}
