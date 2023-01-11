<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Currency;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['country_code','country_name','dialing','has_state','status'];
    protected $appends = ['currency'];
    /**
     * Get the user that owns the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'country_code','countrycode');
    }
    public function getCurrencyAttribute()
    {
        return $this->hasOne(Currency::class,'countryname','country_name')->orwhere('countryname',$this->country_name)->first();
    }
}
