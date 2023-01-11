<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Firm;
use App\Models\OfferPurchase;
use Illuminate\Support\Facades\Input;
use DataTables;
use Illuminate\Support\Collection;
use Validator;
use App\Models\Consultant;
use App\Models\Customer;

class OfferHistoryController extends Controller
{

    public function index(){
        return view('history.offer.index');
    }

 public function datatable(Request $request,$id = null,$type = null){
        $datas = OfferPurchase::with('customer','consultant')->orderBy('id','desc')->get();
        if($type == 'consultant'){
            $consultant = Consultant::where('id',$id)->first();
            if(!empty($consultant)) $datas = OfferPurchase::with('customer','consultant')->where('consultant_id',$consultant->id)->orderBy('id','desc')->get();
        }
        if($type == 'customer'){
            $Customer = Customer::where('id',$id)->first();
            if(!empty($Customer)) $datas = OfferPurchase::with('customer','consultant')->where('customer_id',$Customer->id)->orderBy('id','desc')->get();
        }
        
        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('customer_id', function(OfferPurchase $datas) {
            if(isset($datas->customer)) $datas->customer->country;
            return $datas->customer;
        })
        ->addColumn('consultant_id', function(OfferPurchase $datas) {
            return $datas->offer->consultant;
        })
        ->addColumn('cus_amount', function(OfferPurchase $datas){
            $admin_amount = $datas->amount/$datas->offer->consultant_currency->price;
            return ['customer_currency'=>$datas->offer->customer_currency,'customer_amount'=>$datas->offer->amount_converted,
            'admin_currency'=>$datas->offer->admincurrnecy,'admin_amount'=>$admin_amount];
        })
        ->addColumn('consultant_amount', function(OfferPurchase $datas){
            $ComissionAmount = empty($datas->offer->consultant->com_off_type) || $datas->offer->consultant->com_off_type == NULL?'Consultant Offer Not Added':$this->calcomamount($datas->offer->consultant->com_off_type,$datas->amount,$datas->offer->consultant->com_off_amount);
            $admin_amount = empty($datas->offer->consultant->com_off_type) || $datas->offer->consultant->com_off_type == NULL?'Consultant Offer Not Added':$ComissionAmount/$datas->offer->consultant_currency->price;
            return ['consultant_currenct'=>$datas->offer->consultant_currency,'consultant_amount'=>$datas->offer->amount,'ComissionAmount'=>$ComissionAmount,
            'admin_currency'=>$datas->offer->admincurrnecy,'admin_comission'=>$admin_amount];
        })
        ->addColumn('checkofferfee', function($datas){
            return $datas->consultant->checkofferfee();
        })
        ->addColumn('action', function($datas){
            return $datas->consultant->checkofferfee();
        })
        ->toJson();
    }

    function calcomamount($type,$amount,$com){
        if($type == 0) return $com;
        return ($amount/100)*$com;
    }

}
