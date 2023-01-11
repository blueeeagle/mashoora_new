<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consultant;

class PayApproval extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function consultant(){
        return $this->belongsTo(Consultant::class);
    }
}
