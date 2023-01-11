<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class Insurance extends Model
{
    use HasFactory;

    protected $fillable = ['comapany_name','legal_name','have_tax','taxation_number','register_on','logo','consultant_type',
    'register_address','country_id','state_id','city_id','zipcode',
    'cname','ctitle','cemail','cmobile','cphone','status'];

    public function country(){
        return $this->belongsTo(Country::class);
   }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
   }

}
