<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Companysetting;
use App\Models\Consultant;
use App\Models\NotificationSetting;
use Edujugon\PushNotification\PushNotification;
use App\Mail\NotificationMail;
use App\PushNotification\FireBaseNotification;
use Log;
use Illuminate\Support\Facades\Mail;

class ConsultantProfileApprovelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $Consultant;
    public $TemplateData = null;
    public $Companysetting;
    public $NotificationSettingIDS = [217,218,219,220,221,222,223,224];
    public $TYPE = [217=>'pn',218=>'mail',219=>'sms',220=>'pn',221=>'mail',222=>'sms',223=>'pn',224 =>'mail'];

    //Identify Data Type
    public $customerKEY = [217,218,219];
    public $consultantKEY = [220,221,222];
    public $AdminKEY = [223,224];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Consultant $Consultant)
    {
        $this->Consultant = $Consultant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->TemplateData = $this->Consultant->GenerateTemplate();
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
            //Customer
        }
        else if(in_array($value->id,$this->AdminKEY)){
            try{ if(filter_var($this->Companysetting->email, FILTER_VALIDATE_EMAIL)) Mail::to($this->Companysetting->email)->send(new NotificationMail($value->title,$value->HTMLbody)); }
            catch (\Throwable $th) { Log::info($th);  }
        }
        else if(in_array($value->id,$this->consultantKEY)){
            //COnsultant
            try{ if(filter_var($this->Consultant->email, FILTER_VALIDATE_EMAIL)) Mail::to($this->Consultant->email)->send(new NotificationMail($value->title,$value->HTMLbody)); }
            catch (\Throwable $th) { Log::info($th);  }
        }
    }
    function SMS(){
        //SMS Function
    }
    function Notification($value){
        if(in_array($value->id,$this->customerKEY) && $this->Consultant->notifiation_token){
            //Customer
        }
        else if(in_array($value->id,$this->AdminKEY)){
            //Admin Notification
        }
        else if(in_array($value->id,$this->consultantKEY) && $this->Consultant->notifiation_token){
            try{
                $FireBaseNotification = new FireBaseNotification([$this->Consultant->notifiation_token],$value->NotificationData(['type'=>'consultant','id'=>$this->Consultant->id]));
                $FireBaseNotification->SaveData($value->title,$value->WithoutHTML,null,$this->Consultant->id);
                Log::info(get_object_vars($FireBaseNotification->response));
                }catch (\Throwable $th) { Log::info($th);   }
        }
    }
}
