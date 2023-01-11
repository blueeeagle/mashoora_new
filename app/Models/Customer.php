<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Currenct;
use App\Models\OfferPurchase;
use App\Models\Appointment;
class Customer extends Authenticatable
{
    use HasFactory;


    protected $fillable = ['phone_no','name','dob','gender','email','register_address','country_id','state_id','city_id','zipcode','status','dialing'];

    public function country(){
        return $this->belongsTo(Country::class);
   }
   
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
   }
      public function dialingcountry(){
    return $this->belongsTo(Country::class,'country_code','country_code');
    }
    public function OfferPurchase(){
        return $this->hasMany(OfferPurchase::class)->where('pay_in','!=','3');
    }
    // 
    public function wallet(){
        return $this->belongsTo(Wallet::class,'id','customer_id');
    }
    public function appointment_completed(){
        return $this->hasMany(Appointment::class,'customer_id','id')->where('status','completed');
    }
   public function appointment(){
        return $this->hasMany(Appointment::class,'customer_id','id');
    }
    public function reviews(){
        return $this->hasMany(Review::class,'customer_id','id');
    }
    public function wallet_trans(){
        return $this->hasMany(Payment::class,'customer_id','id');
    }
    public function offer_history(){
        return $this->hasMany(OfferPurchase::class,'customer_id','id');
    }

}
