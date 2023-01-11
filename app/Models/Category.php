<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Offer;
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['type','name','categories_id','description','tags','img','sort_no_list','sort_no_home','status','display_in_home','document_id'];

    public function getchild($id,$count=true){
        if($count){
            return Category::where('parent',$id)->count();
        }
        return Category::where('parent',$id)->get();
    }

    public function child(){
        return $this->hasMany(Category::class, 'categories_id','')->orderBy('sort_no_list')->where('status',1);
    }
    public function child_forIndex(){
        return $this->belongsTo(Category::class, 'categories_id')->where('status',1);
    }
    public function childCategory(){
        return $this->hasMany(Category::class, 'categories_id')->where('status',1);
    }
   
    public function delete(){
        // Do some stuff before delete
        Storage::disk('public_custom')->delete($this->img);
        return parent::delete();
    }
    public function spec(){
        return $this->belongsTo(Consultantcategory::class,'id','categorie_id');
    }
    
    // 
    public function parent(){
        return $this->belongsTo(Category::class, 'categories_id','id')->where('status',1);
    }
    
    public function childForCreate(){
        return $this->belongsTo(Category::class, 'categories_id')->where('status',1);
    }
}
// Storage::disk('public_custom')->delete($category->img);
