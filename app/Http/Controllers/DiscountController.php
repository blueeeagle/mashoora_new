<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Firm;
use App\Models\Consultant;
use App\Models\Discount;
use App\Models\Category;
use App\Models\Consultantcategory;
use Illuminate\Support\Facades\Input;
use DataTables;
use DB;
use Illuminate\Support\Collection;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Jobs\DiscountPostJob;

class DiscountController extends Controller
{
    public function __construct()
    {
      $this->middleware('Permissions:Discount_View',['only'=>['index']]);
      $this->middleware('Permissions:Discount_Create',['only'=>['create']]);
      $this->middleware('Permissions:Discount_Edit',['only'=>['edit']]);
      $this->middleware('Permissions:Discount_delete',['only'=>['destroy']]);

    }
  public function index(){
    $consultant = Consultant::where('status',1)->orderBy('name','asc')->get();
    $category = Category::where('status',1)->orderBy('name','asc')->get();
    $specialization = Consultantcategory::where('status',1)->get();
    return view('discount.index',[
        'consultant'=>$consultant,
        'category'=>$category,
        'specialization'=>$specialization,

    ]);
  }

  public function datatable(Request $request){

    $search=[];
    $columns=$request->columns;
    foreach($columns as $colum){
        $search[] = $colum['search']['value'];
    }
    $datas = Discount::with('category')->with('consultant.country')
            ->when($search[1],function($query,$search){return $query->where('consultant_id',$search);})
            ->when($search[3],function($query,$search){return $query->where('promo_title','LIKE',"%{$search}%");})
            ->when($search[4],function($query,$search){return $query->where('promo_code','LIKE',"%{$search}%");})
            ->when($search[5],function($query,$search){return $query->where('no_of_coupons',$search);})
            ->when($search[6],function($query,$search){return $query->where('amount',$search);})
            ->when($search[8],function($query,$search){return $query->where('category_id',$search);})
            ->orderBy('id','desc')->get();

    // dd($datas);
    return DataTables::of($datas)
      ->addIndexColumn()
      ->addColumn('consultantId', function(Discount $data){
        if($data->consultant !=''){ $consultant_name = $data->consultant->name; }
        else{ $consultant_name = ''; }
        return $consultant_name;
      })
      ->addColumn('categoryID', function(Discount $data){
        $category  = Category::whereIn('id',explode(',',$data->category_id))->where('type',0)->first();
        $subcategoey  = Category::whereIn('id',explode(',',$data->category_id))->where('type',1)->get();
        return ['category'=>$category,'subcategoey'=>$subcategoey];
      })
      ->editColumn('status', function(Discount $data) {
          $status = ($data->status == 1)?'checked':'' ;
          $route = \route('other.discount.status',$data->id);
              return "<div class='form-check form-switch form-check-custom form-check-solid'>
                      <input class='form-check-input' type='checkbox' status data-url='$route' value='' $status />
                  </div>";
      })
      ->addColumn('action', function(Discount $data){

          return ['Delete'=> \route('other.discount.destroy',$data->id),'edit'=> \route('other.discount.edit',$data->id)];
      })
      ->editColumn('image', function(Discount $data){
        $exists = Storage::disk('public_custom')->exists($data->image);
        if($exists) return asset("storage/$data->image");
        return "";
      })
      ->rawColumns(['consultantId','categoryID','specializationID','status','action'])
      ->toJson();
  }

  public function getConsultant(Request $request){
      $Consultant = Consultant::where('id',$request->id)->first();
      $Category = Category::whereIn('id',explode(',',$Consultant->categorie_id))->where('type',0)->where('status',1)->first();
      $subCategort = Category::whereIn('id',explode(',',$Consultant->categorie_id))->where('type',1)->where('status',1)->orderBy('name','asc')->get();
      return response()->json(['Category'=>$Category,'subCategort'=>$subCategort]);
  }

  public function create(){
      $Consultant = Consultant::with('country.currency')->where('status',1)->orderBy('name','asc')->get();
      return \view('discount.create',['consultants'=>$Consultant]);
  }

