<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Consultant;
use App\Models\Agorachat;
use App\Models\Appointment;
class ChatController extends Controller{
public function __construct()
    {
        // $this->middleware('Permissions:Char_View',['only'=>['index']]);

    }
    public function index(Request $Request){
        // dd(phpinfo());
        // $id = Agorachat::select('appointment_id')->where('customer_id',3)->get()->groupBy('appointment_id');
        // dd($id);
        $Customer = Customer::all();
        return view('chat.index',['Customer'=>$Customer]);
    }
    public function getcustomer(Request $Request){
        return response()->json(['customer' => Customer::select('id','email','phone_no','name')->whereNotNull('phone_no')->orderBy('name','ASC')->get() ]);
    }
    public function getconsultant(Request $Request){
        return response()->json(['customer' => Consultant::select('id','email','phone_no','name')->whereNotNull('phone_no')->orderBy('name','ASC')->get() ]);
    }
}
