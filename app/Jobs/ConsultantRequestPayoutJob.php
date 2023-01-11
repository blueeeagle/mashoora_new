<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Companysetting;
use App\Models\PayApproval;
use App\Models\NotificationSetting;
use Edujugon\PushNotification\PushNotification;
use App\Mail\NotificationMail;
use App\PushNotification\FireBaseNotification;
use Log;
use Illuminate\Support\Facades\Mail;

class ConsultantRequestPayoutJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $PayApproval;
    public $TemplateData = null;
    public $Companysetting;
    public $NotificationSettingIDS = [185,186,187,189,190,191,192,193];
    public $TYPE = [185=>'pn',186=>'mail',187=>'sms',189=>'pn',190=>'mail',191=>'sms',192=>'pn',193 =>'mail'];

    //Identify Data Type
    public $customerKEY = [185,186,187];
    public $consultantKEY = [189,190,191];
    public $AdminKEY = [192,193];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PayApproval $PayApproval)
    {
        $this->PayApproval = $PayApproval;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->TemplateData = $this->PayApproval->GenerateTemplate();
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
            try{ if(filter_var($this->PayApproval->consultant->email, FILTER_VALIDATE_EMAIL)) Mail::to($this->PayApproval->consultant->email)->send(new NotificationMail($value->title,$value->HTMLbody)); }
            catch (\Throwable $th) { Log::info($th);  }
        }
    }
    function SMS(){
        //SMS Function
    }
    function Notification($value){
        if(in_array($value->id,$this->customerKEY) && $this->PayApproval->consultant->notifiation_token){
            //Customer
        }
        else if(in_array($value->id,$this->AdminKEY)){
            //Admin Notification
        }
        else if(in_array($value->id,$this->consultantKEY) && $this->PayApproval->consultant->notifiation_token){
            try{
                $FireBaseNotification = new FireBaseNotification([$this->PayApproval->consultant->notifiation_token],$value->NotificationData(['type'=>'payout','id'=>$this->PayApproval->id]));
                $FireBaseNotification->SaveData($value->title,$value->WithoutHTML,null,$this->PayApproval->consultant->id);
                Log::info(get_object_vars($FireBaseNotification->response));
                }catch (\Throwable $th) { Log::info($th);   }
        }
    }
}
