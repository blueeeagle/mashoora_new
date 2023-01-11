<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Companysetting;
use App\Models\Customer;
use App\Models\NotificationSetting;
use Edujugon\PushNotification\PushNotification;
use App\Mail\NotificationMail;
use App\PushNotification\FireBaseNotification;
use Log;
use Illuminate\Support\Facades\Mail;

class CustomerAddAmountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $Customer;
    public $Companysetting;
    public $NotificationSettingIDS = [9,10,11,15,16]; //12,13,14, Not Work
    public $TYPE = [9=>'pn',10=>'mail',11=>'sms',12=>'pn',13=>'mail',14=>'sms',15=>'pn',16 =>'mail'];

    //Identify Data Type
    public $customerKEY = [9,10,11];
    public $consultantKEY = [12,13,14];
    public $AdminKEY = [15,16];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Customer $Customer,$ExtraData = [])
    {
        $this->Customer = $Customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->Companysetting = Companysetting::where('id',1)->first();
        $this->NotificationSetting = NotificationSetting::whereIn('id',$this->NotificationSettingIDS)->where('status',1)->get();
        $this->StartServer();
    }

    function StartServer(){
        foreach ($this->NotificationSetting as $key => $value) {
            Log::info($this->Customer->amount);
            $value->CreateBody($this->Customer);
            
            if($this->TYPE[$value->id] == 'mail') $this->Email($value);
            else if($this->TYPE[$value->id] == 'pn') $this->Notification($value);
            else if($this->TYPE[$value->id] == 'sms') $this->SMS($value);
        }
    }

    function Email($value){

        if(in_array($value->id,$this->customerKEY)){
            try{ if(filter_var($this->Customer->email, FILTER_VALIDATE_EMAIL)) Mail::to($this->Customer->email)->send(new NotificationMail($value->title,$value->HTMLbody)); }
            catch (\Throwable $th) { Log::info($th);   }
        }
        else if(in_array($value->id,$this->AdminKEY)){
            try{ if(filter_var($this->Companysetting->email, FILTER_VALIDATE_EMAIL)) Mail::to($this->Companysetting->email)->send(new NotificationMail($value->title,$value->HTMLbody)); }
            catch (\Throwable $th) { Log::info($th);  }
        }
        else if(in_array($value->id,$this->consultantKEY)){
            //COnsultant
        }
    }
    function SMS(){
        //SMS Function
    }
    function Notification($value){
        if(in_array($value->id,$this->customerKEY) && $this->Customer->notifiation_token){
            try{
            $FireBaseNotification = new FireBaseNotification([$this->Customer->notifiation_token],$value->NotificationData(['type'=>'Wallet','id'=>'']));
            $FireBaseNotification->SaveData($value->title,$value->WithoutHTML,$this->Customer->id);
            Log::info(get_object_vars($FireBaseNotification->response));
            }catch (\Throwable $th) { Log::info($th);   }
            
        }
        else if(in_array($value->id,$this->AdminKEY)){
            //Admin Notification
        }
    }
}
