<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OfferLog;
use Auth;
use App\Models\Companysetting;

class OfferPurchase extends Model
{
    use HasFactory;
    
    // protected $fillable = ['from_user','consultant_id','firm_id','admin_id','title','image','describtion','status'];
    protected $table = 'offerpurchases';
    protected $appends = ['offer'];
    
    protected static function boot(){

        parent::boot();

        static::created(function ($model) {
            $AppointmentLog = new OfferLog;
            $AppointmentLog->offerPurchase_id = $model->id;
            $AppointmentLog->action_by = 'Customer';
            $AppointmentLog->action = 'Offer Purchased';
            $AppointmentLog->description = 'Customer Offer Purchased Waiting for Approved';
            $AppointmentLog->save();
        });

        static::updated(function($model) {
            $action_by = 'Admin';$user_id = '';
            
            if(static::activeGuard() != 'web'){
                if(static::activeGuard() == 'consultant') $action_by = "Consultant";
                else $action_by = "Customer";
            }else $user_id = Auth::guard(static::activeGuard())->user()->id;
            
            if ($model->isDirty('pay_in')){
                $action = '';
                $description = '';
                if($model->pay_in == 1){
                    $description = 'Offer Purchased Move To Approval';
                    $action = 'Pending';
                }else if($model->pay_in == 2){
                    $description = 'Pay In Approved amount transferred to wallet';
                    $action = 'Approved';
                }elseif($model->pay_in == 3) {
                    # code...
                    $description = 'Pay In Decline';
                    $action = 'Decline';
                }
                $AppointmentLog = new OfferLog;
                $AppointmentLog->offerPurchase_id = $model->id;
                $AppointmentLog->action_by = $action_by;
                $AppointmentLog->user_id = $user_id;
                $AppointmentLog->action = $action;
                $AppointmentLog->description = $description;
                $AppointmentLog->save();
            }

        });
    }

    static private function activeGuard(){

        foreach(array_keys(config('auth.guards')) as $guard){

            if(auth()->guard($guard)->check()) return $guard;

        }
        return null;
    }
    
    public function offer(){
        return $this->belongsTo(Offer::class,'offer_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function consultant(){
        return $this->belongsTo(Consultant::class, 'consultant_id');
    }
    public function getOfferAttribute(){
        try {
            return unserialize(bzdecompress(utf8_decode($this->rawoffer)));
        } catch (\Throwable $th) {
            return null;
        }
    }
    
    public function GenerateTemplate(){
        $Companysetting = Companysetting::where('id',1)->first();
        $rawoffer = unserialize(bzdecompress(utf8_decode($this->rawoffer)));
        $this->TemplateData = new \stdClass();
        $this->TemplateData->{'ConsultantName'} = $this->consultant->name;
        $this->TemplateData->{'ConsultantEmail'} = $this->consultant->email;
        $this->TemplateData->{'ConsultantPhoneNo'} = $this->consultant->phone_no;

        $this->TemplateData->{'PurchaseID'} = $this->payment_id;
        $this->TemplateData->{'CustomerName'} = $this->customer->name ?? '';
        $this->TemplateData->{'CustomerAmount'} = $rawoffer->customer_currency->currencycode.' '.$rawoffer->amount_converted;

        $this->TemplateData->{'consultantAmount'} = $this->consultant->country->currency->currencycode.' '.$this->amount;
        $this->TemplateData->{'AdminAmount'} = $Companysetting->country->currency->currencycode.' '.round($this->amount/$Companysetting->country->currency->price,2);
        $this->TemplateData->{'description'} = $this->description;
        $this->TemplateData->{'offerTitle'} = $this->offer_title;
        return $this->TemplateData;
    }
}
