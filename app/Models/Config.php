<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Offer;
class Config extends Model
{
    use HasFactory;
    protected $appends = ['category'];
    protected $fillable = ['choose_section','category_id','type','discount_id','offer_id','sort_no','status'];

    public function category(){
        // dd($this->id);
        // $cat = explode(',', $this->category_id);
        // $category = Category::whereIn('id', $cat)->get();
        return $category;
    }
    public function discount(){
        return $this->belongsTo(Discount::class,'discount_id');
    }
    public function offer(){
        return $this->belongsTo(Offer::class,'offer_id');
    }

    public function getCategoryAttribute()
    {
        return Category::whereIn('id',\explode(',',$this->category_id))->where('status',1)->get();
    }
}
