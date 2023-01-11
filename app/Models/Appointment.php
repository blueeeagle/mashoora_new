<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use Auth;
use App\Models\Customer;
use App\Models\Consultant;
use App\Http\Controllers\Api\Booking;
use App\Models\Payment;
use App\Models\Insurance;
use App\Models\AppointmentLog;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [];
    public $Booking=null;
    
    
    protected static function boot(){

        parent::boot();

        static::created(function ($model) {
            $AppointmentLog = new AppointmentLog;
            $AppointmentLog->appointment_id = $model->id;
            $AppointmentLog->action_by = 'Customer';
            $AppointmentLog->action = 'Appointment Created';
            $AppointmentLog->description = 'Creating New Appointment';
            $AppointmentLog->save();
        });

        static::updated(function($model) {
            $action_by = 'Admin';$user_id = '';
            
            if(static::activeGuard() != 'web'){
                if(static::activeGuard() == 'consultant') $action_by = "Consultant";
                else $action_by = "Customer";
            }else $user_id = Auth::guard(static::activeGuard())->user()->id;
            
        if ($model->isDirty('status')){

            $AppointmentLog = new AppointmentLog;
            $AppointmentLog->appointment_id = $model->id;
            $AppointmentLog->action_by = $action_by;
            $AppointmentLog->user_id = $user_id;
            $AppointmentLog->action = $model->getOriginal('status').' To ' .$model->status;
            $AppointmentLog->description = 'Status Updating';
            $AppointmentLog->save();
            }

            if ($model->isDirty('pay_in')){
                $action = '';
                $description = '';
                if($model->pay_in == 1){
                    $description = 'Appointment Move To Approval';
                    $action = 'Pending';
                }else if($model->pay_in == 2){
                    $description = 'Pay In Approved amount transferred to wallet';
                    $action = 'Approved';
                }else {
                    # code...
                    $description = 'Pay In Decline';
                    $action = 'Decline';
                }
                $AppointmentLog = new AppointmentLog;
                $AppointmentLog->appointment_id = $model->id;
                $AppointmentLog->action_by = $action_by;
                $AppointmentLog->user_id = $user_id;
                $AppointmentLog->action = $action;
                $AppointmentLog->description = $description;
                $AppointmentLog->save();
            }
            if ($model->isDirty('appointment_date')){ 
                $AppointmentLog = new AppointmentLog;
                $AppointmentLog->appointment_id = $model->id;
                $AppointmentLog->action_by = 'Customer';
                $AppointmentLog->user_id = '';
                $AppointmentLog->action = 'Customer Reschedule';
                $AppointmentLog->description = 'Status Updating';
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
    
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function consultant(){
        return $this->belongsTo(Consultant::class, 'consultant_id');
    }
    public function Review()
    {
        return $this->hasOne(Review::class)->where('customer_id',Auth::guard('customer')->user()->id);
    }
    public function consultantsingleAppreview()
    {
        return $this->belongsTo(Review::class,'id','appointment_id');
    }
    // 
    public function transaction(){
        return $this->belongsTo(Payment::class,'id','appointment_id');
    }
     public function insurance(){
        return $this->belongsTo(Insurance::class,'insurance_id','id');
    }
    
     public function pay_approvals(){
        return $this->belongsTo(PayApproval::class,'id','appointment_id');
    }
    
    public function unse(){
        $Booking = unserialize(bzdecompress(utf8_decode($this->rawdata)));
        return $Booking;
    }
    
    public function getBookingAttribute(){
        try {
            return unserialize(bzdecompress(utf8_decode($this->rawdata)));
        } catch (\Throwable $th) {
            return null;
        }
    }
    
    public function getAppointmentAttribute()
    {
        try {
            //code...
            $this->Booking = unserialize(bzdecompress(utf8_decode($this->rawdata)));        

        } catch (\Throwable $th) {
            //throw $th;
            $this->Booking = null;  

        }
    }
    
    public function GenerateTemplate(){

        $this->Booking = unserialize(bzdecompress(utf8_decode($this->rawdata)));
        $this->TemplateData = new \stdClass();
        $this->TemplateData->{'CustomerName'} = $this->customer->name;
        $this->TemplateData->{'BookingID'} = "BK-$this->id";
        $this->TemplateData->{'ConsultantName'} = $this->Booking->consultant->name;
        $this->TemplateData->{'CustomerAmount'} = $this->Booking->customercurrnecy->currencycode.''.$this->Booking->amount;
        $this->TemplateData->{'ConsultantAmount'} = $this->Booking->consultantcurrency->currencycode.' '.($this->Booking->amount/$this->Booking->customercurrnecy->price)*$this->Booking->consultantcurrency->price;
        //create Date
        $date = date_create($this->appointment_date);
        $datestr = date_format($date,"M d,Y,l");
        $datestr .= ' '.date_format($date,"h:i a")." - ". date("h:i a",strtotime(date_format($date,"Y-m-d H:i")) + $this->Booking->consultant->preferre_slot*60);
        $this->TemplateData->{'AppointmentCustomerDate'} = $datestr;
        //create date
        date_default_timezone_set($this->Booking->consultantTimeZone);
        $date = strtotime($this->appointment_date) - ($this->Booking->diff);
        $date = date("Y-m-d H:i",$date);
        $date = date_create($date);
        $datestr = date_format($date,"M d,Y,l");
        $datestr .= ' '.date_format($date,"h:i a")." - ". date("h:i a",strtotime(date_format($date,"Y-m-d H:i")) + $this->Booking->consultant->preferre_slot*60);

        $this->TemplateData->{'AppointmentConsultantDate'} = $datestr;
        $this->TemplateData->{'insurance'} = $this->insurance->comapany_name ?? '';
        $this->TemplateData->{'PolicyID'} = $this->policyid ?? '';
        $this->TemplateData->{'AppointmentType'} = $this->Booking->type;
        $this->TemplateData->{'Category'} = $this->Booking->cat_id['cat']->name ?? '';
        $this->TemplateData->{'status'} = $this->status;
        $this->TemplateData->{'GracePeriod'} = $this->Booking->Companysetting->discard_cut_off_time;
        $this->TemplateData->{'Review'} =  $this->consultantsingleAppreview->comments ?? '';
        $this->TemplateData->{'Rating'} =  $this->consultantsingleAppreview->rating ?? '0.0';
        return $this->TemplateData;
    }
    
}
