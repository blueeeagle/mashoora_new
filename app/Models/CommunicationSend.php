<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer;
use App\Models\Consultant;

class CommunicationSend extends Model
{
    use HasFactory;

    protected $fillable = ['communication_id','customer_id','consultant_id','others'];
    protected $appends = ['sendto'];

    public function getSendtoAttribute(){
        if($this->customer_id){
            $customer_id = \explode(',',$this->customer_id);
            return Customer::whereIn('id',$customer_id)->get();
        }elseif ($this->consultant_id) {
            $consultant_id = \explode(',',$this->consultant_id);
            return Consultant::whereIn('id',$consultant_id)->get();
        }
    }

}

