<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use DataTables;
use Session;
use App\Models\Country;
use App\Models\Consultant;
use App\Models\Category;
use App\Models\Document;
use App\Models\Consultantcategory;
use App\Models\Insurance;
use App\Models\Language;
use App\Models\Firm;
use App\Models\State;
use App\Models\City;
use App\Models\Companysetting;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use App\Models\Wallet;
use App\Models\Appointment;

//Job
use App\Jobs\ConsultantCreatedJob;
class ConsultantController extends Controller
{
	public function __construct()
    {
        $this->middleware('Permissions:Consultant_View',['only'=>['index']]);
        $this->middleware('Permissions:Consultant_Create',['only'=>['create']]);
        $this->middleware('Permissions:Consultant_Edit',['only'=>['edit']]);
        $this->middleware('Permissions:Consultant_delete',['only'=>['destroy']]);

    }

	public function datatables(){ }

	public function index(){
	    $data = Consultant::with('wallet')->get();
		return view('consultant.index');
	}

    public function datatable(Request $request){

        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Consultant::with('Addcountry','state','city')
        // ->when($search[1],function($query,$search){ return $query->where('comapany_name','like',"%{$search}%");   })
        // ->when($search[1],function($query,$search){ return $query->where('comapany_name','like',"%{$search}%");   })
        // ->when($search[1],function($query,$search){ return $query->where('comapany_name','like',"%{$search}%");   })
        // ->when($search[1],function($query,$search){ return $query->where('comapany_name','like',"%{$search}%");   })
        ->orderBy('id','desc')->get();

        return DataTables::of($datas)
            ->addIndexColumn()
            // ->editColumn('country_id', function(Consultant $data){
            //     $country = $data->country;
            //     return ($country)?$country->country_name : '';
            // })
            // ->editColumn('state_id', function(Consultant $data){
            //     $state = $data->state;
            //     return ($state)?$state->state_name : '';
            // })
            // ->editColumn('city_id', function(Consultant $data){
            //     $city = $data->city;
            //     return ($city)?$city->city_name : '';
            // })
            ->editColumn('status', function(Consultant $data) {
                $status = ($data->status == 1)?'checked':'' ;
                $route = \route('consultant.consultant.status',$data->id);
                    return "<div class='form-check form-switch form-check-custom form-check-solid'>
                            <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                        </div>";
            })
            ->editColumn('picture', function(Consultant $data){
                if(!isset($data->picture)) return "";
                $exists = Storage::disk('public_custom')->exists($data->picture);
                if($exists) return asset("storage/$data->picture");
                return "";
            })
            ->editColumn('phone_no', function(Consultant $data){
                return $data->country->dialing." ".$data->phone_no;
            })
            ->editColumn('name', function(Consultant $data){
                return "Name : ".$data->name."<br/> Email : ".$data->email;
            })
            ->editColumn('categorie_id', function(Consultant $data){
                $category = $data->parentcat();
                $subCategory = $data->subcat()->pluck('name')->toArray();
                return ['cat'=>$category->name ?? '','sub'=>$subCategory];
            })
            ->addColumn('address', function (Consultant $data){
                return html_entity_decode($data->register_address);
            })
            ->editColumn('action', function(Consultant $data){
                return ['Delete'=> \route('consultant.consultant.destroy',$data->id),'view'=> \route('consultant.consultant.view',$data->id),'edit'=> \route('consultant.consultant.edit',$data->id)];
            })
            ->rawColumns(['action','status','categorie_id','address','name'])
            ->toJson();
    }
    public function datatable_old(Request $request){

        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }

        $datas = Consultant::with('country')->with('state')->with('city')
        // ->when($search[1],function($query,$search){ return $query->where('comapany_name','like',"%{$search}%");   })
        // ->when($search[1],function($query,$search){ return $query->where('comapany_name','like',"%{$search}%");   })
        // ->when($search[1],function($query,$search){ return $query->where('comapany_name','like',"%{$search}%");   })
        // ->when($search[1],function($query,$search){ return $query->where('comapany_name','like',"%{$search}%");   })
        ->orderBy('id','desc')->get();

