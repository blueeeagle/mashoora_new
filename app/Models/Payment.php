<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consultant;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    public function consultant(){
        return $this->belongsTo(Consultant::class, 'consultant_id');
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

}
