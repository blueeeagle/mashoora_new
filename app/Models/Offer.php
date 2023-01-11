<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Consultantcategory;
use App\Models\Consultant;
use App\Models\Firm;
use App\Models\OfferPurchase;
use App\Models\Companysetting;

class Offer extends Model
{
    use HasFactory;
    // protected  $table ='offers';
    protected $fillable = ['firm_consultant','firm_id','consultant_id','offer_title','image',
                            'description','amount','from_date','to_date','category_id','has_validity',
                            'sub_category_id','status'];
    
    protected $appends = ['cat','sub','offerpurchasecount'];
    
    public function consultant(){
        return $this->belongsTo(Consultant::class);
    }
    public function firm(){
        return $this->belongsTo(Firm::class,'firm_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function sub_category(){
        return $this->belongsTo(Category::class,'sub_category_id');
    }
    public function parentcat(){
        return Category::whereIn('id',\explode(',',$this->categorie_id))->where('type',0)->where('status',1)->first();
    }
    public function subcat(){
        return Category::whereIn('id',\explode(',',$this->categorie_id))->where('type',1)->where('status',1)->get();
    } 
    public function getCatAttribute(){
        return Category::whereIn('id',\explode(',',$this->category_id))->where('type',0)->first();
    }
    public function getSubAttribute(){
        return Category::whereIn('id',\explode(',',$this->category_id))->where('type',1)->get();
    }
    public function getOfferpurchasecountAttribute(){
        return OfferPurchase::where('offer_id',$this->id)->count();
    }
    
    public function GenerateTemplate(){
        $Companysetting = Companysetting::where('id',1)->first();

        $this->TemplateData = new \stdClass();
        $this->TemplateData->{'ConsultantName'} = $this->consultant->name;
        $this->TemplateData->{'ConsultantEmail'} = $this->consultant->email;
        $this->TemplateData->{'ConsultantPhoneNo'} = $this->consultant->phone_no;

        $this->TemplateData->{'consultantAmount'} = $this->consultant->country->currency->currencycode.' '.$this->amount;
        $this->TemplateData->{'AdminAmount'} = $Companysetting->country->currency->currencycode.' '.round($Companysetting->country->currency->price/$this->amount,2);
        $this->TemplateData->{'description'} = $this->description;
        $this->TemplateData->{'offerTitle'} = $this->offer_title;
        return $this->TemplateData;
    }
}
