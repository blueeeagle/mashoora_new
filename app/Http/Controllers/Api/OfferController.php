<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Category;
use App\Models\Consultant;
use DataTables;
use Validator;
use DB;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Jobs\OfferPostJob;

class OfferController extends Controller
{

    public function index(Request $request){
        $offers = Offer::where('consultant_id',Auth::guard('consultant')->user()->id)->get();
        return DataTables::of($offers)->addIndexColumn()->toJson();
    }

    public function create(){
        $category = Category::where('type',0)->where('status',1)->whereIn('id',explode(",",Auth::guard('consultant')->user()->categorie_id))->first();
        $subctegory = Category::where('type',1)->where('status',1)->whereIn('id',explode(",",Auth::guard('consultant')->user()->categorie_id))->get();
        return response()->json(['category'=>$category,'subctegory'=>$subctegory]);
    }
    public function store(Request $Request){
        $rules=[
            'offer_title' => "required|unique:offers,offer_title,$Request->offer_title",
			'description' => 'required',
			'amount' => 'required',
            'category_id' => 'required',
            'image' => 'required'
		];

		$customs=[
			'offer_title.required'  => 'Title Name should be filled',
			'description.required'  => 'Description Name should be filled',
			'amount.required'  => 'Amount Name should be filled',
			'image.required'  => 'image shout be choosen',
			'offer_title.unique'      	=> 'Title Name already taken',
			'category_id.required'      	=> 'Choose chategory',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $consultant = Auth::guard('consultant')->user();
        $offer = new Offer;
        $offer->firm_consultant = isset($consultant->firm_choose)?0:1;
        if(isset($consultant->firm_id))$offer->firm_id = $consultant->firm_id;
        $offer->consultant_id = $consultant->id;
        $offer->offer_title = $Request->offer_title;
        $offer->description = $Request->description;
        $offer->amount = $Request->amount;
        if(isset($Request->has_validity)) $offer->has_validity = $Request->has_validity;
        if(isset($Request->from_date)) $offer->from_date = $Request->from_date;
        if(isset($Request->to_date)) $offer->to_date = $Request->to_date;
        $offer->category_id = \implode(',',array_merge($Request->sub_category_id,$Request->category_id));
        $offer->status = (isset($Request->status)?1:0);

        if($Request->has('image')){
            $offer->image = $Request->file('image')->store("/uploadFiles/offer/",'public_custom');
        }
        $offer->save();
        $this->dispatch(new OfferPostJob($offer));
       return response()->json(['msg'=>'Offer Addes']);
    }

    public function offerSubCategory(Request $request){

        $subCategory = Category::whereIn('categories_id',$request->id)->whereIn('categories_id',explode(",",Auth::guard('consultant')->user()->categorie_id))->where('type',1)->get();
        return response()->json($subCategory);
    }

    public function update(Request $Request,Offer $offer){
        $rules=[
			'offer_title' => "required|unique:offers,offer_title,$offer->id,id",
			'description' => 'required',
			'amount' => 'required',
            'category_id' => 'required',

		];

		$customs=[
			'offer_title.required'  => 'Title Name should be filled',
			'description.required'  => 'Description Name should be filled',
			'amount.required'  => 'Amount Name should be filled',
			'offer_title.unique'      	=> 'Title Name already taken',
			'category_id.required'      	=> 'Choose chategory',
		];

        $validator = Validator::make($Request->all(), $rules,$customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $offer->offer_title = $Request->offer_title;
        $offer->description = $Request->description;
        $offer->amount = $Request->amount;
        if(isset($Request->has_validity)) $offer->has_validity = $Request->has_validity;
        if(isset($Request->from_date)) $offer->from_date = $Request->from_date;
        if(isset($Request->to_date)) $offer->to_date = $Request->to_date;
        $offer->category_id = \implode(',',array_merge($Request->sub_category_id,$Request->category_id));
        $offer->status = (isset($Request->status)?1:0);

        if($Request->has('image')){
            $offer->image = $Request->file('image')->store("/uploadFiles/offer/",'public_custom');
        }

        $offer->update();
        return response()->json(['msg'=>'Updated Successfully']);

    }

    public function edit(Request $request, Offer $offer){
        
        $category = Category::where('type',0)->where('status',1)->whereIn('id',explode(",",Auth::guard('consultant')->user()->categorie_id))->first();
        $subcategory = Category::where('type',1)->where('status',1)->where('categories_id',$category->id)->get();

        return response()->json(['edit_offers'=>$offer,'category'=>$category,'subcategory'=>$subcategory] ,200);
    }

    public function destroy(Request $request,Offer $offer){
        $offer->delete();
        $data1['msg'] = 'Data Deleted Successfully.';
        $data1['status'] = true;
        return response()->json($data1, 200);
        //--- Redirect Section Ends
    }

}
