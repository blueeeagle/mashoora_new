<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;


class State extends Model
{
    use HasFactory;

    protected $fillable = ['country_id','state_name'];

    public function Countrys(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
