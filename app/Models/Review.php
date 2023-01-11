<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['consultant_id','customer_id','comments','rating'];
    protected $appends = ['createdate'];
    
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function consultant(){
        return $this->belongsTo(Consultant::class,'consultant_id');
    }
    
    public function getCreatedateAttribute(){
        return date('Y-m-d',strtotime($this->created_at));
    }
}
