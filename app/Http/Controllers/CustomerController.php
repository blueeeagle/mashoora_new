<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Country;
use App\Models\Consultant;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Input;
use DataTables;
use App\Models\Payment;
use App\Models\Appointment;
use Illuminate\Support\Collection;
use Validator;
use App\Models\Companysetting;


use App\Jobs\CustomerCreateJob;
use App\Jobs\CustomerAddAmountJob;
use App\Jobs\CustomerBookedJob;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('Permissions:Customer_View',['only'=>['index']]);
        $this->middleware('Permissions:Customer_Create',['only'=>['create']]);
        $this->middleware('Permissions:Customer_Edit',['only'=>['edit']]);
        $this->middleware('Permissions:Customer_delete',['only'=>['destroy']]);

    }
    
    public function datatableDashboard(Request $request){
        $datas = Customer::orderBy('id','desc')->limit(10)->get();
        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('action', function(Customer $data){
            return ['edit'=> \route('user.customer.edit',$data->id)];
        })
        ->editColumn('created_at', function (Customer $data){
            return  $data->created_at->format('d/m/Y H:i:s');
        })
        ->rawColumns(['action'])
        ->toJson();
    }
    
    public function index(){
        $Country = Country::all();
        $State = State::all();
        $City = City::all();
        return view('customer.index',['City'=>$City,'State'=>$State,'Country'=>$Country]);
    }
    
    public function view(Customer $customer){
        $customer = Customer::with('state','country','city','wallet','appointment','appointment_completed','appointment.transaction','reviews.consultant','wallet_trans','offer_history.consultant')->where('id',$customer->id)->get()->first();
        $app_completed = count($customer->appointment_completed);
        $consultant = Consultant::where('status',1)->get()->first();
        $countrys = Country::where('status',1)->get();
        $state =[];
        if($customer->country)
        {
            $state = State::where('status',1)->where('country_id',$customer->country->id)->get();
        }
        
        $city = City::where('status',1)->get();
        return \view('customer.view',['customer'=>$customer,'consultant'=>$consultant,'app_completed'=>$app_completed,'countrys'=>$countrys,'state'=>$state,'city'=>$city]);
    }

    public function datatable(Request $request){
        $Companysetting = Companysetting::where('id',1)->first();
         
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Customer::with('country')->with('state')->with('city')->when($search[1],function($query,$search){   return $query->where('phone_no','like',"%{$search}%");   })
        ->when($search[2],function($query,$search){   return $query->where('name','like',"%{$search}%")->orWhere('email','like',"%{$search}%");   })
        ->when($search[3],function($query,$search){   return $query->where('gender',$search);   })
        ->when($search[4],function($query,$search){ $search = explode(',',$search);  return $query->whereBetween('dob',$search);   })
        ->when($search[5],function($query,$search){   return $query->where('register_address','like',"%{$search}%");   })
        ->when($search[6],function($query,$search){   return $query->where('country_id',$search);   })
        ->orderBy('id','desc')->get();
        // dd($datas);
        return DataTables::of($datas)
        ->addIndexColumn()
        ->editColumn('name', function(Customer $data){
            $name = ($data->name)? $data->name:'';
            $email = ($data->email)? $data->email:'';
            $temp = 'Name: '.$name.'<br/>'.'Email: '.$email;
            return $temp;
        })
        // ->editColumn('dob', function(Customer $data) use($Companysetting){
        //     if($data->dob){
        //         $temp = $Companysetting->custom_date_time($data->dob);
        //         return $temp;
        //     }
        //     return '-';
        // })
        // ->addColumn('address', function(Customer $data){
        //     $country_name="-";  $state_name="-";  $city_name="-";
        //     $country = $data->country;
        //     if($country)
        //     {
        //         $country_name=$country->country_name;
        //     }
        //     $state = $data->state; 
        //     if($state)
        //     {
        //         $state_name=$state->state_name;
        //     }           
        //     $city = $data->city;
        //     if($city)
        //     {
        //         $city_name=$city->city_name;
        //     }
        //     $temp = 'Country: '.$country_name.'<br/>'.'State: '.$state_name.'<br/>'.'City'.$city_name;
        //     return $temp;
        // })
        ->addColumn('status', function(Customer $data) {
            $status = ($data->status == 1)?'checked':'' ;
            $route = \route('user.customer.status',$data->id);
                return "<div class='form-check form-switch form-check-custom form-check-solid'>
                        <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                    </div>";
        })
        ->addColumn('action', function(Customer $data){
            return ['Delete'=> \route('user.customer.destroy',$data->id),'edit'=> \route('user.customer.edit',$data->id),'view'=> \route('user.customer.view',$data->id)];
        })
        ->rawColumns(['status','action','register_address','name'])
        ->toJson();
    }

    public function create(){
        $Appointment = Appointment::where('id',159)->first();
        // $Customer = Customer::where('id',14)->first();
        // $this->dispatch(new CustomerCreateJob($Customer));
        // $this->dispatch(new CustomerAddAmountJob($Customer,['amount'=>100]));
        $this->dispatch(new CustomerBookedJob($Appointment));
        $countrys = Country::where('status',1)->get();
        return \view('customer.create',['countrys'=>$countrys]);
    }

    public function edit(Customer $customer){
        $countrys = Country::where('status',1)->get();
        $state = State::where('country_id',$customer->country_id)->where('status',1)->get();
        $city = City::where('state_id',$customer->state_id)->where('status',1)->get();
        return \view('customer.edit',['countrys'=>$countrys,'state'=>$state,'city'=>$city,'customer'=>$customer]);
    }

    public function store(Request $Request){

        $rules=[
			'phone_no' => 'required|unique:customers,phone_no,'.$Request->input('phone_no'),
		];

		$customs=[
			'phone_no.required'  => 'phone no Name should be filled',
			'phone_no.unique'      	=> 'phone no Name already taken',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $countrys = Country::where('id',$Request->country_code)->first();
        $Customer = new Customer;
        $Customer->fill($Request->all());
        $Customer->country_code = $countrys->country_code;
        $Customer->mobile_reg = 0;
        $Customer->save();
        $this->dispatch(new CustomerCreateJob($Customer));
       return response()->json(['msg'=>'Customer Addes']);
    }

	public function update(Request $Request,Customer $customer){
        $rules=[
			'phone_no' => "required|unique:customers,phone_no,$customer->id,id",
		];

		$customs=[
			'phone_no.required'  => 'phone no Name should be filled',
			'phone_no.unique'      	=> 'phone no Name already taken',
		];
        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        
        $customer->update($Request->all());
        return response()->json(['msg'=>'Customer Updated']);
    }

    public function destroy(Customer $customer){
        $customer->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
        //--- Redirect Section Ends
    }
    public function status(Request $request,Customer $customer){
        $customer->status = $request->status;
        $customer->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }
    public function search(Request $Request){
        $User = User::where('first_name','like',"%{$Request->search}%")->orWhere('last_name','like',"%{$Request->search}%")->orWhere('email','like',"%{$Request->search}%")->orWhere('phone','like',"%{$Request->search}%")->select(['id','first_name as text'])->get();
        $Customer = Firm::where('comapany_name','like',"%{$Request->search}%")->orWhere('legal_name','like',"%{$Request->search}%")->select(['id','comapany_name as text'])->get();
        $Consultant = Consultant::where('name','like',"%{$Request->search}%")->orWhere('phone_no','like',"%{$Request->search}%")->orWhere('email','like',"%{$Request->search}%")->select(['id','name as text'])->get();
        return response()->json([
                ["title"=>'User','children'=> $User],
                ["title"=>'Firm','children'=> $Firm],
                ["title"=>'Consultant','children'=> $Consultant],
            ]);
    }

    public function transactiondatatable(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }
       
        $datas = Payment::with('customer')->where('customer_id',$request->id)
        ->when($search[4],function($query,$search){ return $query->where('status',$search);   })
        ->orderBy('id','desc')
        ->get();
        return DataTables::of($datas)
            ->addIndexColumn()
            ->addColumn('created_at', function(Payment $datas) {                
                return  date('D-m-Y',strtotime($datas->created_at));
            })  
            ->addColumn('amount', function(Payment $datas) {                
                return  number_format($datas->amount,2);
            })  
            ->addColumn('type', function(Payment $datas) {  
                if($datas->type=='add')
                {
                    return  $datas->type.' '.' <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                                        transform="rotate(90 13 6)" fill="currentColor"></rect>
                                    <path
                                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>';

                } else{
                    return  $datas->type.' '.'<span class="svg-icon svg-icon-3 svg-icon-danger me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1"
                                        transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                    <path
                                        d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>';
                }             
                
            })   
            ->rawColumns(['type'])        
            ->toJson(); 
    }
    
     public function user_update(Request $Request,Customer $customer){
        $rules=[
            'name' => "required",
            'email' => "required",
            'dob' => "required",
            'gender' => "required",
            'register_address' => "required",
            'state_id' => "required",
            'city_id' => "required",
            'zipcode' => "required"
		];
        $validator = Validator::make($Request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

		$Request->status = (isset($Request->status)?1:0);
        $customer->update($Request->all());

        $customer->Addcountry;
        $customer->country;
        $customer->state;
        $customer->city;

        return response()->json(['msg'=>'Update','status' => true,'consultant'=>$customer]);

    }

    public function appointmentdatatable(Request $request){

        $datas = Appointment::with('customer','consultant')->where('customer_id',$request->id)->orderBy('id','desc')->get();

        return  DataTables::of($datas)
        ->editColumn('customer_id', function(Appointment $datas) {
            $datas->booking;
            if(isset($datas->customer)) $datas->customer->country;
            return $datas->customer;
        })
        ->addColumn('consultant_id', function(Appointment $datas) {
            return $datas->booking->consultant;
        })
        ->editColumn('status', function(Appointment $datas) {
            return $datas->status;
        })
        ->addColumn('cus_date_slot', function(Appointment $datas){
            if(!isset($datas->booking)) return [];
            $date = date_create($datas->appointment_date);
            $Time = date_format($date,"h:i a")." - ". date("h:i a",strtotime(date_format($date,"Y-m-d H:i")) + $datas->booking->consultant->preferre_slot*60);
            return ['Date'=>date_format($date,"M d,Y,l"),'Time'=>$Time,'Amount'=>$datas->booking->customercurrnecy->currencycode.' ' .number_format($datas->booking->amount,2)];
        })
        ->addColumn('cons_date_slot', function(Appointment $datas){
            if(!isset($datas->booking)) return [];
            $date = strtotime($datas->appointment_date) - ($datas->booking->diff);
            $date = date("Y-m-d H:i",$date);
            $date = date_create($date);
            $Time = date_format($date,"h:i a")." - ". date("h:i a",strtotime(date_format($date,"Y-m-d H:i")) + $datas->booking->consultant->preferre_slot*60);
            return ['Date'=>date_format($date,"M d,Y,l"),'Time'=>$Time,'Amount'=>$datas->booking->consultantcurrency->currencycode.' '.number_format(($datas->booking->amount/$datas->booking->customercurrnecy->price)*$datas->booking->consultantcurrency->price,2)];
        })
        ->addColumn('customer_currency', function(Appointment $datas){
            return $datas->booking->customercurrnecy;
        })
        ->addColumn('customer_currency', function(Appointment $datas){
            return $datas->booking->consultantcurrency;
        })
        ->addColumn('action', function(Appointment $datas){
            return '';
        })
        ->addColumn('amount', function(Appointment $datas){
            return $amount=0;
        })
        ->toJson();
    }


}
