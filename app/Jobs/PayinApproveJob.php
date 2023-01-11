<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Companysetting;
use App\Models\Appointment;
use App\Models\NotificationSetting;
use Edujugon\PushNotification\PushNotification;
use App\Mail\NotificationMail;
use App\PushNotification\FireBaseNotification;
use Log;
use Illuminate\Support\Facades\Mail;

class PayinApproveJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $Appointment;
    public $TemplateData = null;
    public $Booking = null;
    public $Companysetting;
    public $NotificationSettingIDS = [97,98,99,100,101,102,103,104];
    public $TYPE = [97=>'pn',98=>'mail',99=>'sms',100=>'pn',101=>'mail',102=>'sms',103=>'pn',104 =>'mail'];

    //Identify Data Type
    public $customerKEY = [97,98,99];
    public $consultantKEY = [100,101,102];
    public $AdminKEY = [103,104];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Appointment $Appointment)
    {
        $this->Appointment = $Appointment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->TemplateData = $this->Appointment->GenerateTemplate();
        $this->Booking = $this->Appointment->Booking;
        $this->Companysetting = Companysetting::where('id',1)->first();
        $this->NotificationSetting = NotificationSetting::whereIn('id',$this->NotificationSettingIDS)->where('status',1)->get();
        $this->StartServer();
    }

    function StartServer(){
        foreach ($this->NotificationSetting as $key => $value) {
            $value->CreateBody($this->TemplateData);
            if($this->TYPE[$value->id] == 'mail') $this->Email($value);
            else if($this->TYPE[$value->id] == 'pn') $this->Notification($value);
            else if($this->TYPE[$value->id] == 'sms') $this->SMS($value);
        }
    }

    function Email($value){

        if(in_array($value->id,$this->customerKEY)){
            try{ if(filter_var($this->Appointment->customer->email, FILTER_VALIDATE_EMAIL)) Mail::to($this->Appointment->customer->email)->send(new NotificationMail($value->title,$value->HTMLbody)); }
            catch (\Throwable $th) { Log::info($th);   }
        }
        else if(in_array($value->id,$this->AdminKEY)){
            try{ if(filter_var($this->Companysetting->email, FILTER_VALIDATE_EMAIL)) Mail::to($this->Companysetting->email)->send(new NotificationMail($value->title,$value->HTMLbody)); }
            catch (\Throwable $th) { Log::info($th);  }
        }
        else if(in_array($value->id,$this->consultantKEY)){
            //COnsultant
            try{ if(filter_var($this->Booking->consultant->email, FILTER_VALIDATE_EMAIL)) Mail::to($this->Booking->consultant->email)->send(new NotificationMail($value->title,$value->HTMLbody)); }
            catch (\Throwable $th) { Log::info($th);  }
        }
    }
    function SMS(){
        //SMS Function
    }
    function Notification($value){
        if(in_array($value->id,$this->customerKEY) && $this->Appointment->customer->notifiation_token){
            try{
            $FireBaseNotification = new FireBaseNotification([$this->Appointment->customer->notifiation_token],$value->NotificationData(['type'=>'Booking','id'=>$this->Appointment->id]));
            $FireBaseNotification->SaveData($value->title,$value->WithoutHTML,$this->Appointment->customer->id);
            Log::info(get_object_vars($FireBaseNotification->response));
            }catch (\Throwable $th) { Log::info($th);   }
        }
        else if(in_array($value->id,$this->AdminKEY)){
            //Admin Notification
        }
        else if(in_array($value->id,$this->consultantKEY) && $this->Booking->consultant->notifiation_token){
            try{
                $FireBaseNotification = new FireBaseNotification([$this->Booking->consultant->notifiation_token],$value->NotificationData(['type'=>'Booking','id'=>$this->Appointment->id]));
                $FireBaseNotification->SaveData($value->title,$value->WithoutHTML,null,$this->Booking->consultant->id);
                Log::info(get_object_vars($FireBaseNotification->response));
                }catch (\Throwable $th) { Log::info($th);   }
        }
    }
}
