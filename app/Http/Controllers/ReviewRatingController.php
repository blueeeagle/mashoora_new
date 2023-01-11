<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Firm;
use App\Models\Review;
use App\Models\Consultant;
use App\Models\Customer;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;

class ReviewRatingController extends Controller
{
    public function __construct()
    {
        // $this->middleware('Permissions:Review_View',['only'=>['index']]);

    }
    public function index(){
        return view('review.index');
    }

    public function datatable(Request $request,Consultant $consultant = null){
        
        if(!empty($consultant)){ $datas = Review::with('customer.country','consultant.country')->where('consultant_id',$consultant->id)->orderBy('id','desc')->get(); }
        else $datas = Review::with('customer.country','consultant.country')->orderBy('id','desc')->get();

        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('created_at',function(Review $data){
            return date('Y-m-d',\strtotime($data->created_at));
        })
        ->addColumn('action',function(Review $data){
            return ['delete'=>\route('review.delete',$data->id)];
        })
        ->toJson(); //--- Returning Json Data To Client Side
    }
public function datatable_customer(Request $request,Customer $customer){
        
        $datas = Review::with('customer.country','consultant.country')->where('customer_id',$customer->id)->orderBy('id','desc')->get();
        
        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('created_at',function(Review $data){
            return date('Y-m-d',\strtotime($data->created_at));
        })
        ->addColumn('action',function(Review $data){
            return ['delete'=>\route('review.delete',$data->id)];
        })
        ->toJson(); //--- Returning Json Data To Client Side
    }
	public function delete(Review $review){
        $review->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
    }
}