        return DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('country_id', function(Consultant $data){
                $country = $data->country;
                return ($country)?$country->country_name : '';
            })
            ->editColumn('state_id', function(Consultant $data){
                $state = $data->state;
                return ($state)?$state->state_name : '';
            })
            ->editColumn('city_id', function(Consultant $data){
                $city = $data->city;
                return ($city)?$city->city_name : '';
            })
            ->editColumn('status', function(Consultant $data) {
                $status = ($data->status == 1)?'checked':'' ;
                $route = \route('consultant.consultant.status',$data->id);
                    return "<div class='form-check form-switch form-check-custom form-check-solid'>
                            <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                        </div>";
            })
            ->editColumn('created_at', function (Consultant $data){
                return  $data->created_at->format('d/m/Y');
            })
            ->editColumn('action', function(Consultant $data){
                               return ['Delete'=> \route('consultant.consultant.destroy',$data->id),'view'=> \route('consultant.consultant.view',$data->id),'edit'=> \route('consultant.consultant.edit',$data->id)];

            })
            ->rawColumns(['action','status'])
            ->toJson();
    }

	public function create(){
        $countrys = Country::where('status',1)->get();
        $Category = Category::with('child','childCategory')->where('status',1)->where('type',0)->get();
        $Language = Language::where('status',1)->get();
        $tree = [];

        foreach ($Category as $key => &$value) {
            # code...
            $temp = null;
            $temp1 = null;
            $temp = [
                'id' => $value->id,
                'text' => $value->name,
            ];
            $Category = Category::where('status',1)->where('categories_id',$value->id)->where('type',1)->get();
            foreach ($Category as $key1 => $value1) {
                # code...
                $temp['children'][] = [
                    'id' => $value1->id,
                    'text' => $value1->name,
                ];
            }
            $tree[] = $temp;
        }

		return view('consultant.create',['countrys' => $countrys,'tree'=>$tree,'Language'=>$Language,'Categorys'=>$Category]);
	}


    public function subCategory(Request $request){

        $Consultantcategory = Consultantcategory::with('Category','SubCategory')->whereIn('categorie_id',explode(",",$request->categorie_id))->orwhereIn('subcategorie_id',explode(",",$request->categorie_id))
        ->orwhereIn('categorie_id',explode(",",$request->categorie_id))->whereNull('subcategorie_id')
        ->get()->groupBy(['CategoryAlter.name','SubCategoryAlter.name']);

        $Category = Category::where('status',1)->whereIn('id',explode(",",$request->categorie_id))->orwhereIn('categories_id',explode(",",$request->categorie_id))->get();

        $ids = [];
        foreach($Category as $key => $data){
            if($data->type == 0){
                $ids[] = $data->id;
            }else{
               $ids[] = (int)$data->categories_id;
            }
        }
        
        $insurancs = Category::where('status',1)->where('insurance',1)->whereIn('id',$ids)->count();
       
        $documents_id = [];
        foreach ($Category as $key => &$value) {
            $documents_id = array_merge($documents_id,\explode(',',$value->document_id));
        }

        $Document = Document::whereIn('id',$documents_id)->where('status',1)->get();
        return response()->json(['spec_data'=>$Consultantcategory,'Document'=>$Document,'insutance'=>($insurancs > 0)?true:false]);
    }


	public function store(Request $request){ }



	public function status(Request $request,Consultant $consultant){
        $consultant->status = $request->status;
        $consultant->update();
        return response()->json(['status'=>true,'msg'=>'Status Updated']);
    }

    public function edit(Consultant $consultant){
        $consultant = Consultant::with('country','state','city','firm.state','firm.city')->where('id',$consultant->id)->get()->first();

        $viewCategory = Category::with('child','spec')->whereIn('id',explode(',',$consultant->categorie_id))->get();
        $specialization = Consultantcategory::with('Category')->with('SubCategory')->where('status',1)->get();
        $insurance = Insurance::whereIn('id',explode(',',$consultant->insurance_id))->get();

        $Category = Category::where('status',1)->where('type',0)->get();
        $Insurance = Insurance::where('status',1)->get();
        $tree1 = [];
        foreach ($Category as $key => &$value) {
            # code...
            $temp = null;
            $temp1 = null;
            $temp = [
                'id' => $value->id,
                'text' => $value->name,
            ];
            $tree1 = [];
            $Category = Category::where('status',1)->where('categories_id',$value->id)->where('type',1)->get();
            foreach ($Category as $key1 => $value1) {
                # code...
                $temp['children'][] = [
                    'id' => $value1->id,
                    'text' => $value1->name,
                ];

                $temp1 = [
                    'text' => "$value->name - $value1->name"
                ];
                $Consultantcategory = Consultantcategory::where('status',1)->where('categorie_id',$value->id)->where('subcategorie_id',$value1->id)->get();
                foreach ($Consultantcategory as $key2 => $value2) {
                    $temp1['children'][] = [
                        'id' => $value2->id,
                        'text' => $value2->title,
                    ];
                }
                $tree1[] = $temp1;
            }

            $tree[] = $temp;
        }
        //  dd($tree1);
        $lang = Language::whereIn('id',explode(',',$consultant->language))->get();
        return \view('consultant.edit',['consultant'=>$consultant,'tree1'=>$tree1,'lang'=>$lang,'viewCategory'=>$viewCategory,'specialization'=>$specialization,'insurance'=>$insurance]);
    }

    public function destroy(Consultant $consultant){
        $consultant->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1);
    }

    public function generateotp(){
        $rand = rand(0, 9999);
        Session::put('otp', $rand);
        return response()->json(['otp' => $rand]);
    }

    public function verify(Request $request){
        $otp = Session::get('otp');
        if($request->otp == $otp) return response()->json(['otp_status' => true]);
        return response()->json(['otp_status' => false]);
    }

    public function save(Request $request){
        switch($request->step){
            case '0':
                $consultant = Consultant::where('phone_no',$request->phone_no)->first();
                if($consultant){
                    $country = Country::where('country_code',$consultant->country_code)->first();
                    $firm = Firm::where('country_id',$country->id)->where('status',1)->where('approval',2)->get();
                    $insurance = Insurance::where('country_id',$country->id)->where('status',1)->get();
                    $Category = Category::where('status',1)->whereIn('id',explode(",",$consultant->categorie_id))->orwhereIn('categories_id',explode(",",$consultant->categorie_id))->get();
                    $documents_id = [];
                    foreach ($Category as $key => &$value) {
                        $documents_id = array_merge($documents_id,\explode(',',$value->document_id));
                    }
                    $Document = Document::whereIn('id',$documents_id)->where('status',1)->get();
                    return response()->json(['next' => true,'step'=>$consultant->step,'country'=>$country,'firm'=>$firm,'insurance'=>$insurance,'Document'=>$Document,'consultant'=>$consultant]);
                }
                $rules=[
                    'phone_no' => 'required|unique:consultants,phone_no,'.$request->phone_no,
                ];

                $customs=[
                    'phone_no.required'  => 'Phone number Name should be filled',
                    'phone_no.unique'      	=> 'Phone number Name already taken',
                ];
                $validator = Validator::make(['phone_no'=>$request->phone_no], $rules,$customs);
                if($validator->fails()){
                    return response()->json(['next' => false,'errors' => $validator->getMessageBag()->toArray()]);
                }
                $country = Country::where('id',$request->country_code)->first();
                $consultant = new Consultant;
                $consultant->phone_no = $request->phone_no;
                $consultant->country_code = $request->country_code;
                $consultant->mobile_reg = 0;
                $consultant->save();
                $this->dispatch(new ConsultantCreatedJob($consultant));
                $Wallet = new Wallet;
                $Wallet->consultant_id = $consultant->id;
                $Wallet->save();
            
                $consultant = Consultant::where('id',$consultant->id)->first();
                $country = Country::where('country_code',$request->country_code)->first();
                
                $firm = Firm::where('country_id',$country->id)->where('status',1)->where('approval',2)->get();
                $insurance = Insurance::where('country_id',$country->id)->where('status',1)->get();
                $Category = Category::where('status',1)->whereIn('id',explode(",",$consultant->categorie_id))->orwhereIn('categories_id',explode(",",$consultant->categorie_id))->get();
                $documents_id = [];
                if($Category)
                {
                    foreach ($Category as $key => &$value) {
                        $documents_id = array_merge($documents_id,\explode(',',$value->document_id));
                    }
                }                
                $Document = Document::whereIn('id',$documents_id)->where('status',1)->get();
                return response()->json(['next' => true,'country'=>$country,'firm'=>$firm,'insurance'=>$insurance,'Document'=>$Document,'consultant'=>$consultant]);
            break;
            case '1':
                $Consultant = Consultant::where('phone_no',$request->phone_no)->first();
                $Consultant->other = $request->other;
                $Consultant->type = $request->type;
                $Consultant->firm_choose = $request->firm_choose;
                $Consultant->step = 2;
                $Consultant->update();
                return response()->json(['next' => true]);
            break;

            case '2':
                $Consultant = Consultant::where('phone_no',$request->phone_no)->first();
                $picture = Storage::disk('public_custom')->move("/uploadFiles/temp/$request->picture","/uploadFiles/consultant/$request->picture");
                $Consultant->picture = "/uploadFiles/consultant/".$request->picture;
                $Consultant->bio_data = $request->bio_data;
                $Consultant->dob = $request->dob;
                $Consultant->email = $request->email;
                $Consultant->exp_year = $request->exp_year;
                $Consultant->landline = $request->landline;
                $Consultant->language = $request->language;
                $Consultant->gender = $request->gender;
                $Consultant->name = $request->name;
                $Consultant->step = 3;
                $Consultant->update();
                return response()->json(['next' => true]);
            break;

            case '3':
                $Consultant = Consultant::where('phone_no',$request->phone_no)->first();
                $Consultant->register_address = $request->register_address;
                $Consultant->country_id = $request->country_id;
                $Consultant->state_id = $request->state_id;
                $Consultant->city_id = $request->city_id;
                $Consultant->zipcode = $request->zipcode;
                $Consultant->step = 4;
                $Consultant->update();
                return response()->json(['next' => true]);
            break;

            case '4':
                $Consultant = Consultant::where('phone_no',$request->phone_no)->first();
                $Category = Category::where('status',1)->whereIn('id',\explode(",",$request->categorie_id))->get();
                
                $ids = [];

                foreach ($Category as $key => $value) {
                    # code...
                    $ids[] = $value->id;
                    if($value->categories_id){
                        $ids[] = (int)$value->categories_id;
                    }
                }
                $Consultant->categorie_id = \implode(',',$ids);
                // $Consultant->step = 5;
                $Consultant->update();
                return response()->json(['next' => true]);
            break;

            case '5':
                $Consultant = Consultant::where('phone_no',$request->phone_no)->first();
                $Consultant->specialized = implode(',',$request->specialized);
                $Consultant->insurance_id  = '';
                // $Consultant->step = 6;
                $Consultant->update();
                return response()->json(['next' => true]);
            break;

            case '6':
                $Consultant = Consultant::where('phone_no',$request->phone_no)->first();
                $Consultant->insurance_id = implode(',',$request->insurance_id);
                $Consultant->step = 7;
                $Consultant->update();
                return response()->json(['next' => true]);
            break;


            case '7':
                $Consultant = Consultant::where('phone_no',$request->phone_no)->first();
                $Consultant->direct = $request->direct;
                $Consultant->direct_amount = $request->direct_amount;
                $Consultant->preferre_slot = $request->preferre_slot;
                $Consultant->text = $request->text;
                $Consultant->text_amount = $request->text_amount;
                $Consultant->video = $request->video;
                $Consultant->video_amount = $request->video_amount;
                $Consultant->voice = $request->voice;
                $Consultant->voice_amount = $request->voice_amount;
                $Consultant->step = 8;
                $Consultant->update();
                $Category = Category::where('status',1)->whereIn('id',explode(",",$Consultant->categorie_id))->orwhereIn('categories_id',explode(",",$Consultant->categorie_id))->get();
                
                $documents_id = [];
                foreach ($Category as $key => &$value) {
                    $documents_id = array_merge($documents_id,\explode(',',$value->document_id));
                }
                $Document = Document::whereIn('id',$documents_id)->where('status',1)->get();
                return response()->json(['next' => true,'Document'=>$Document]);
            break;

            case '8':
                $Consultant = Consultant::where('phone_no',$request->phone_no)->first();
                $proof = [];
                foreach ($request->file('proof') as $key => $value) {
                    $IMGname = $value->getClientOriginalName();
                    $path = $value->store("uploadFiles/proof/$request->phone_no/",'public_custom');
                    $proof[] = $path;
                }
                $Consultant->proof = \implode(',',$proof);
                $Consultant->step = 9;
                $Consultant->update();
                return response()->json(['next' => true]);
            break;

            case '9':
                $Consultant = Consultant::where('phone_no',$request->phone_no)->first();
                $Consultant->com_con_type = $request->com_con_type;
                $Consultant->com_off_type = $request->com_off_type;
                $Consultant->com_pay_type = $request->com_pay_type;
                $Consultant->com_con_amount = $request->com_con_amount;
                $Consultant->com_off_amount = $request->com_off_amount;
                $Consultant->com_pay_amount  = $request->com_pay_amount;
                $Consultant->step = 10;
                $Consultant->update();
                return response()->json(['next' => true]);
            break;

            case '10':
                $Consultant = Consultant::where('phone_no',$request->phone_no)->first();
                $Consultant->account_number = $request->account_number;
                $Consultant->account_name = $request->account_name;
                $Consultant->ifsc_code = $request->ifsc_code;
                $Consultant->bank_name = $request->bank_name;
                $Consultant->branch = $request->branch;
                $Consultant->bank_status = $request->bank_status;
                $Consultant->step = 11;
                $Consultant->update();

                return response()->json(['next' => true]);
            break;
        }
    }

    public function getdata(Request $request){
        $Consultant = Consultant::where('phone_no',$request->phone_no)->first();
        return response()->json(['data' => $Consultant]);
    }

    public function modelcategory(Request $request){

        $subcategory = [];
        $category = Category::whereIn('id',$request->categorie_id)->where('status',1)->first();
        
        $Consultantcategory = Consultantcategory::with('Category','SubCategory')->whereIn('categorie_id',$request->categorie_id)->orwhereIn('subcategorie_id',$request->categorie_id)
        ->orwhereIn('categorie_id',$request->categorie_id)->whereNull('subcategorie_id')
        ->get()->groupBy(['CategoryAlter.name','SubCategoryAlter.name']);
        // if(isset($request->parent)){
            $subcategory = Category::where('categories_id',$request->categorie_id)->where('status',1)->get();
        // }
        $Category = Category::whereIn('id',$request->categorie_id)->where('status',1)->get();

        $documents_id = [];
        foreach ($Category as $key => &$value) {
            $documents_id = array_merge($documents_id,\explode(',',$value->document_id));
        }

        $Document = Document::whereIn('id',$documents_id)->where('status',1)->get();

        $isinsurance = Category::where('insurance',1)->whereIn('id',$request->categorie_id)->count();

        return response()->json(['Document'=>$Document,'subcategory'=>$subcategory,'Consultantcategory'=>$Consultantcategory,'isinsurance'=>$isinsurance]);
    }

    public function view(Consultant $consultant){
        // dd($consultant);
        $consultant = Consultant::with('country','state','city','firm.state','firm.city','appointment.customer','appointment_completed','appointment.transaction','wallet','offer_historys.offer','offer_historys.customer','wallet_trans','reviewForView.customer','currency')->where('id',$consultant->id)->first();
        $companySetting_country_price = Companysetting::with('country.currency')->get()->first();
        $consultant_country = Country::with('currency')->where('id',$consultant->country_code)->first();
        $countrys = Country::where('status',1)->get();
        $state = State::where('status',1)->where('country_id',$consultant->country->id)->get();
        $city = City::where('status',1);
        if($consultant->country->has_state == 1) $city = $city->where('state_id',$consultant->state_id);
        else $city = $city->where('country_id',$consultant->country->id);
        $city = $city->get();
        $language = Language::where('status',1)->get();

        $firm = Firm::where('status',1)->where('country_id',$consultant->country->id)->where('approval',2)->get();
        // dd($firm);
        $app_completed =  count($consultant->appointment_completed);

        $insurance = Insurance::where('status',1)->where('country_id',$consultant->country->id)->get();
        $Category = Category::where('status',1)->where('type',0)->get();

        $subcaregory = Category::where('status',1)->where('type',1)->whereIn('categories_id',\explode(',',$consultant->categorie_id))->get();

        $Consultantcategory = Consultantcategory::with('Category','SubCategory')->whereIn('categorie_id',explode(",",$consultant->categorie_id))->orwhereIn('subcategorie_id',explode(",",$consultant->categorie_id))
        ->orwhereIn('categorie_id',explode(",",$consultant->categorie_id))->whereNull('subcategorie_id')
        ->get()->groupBy(['CategoryAlter.name','SubCategoryAlter.name']);
        // dd($Consultantcategory);

        $consultant_category = explode(',',$consultant->categorie_id);
        $consultant_specialized = explode(',',$consultant->specialized);

        $reviews = $consultant->reviewForView;
        $rating = 0;
        if(is_array($reviews)){

            $sum = 0;
            foreach ($reviews as  $review) {
                $sum += $review->rating;
            }
            $rating = $sum/count($reviews);

        }


        $temp = null;
        $temp1 = null;
        $tree = [];
        $tree1 = [];
        foreach ($Category as $key => &$value) {
            # code...

            $temp = [
                'id' => $value->id,
                'text' => $value->name,
            ];
            $is_select_all = \in_array($value->id, $consultant_category);

            $subCategory = Category::where('status',1)->where('categories_id',$value->id)->where('type',1)->get();

            foreach ($subCategory as $key1 => $value1) {
                # code...
                if(\in_array($value1->id, $consultant_category)) $is_select_all = true;
                else $is_select_all = false;

                $temp['children'][]= [
                    'id' => $value1->id,
                    'text' => $value1->name,
                    'state' => [
                        'selected' => \in_array($value1->id, $consultant_category)  //'selected' does NOT take effect after refresh
                    ]
                ];
            }
            $temp['state'] = [ 'selected' => $is_select_all ];
            $tree[] = $temp;
        }

        //Specialization
        $Specialization = ConsultantCategory::where('status',1)->whereIn('id',explode(',',$consultant->specialized))->get();

        foreach ($Specialization as $key => &$value2) {
            $cat = Category::where('status',1)->where('type',0)->where('id',$value2->categorie_id)->get()->first();
            $sub = Category::where('status',1)->where('type',1)->where('id',$value2->subcategorie_id)->get()->first();

            $temp1 = [
                'id' => $value2->id,
                'text' => "$cat->name - $value2->title",
                'state' => [
                    'selected' => \in_array($value2->id, $consultant_specialized)  //'selected' does NOT take effect after refresh
                ]
            ];

            if(!is_null($sub)){
                $temp1 = [
                    'id' => $value2->id,
                    'text' => "$cat->name - $sub->name - $value2->title",
                    'state' => [
                        'selected' => \in_array($value2->id, $consultant_specialized)  //'selected' does NOT take effect after refresh
                    ]
                ];
            }


            $tree1[] = $temp1;
        }
        $isinsurance = Category::where('insurance',1)->whereIn('id',explode(',',$consultant->categorie_id))->count();

        // dd($tree1);
        return \view('consultant.view',['isinsurance'=>$isinsurance,'Consultantcategory'=>$Consultantcategory,'subcaregory'=>$subcaregory,'Category'=>$Category,'insurance'=>$insurance,'consultant'=>$consultant,'firm'=>$firm,'rating'=>$rating,'consultant_country'=>$consultant_country,'companySetting_country_price'=>$companySetting_country_price,'tree'=>$tree,'tree1'=>$tree1,'insurance'=>$insurance,'language'=>$language,'app_completed'=>$app_completed,'countrys'=>$countrys,'state'=>$state,'city'=>$city]);
    }

    public function update(Request $Request,Consultant $consultant)
    {
        if($Request->form =="personal"){
            $consultant->gender = $Request->gender;
            $consultant->exp_year = $Request->exp_year;
            $consultant->name = $Request->name;
            $consultant->email = $Request->email;
            $consultant->landline = $Request->landline;
            $consultant->bio_data = $Request->bio_data;
            $consultant->dob = $Request->dob;
            $consultant->language = \implode(",",$Request->language);
            $consultant->register_address = $Request->register_address;
            $consultant->country_id = ($consultant->country_id)?$consultant->country_id:$consultant->country->id;
            $consultant->state_id = $Request->state_id;
            $consultant->city_id = $Request->city_id;
            $consultant->zipcode = $Request->zipcode;
            if($Request->firm_choose == 0) $consultant->firm_choose = "";
            else $consultant->firm_choose = $Request->firm_choose;
            $consultant->update();

            $consultant->Addcountry;
            $consultant->country;
            $consultant->state;
            $consultant->city;
            $consultant->firm;
            return response()->json(['msg' =>"Personal Details Updated",'status'=>true,'consultant'=>$consultant,'language'=>\implode(", ",$consultant->getLanguage()->pluck('title')->toArray())]);
        }
        if($Request->form =="bank_details"){

            $consultant->account_number = $Request->account_number;
            $consultant->account_name = $Request->account_name;
            $consultant->ifsc_code = $Request->ifsc_code;
            $consultant->bank_name = $Request->bank_name;
            $consultant->branch = $Request->branch;
            $consultant->bank_status = ($Request->bank_status)?1:0;
            $consultant->update();
            return response()->json(['msg' =>"Bank Details Updated",'status'=>true,'consultant'=>$consultant]);
        }
        if($Request->form =="consultant_amount"){
            $consultant->video = ($Request->video)?1:0;
            $consultant->video_amount = ($Request->video)?$Request->video_amount:0;
            $consultant->voice = ($Request->voice)?1:0;
            $consultant->voice_amount = ($Request->voice)?$Request->voice_amount:0;
            $consultant->text = ($Request->text)?1:0;
            $consultant->text_amount = ($Request->text)?$Request->text_amount:0;
            $consultant->direct = ($Request->direct)?1:0;
            $consultant->direct_amount = ($Request->direct)?$Request->direct_amount:0;

            $consultant->preferre_slot = $Request->preferre_slot;

            $consultant->com_con_type = $Request->com_con_type;
            $consultant->com_con_amount = $Request->com_con_amount;
            $consultant->com_off_type = $Request->com_off_type;
            $consultant->com_off_amount = $Request->com_off_amount;
            $consultant->com_pay_type = $Request->com_pay_type;
            $consultant->com_pay_amount = $Request->com_pay_amount;
            $consultant->update();
            $consultant->Addcountry;
            $consultant->country;
            return response()->json(['msg' =>"Consultant Amount Details Updated",'status'=>true,'consultant'=>$consultant]);
        }

        if($Request->form =="firm_individual"){
            $consultant->type = $Request->data['type'];
            $consultant->firm_choose = $Request->data['firm_choose'];
            $consultant->other = $Request->data['other'];
            $consultant->update();
            return response()->json(['msg' =>"Firm/Individual Details Updated"]);
        }

        if($Request->form =="category"){

            $consultant->categorie_id = \implode(',',$Request->categorie_id);
            $consultant->specialized = (isset($Request->specialization_id))?\implode(',',$Request->specialization_id):'';
            $consultant->insurance_id = (isset($Request->insurance_id))?\implode(',',$Request->insurance_id):'';
                $gallery = [];
                if($Request->has('gallery')){
                    foreach ($Request->file('gallery') as $key => $value) {
                        $IMGname = $value->getClientOriginalName();
                        $path = $value->store('uploadFiles/proof','public_custom');
                        $gallery[] = $path;
                    }
                    $consultant->proof = \implode(',',$gallery);
                }
            $consultant->update();
            $Consultantcategory = Consultantcategory::with('Category','SubCategory')->whereIn('categorie_id',explode(",",$consultant->categorie_id))->orwhereIn('subcategorie_id',explode(",",$consultant->categorie_id))
                ->orwhereIn('categorie_id',explode(",",$consultant->categorie_id))->whereNull('subcategorie_id')
                ->get()->groupBy(['CategoryAlter.name','SubCategoryAlter.name']);
            $insurance = insurance::whereIn('id',\explode(',',$consultant->insurance_id))->get()->pluck('comapany_name')->toArray();

            return response()->json(['status'=>true,'consultant'=>$consultant,'Consultantcategory'=>$Consultantcategory,'subcaregory'=>$consultant->subcat()->pluck('name')->toArray(),
            'spec'=>\implode(", ",$consultant->getspec()->pluck('title')->toArray()),'Category'=>$consultant->parentcat(),'insurance'=>$insurance]);
        }

        if($Request->form =="others"){
        //    dd($Request);
            $consultant->language = $Request->data['language'];
            $consultant->insurancecheckbox = isset($Request->data['insurancecheckbox'])? $Request->data['insurancecheckbox'] :$consultant->insurancecheckbox;
            $consultant->insurance_id = isset($Request->data['insurance_id'])? $Request->data['insurance_id'] :'';
            $consultant->account_number = $Request->data['account_number'];
            $consultant->account_name = $Request->data['account_name'];
            $consultant->ifsc_code = $Request->data['ifsc_code'];
            $consultant->bank_name = $Request->data['bank_name'];
            $consultant->branch = $Request->data['branch'];
            $consultant->bank_status = isset($Request->data['bank_status'])? $Request->data['bank_status'] :'';
            $consultant->update();
            return response()->json(['msg' =>"Updated"]);
        }

    }

    public function transactiondatatable(Request $request){
        $search=[];
        $columns=$request->columns;
        foreach($columns as $colum){
            $search[] = $colum['search']['value'];
        }
       
        $datas = Payment::with('consultant')->where('consultant_id',$request->id)
        ->when($search[4],function($query,$search){ return $query->where('status',$search);   })
        ->orderBy('id','desc')
        ->get();
        return DataTables::of($datas)
            ->addIndexColumn()
            ->addColumn('created_at', function(Payment $datas) {                
                return  date('D-m-Y',strtotime($datas->created_at));
            })  
            ->addColumn('amount', function(Payment $datas) {                
                return  $datas->consultant->country->currency->currencycode.' '.number_format($datas->amount,2);
            })  
            ->addColumn('type', function(Payment $datas) {  
                if($datas->type=='add')
                {
                    return  $datas->type.' '.'<span class="svg-icon svg-icon-3 svg-icon-success me-2">
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
    
    public function appointmentdatatable(Request $request){
       
        $datas = Appointment::with('customer','consultant')->where('consultant_id',$request->id)->orderBy('id','desc')->get();

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
