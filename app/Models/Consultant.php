<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Schedule;
use App\Models\Firm;
use App\Models\Insurance;
use App\Models\Offer;
use App\Models\OfferPurchase;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Wallet;
use Carbon\Carbon;
use App\Models\Review;
use App\Models\Language;
use App\Models\Category;
use App\Models\Consultantcategory;
use DateTime;
use DateTimeZone;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Consultant extends Authenticatable
{
    use HasFactory;
    // protected $fillable = ['phone_no','name','email'];
    protected $appends = ['subtext'];

    
    public function country(){
        return $this->belongsTo(Country::class,'country_code',"country_code");
    }
    public function currency(){
        return $this->belongsTo(Country::class,'country_code');
    }
    public function Addcountry(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function firm(){
        return $this->belongsTo(Firm::class,'firm_choose');
    }
    public function Schedule(){
        return $this->hasMany(Schedule::class,'consultant_id','id')->where('to_date','>=',date('Y-m-d'));
    }
    public function Allschedule(){
        return $this->hasMany(Schedule::class,'consultant_id','id');
    }
    
    public function offer()
    {
        $date = today()->format('m/d/Y');
        return $this->hasMany(Offer::class)->where('consultant_id',$this->id)->where('status',1)->where('has_validity','!=',1)->orWhere('has_validity',1)->where('from_date','<',$date)->where('to_date','>',$date);
    }
    public function getLanguage()
    {
        return Language::whereIn('id',\explode(',',$this->language))->get();
    }
    public function discount(){
        
        $date = today()->format('m/d/Y');
        $hasMany = $this->hasMany(Discount::class)->where('consultant_id',$this->id)->where('status',1)->where('from_date','<',$date)->where('to_date','>',$date);
        if($this->video) $hasMany = $hasMany->where('video',1);
        if($this->voice) $hasMany = $hasMany->orwhere('voice',1);
        if($this->text) $hasMany = $hasMany->orwhere('text',1);
        if($this->direct) $hasMany = $hasMany->orwhere('direct',1);
        return $hasMany;
    }
    
    public function getSubtextAttribute()
    {
        if($this->firm){
            return $this->firm->comapany_name;
        }
        return '';
    }
public function getInsuranceAttribute(){
        $arr = \explode(',',$this->insurance_id);
        return Insurance::where('status',1)->whereIn('id',$arr)->get();
    }

    public function getScheduleformateAttribute(){
        return $this->Schedule;
    }
    /**
     * Get all of the comments for the Appointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function Review(){
        return $this->hasMany(Review::class);
    }
    
    // 
    public function appointment(){
        return $this->hasMany(Appointment::class,'consultant_id','id');
    }
     public function reviewForView(){
        return $this->hasMany(Review::class,'consultant_id','id');
    }
    public function getReviewcountAttribute(){
        $data = DB::select(DB::raw("SELECT sum(rating)/count(*) as count FROM `reviews` where consultant_id='$this->id'"));
        return $data[0]->count;
    }
    public function appointment_completed(){
        return $this->hasMany(Appointment::class,'consultant_id','id')->where('status','completed');
    }

    public function offer_historys(){
        return $this->hasMany(OfferPurchase::class,'consultant_id');
    }
    public function wallet_trans(){
        return $this->hasMany(Payment::class,'consultant_id','id');
    }
    
     public function wallet(){
        return $this->belongsTo(Wallet::class,'id','consultant_id');
    }

    public function convertcomTemp($companeySetting,$amount,$type,$consultant){
        return ($type == 0)? $this->country->currency->currencycode.' '.$amount.' / '.$companeySetting->country->currency->currencycode.' '.round(($amount/$consultant->country->currency->price)*$companeySetting->country->currency->price,2):
                $amount.'%';
    }

    public function parentcat(){
        return Category::whereIn('id',\explode(',',$this->categorie_id))->where('type',0)->where('status',1)->first();
    }
    public function subcat(){
        return Category::whereIn('id',\explode(',',$this->categorie_id))->where('type',1)->where('status',1)->get();
    }
    public function getspec(){
        return Consultantcategory::whereIn('id',\explode(',',$this->specialized))->where('status',1)->get();
    }
    public function gettimeZone(){
        return new DateTime(null, new DateTimeZone( \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $this->country->country_code)[0]));
    }
    public function checkcomfee(){
        return !($this->com_con_amount == null || $this->com_con_amount == "");
    }
    
    public function checkofferfee(){
        return !($this->com_off_amount == null || $this->com_off_amount == "");
    }
    
    public function GenerateTemplate(){
        $this->TemplateData = new \stdClass();
        $this->TemplateData->{'ConsultantName'} = $this->name;
        $this->TemplateData->{'ConsultantEmail'} = $this->email;
        $this->TemplateData->{'ConsultantPhoneNo'} = $this->phone_no;
        return $this->TemplateData;
    }
}
