<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Consultantcategory;
use App\Models\Consultant;
use App\Models\Discountuser;
use App\Models\Companysetting;

class Discount extends Model
{
    use HasFactory;
    protected  $table ='discount';
    protected $fillable = ['consultant_id','promo_title','promo_code','no_of_coupons','upload_image',
                            'flat_percentage','amount','from_date','to_date','category_id','specialization_id',
                            'video','voice','direct','text','status'];

    protected $appends = ['cat','sub','discountpurchasecount'];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function specialization(){
        return $this->belongsTo(Consultantcategory::class,'specialization_id');
    }
    public function consultant(){
        return $this->belongsTo(Consultant::class,'consultant_id');
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
    public function getDiscountpurchasecountAttribute(){
        return Discountuser::where('discount_id',$this->id)->count();
    }
    
     public function GenerateTemplate(){
        $Companysetting = Companysetting::where('id',1)->first();

        $this->TemplateData = new \stdClass();
        $this->TemplateData->{'ConsultantName'} = $this->consultant->name;
        $this->TemplateData->{'ConsultantEmail'} = $this->consultant->email;
        $this->TemplateData->{'ConsultantPhoneNo'} = $this->consultant->phone_no;

        $this->TemplateData->{'type'} = $this->flat_percentage;
        if($this->flat_percentage == 0){
            $consultantAmount =  $this->consultant->country->currency->currencycode.' '.$this->amount;
        }else{
            $consultantAmount = $this->amount;
        }
        $this->TemplateData->{'consultantAmount'} = $consultantAmount;
        $this->TemplateData->{'promocode'} = $this->promo_code;
        $this->TemplateData->{'promotitle'} = $this->promo_title;
        return $this->TemplateData;
    }
}
