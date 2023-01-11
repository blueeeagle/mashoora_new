<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Currency;

class Companysetting extends Model
{
    use HasFactory;

    protected $fillable = ['comapany_name','legal_name','have_tax','taxation_number','register_on','about_us','register_address','country_id','state_id',
    'city_id','zipcode','currencie_id','time_zone','date_format','reschedule_cut_off_time','discard_cut_off_time','cname','ctitle',
    'cemail','cmobile','logo_login_page','logo_header','cphone','status','email'];

public function country(){
    return $this->belongsTo(Country::class);
}
public function state(){
    return $this->belongsTo(State::class);
}
public function city(){
    return $this->belongsTo(City::class);
}
public function custom_date_time($date){
    return date($this->date_format,strtotime($date));
}

    // public function getHavetaxAttribute(){
    //     // return ($this->have_tax)?'Yes':'No';
    // }
}
