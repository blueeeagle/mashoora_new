<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function consultant(){
        return $this->belongsTo(Consultant::class, 'consultant_id');
    }
}
