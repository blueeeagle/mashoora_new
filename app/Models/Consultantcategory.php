<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Consultantcategory extends Model
{
    use HasFactory;

    protected $fillable = ['categorie_id','subcategorie_id','title','status'];

    public function Category(){
        return  $this->belongsTo(Category::class,'categorie_id')->where('status',1);
    }

    public function SubCategory(){
        return  $this->belongsTo(Category::class,'subcategorie_id')->where('status',1);
    }
    
    public function CategoryAlter(){
        return  $this->belongsTo(Category::class,'categorie_id')->where('status',1)->select('name');
    }

    public function SubCategoryAlter(){
        return  $this->belongsTo(Category::class,'subcategorie_id')->where('status',1)->select('name');
    }

}
