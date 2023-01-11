<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{
    use HasFactory;

    protected $table = 'purchase_history';

    // public function consultant(){
    //     return $this->belongsTo(Consultant::class, 'consultant_id');
    // }
    // public function firm(){
    //     return $this->belongsTo(Firm::class, 'firm_id');
    // }
    // public function user(){
    //     return $this->belongsTo(User::class, 'admin_id');
    // }
}