  public function edit(Discount $discount ){
      $disconsultant = Consultant::with('country.currency')->where('id',$discount->consultant_id)->where('status',1)->first();
    $discount = Discount::with('consultant.country.currency')->where('id',$discount->id)->get()->first();
    $Consultant = Consultant::with('country.currency')->where('status',1)->orderBy('name','asc')->orderBy('name','asc')->get();
    $ConsultantCategory = ConsultantCategory::where('id',$discount->specialization_id)->where('status',1)->get();
    $Category = Category::whereIn('id',explode(',',$discount->category_id))->where('status',1)->where('type',0)->first();
    if($Category)  $subcategory = Category::whereIn('id',explode(",",$disconsultant->categorie_id))->where('type',1)->get();
    else $subcategory = [];
    return \view('discount.edit',['discount'=>$discount,'specialization'=>$ConsultantCategory,'Category'=>$Category,
                                  'consultants'=>$Consultant,'subcategory'=>$subcategory
                                ]);
  }
  public function store(Request $Request){
    $rules=[
			'promo_code' => 'required|unique:discount,promo_code,'.$Request->promo_code,
      'consultant_id' => 'required',
      'no_of_coupons' => 'required',
      'flat_percentage' => 'required',
      'amount' => 'required',
      'from_date' => 'required',
      'to_date' => 'required',
      'category_id' => 'required',
		];

		$customs=[
			'promo_code.required'  => 'Promo Code should be filled',
			'promo_code.unique'      	=> 'Promo Code already taken',
      'consultant_id.required' => 'Consultant should be filled',
      'category_id.required' => 'Consultant should be filled',
      'amount.required' => 'Consultant should be filled',
		];

    $validator = Validator::make($Request->all(), $rules,$customs);
    if ($validator->fails()) {
      return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
    }
    $Discount = new Discount;
    $Discount->fill($Request->all());

    if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->image")){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->image","/uploadFiles/Discount/$Request->image");
            $Request['image'] =  "/uploadFiles/Discount/$Request->image";
        }


    $Discount->image = $Request->image;
    $Discount->category_id = \implode(',',$Request->category_id);
    // $Discount->status = (isset($Request->status)?1:0);
    $Discount->save();
    $this->dispatch(new DiscountPostJob($Discount));

    return response()->json(['msg'=>'Discount Added']);
  }

	public function update(Request $Request,Discount $discount){
    $rules=[
      'promo_code' => "required|unique:discount,promo_code,$discount->id,id",
      'no_of_coupons' => 'required',
      'flat_percentage' => 'required',
      'amount' => 'required',
      'from_date' => 'required',
      'to_date' => 'required',
      'category_id' => 'required',
    ];

    $customs=[
      'promo_code.required'  => 'Promo Code should be filled',
			'promo_code.unique'      	=> 'Promo Code already taken',
      'category_id.required' => 'Category should be filled',
      'amount.required' => 'Amount should be filled',
    ];

    $validator = Validator::make($Request->all(), $rules,$customs);
    // dd($Request);
    if ($validator->fails()) {
      return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
    }

    if(Storage::disk('public_custom')->exists("/uploadFiles/temp/$Request->image") && $Request->image){
            Storage::disk('public_custom')->move("/uploadFiles/temp/$Request->image","/uploadFiles/Discount/$Request->image");
            $Request['image'] =  "/uploadFiles/Discount/$Request->image";
        }else{
            $Request['image'] = $discount->image;
        }
    $Request['category_id'] = \implode(',',$Request->category_id);
    $Request['video'] = isset($Request->video)?1:0;
    $Request['direct'] = isset($Request->direct)?1:0;
    $Request['voice'] = isset($Request->voice)?1:0;
    $Request['text'] = isset($Request->text)?1:0;
    // $Request->status = (isset($Request->status)?1:0);
    $discount->update($Request->all());
    return response()->json(['msg'=>'Discount Updated']);

  }

  public function search(Request $Request){
    $User = User::where('first_name','like',"%{$Request->search}%")->orWhere('last_name','like',"%{$Request->search}%")->orWhere('email','like',"%{$Request->search}%")->orWhere('phone','like',"%{$Request->search}%")->select(['id','first_name as text'])->get();
    $Firm = Firm::where('comapany_name','like',"%{$Request->search}%")->orWhere('legal_name','like',"%{$Request->search}%")->select(['id','comapany_name as text'])->get();
    $Consultant = Consultant::where('name','like',"%{$Request->search}%")->orWhere('phone_no','like',"%{$Request->search}%")->orWhere('email','like',"%{$Request->search}%")->select(['id','name as text'])->get();
    return response()->json([
          ["title"=>'User','children'=> $User],
          ["title"=>'Firm','children'=> $Firm],
          ["title"=>'Consultant','children'=> $Consultant],
    ]);
  }

  public function status(Request $request,Discount $discount){
    $discount->status = $request->status;
    $discount->update();
    return response()->json(['status'=>true,'msg'=>'Status Updated']);
  }


  public function destroy(Discount $discount){
    $discount->delete();
    $data1['msg'] = 'Data Deleted Successfully.';
    $data1['status'] = true;
    return response()->json($data1);
      //--- Redirect Section Ends
  }

}
