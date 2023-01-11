<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Companysetting;
use App\Models\OfferPurchase;
use App\Models\NotificationSetting;
use Edujugon\PushNotification\PushNotification;
use App\Mail\NotificationMail;
use App\PushNotification\FireBaseNotification;
use Log;
use Illuminate\Support\Facades\Mail;

class PurchasOfferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $OfferPurchase;
    public $TemplateData = null;
    public $Companysetting;
    public $NotificationSettingIDS = [233,234,235,236,237,238,239,240];
    public $TYPE = [233=>'pn',234=>'mail',235=>'sms',236=>'pn',237=>'mail',238=>'sms',239=>'pn',240 =>'mail'];

    //Identify Data Type
    public $customerKEY = [233,234,235];
    public $consultantKEY = [236,237,238];
    public $AdminKEY = [239,240];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(OfferPurchase $OfferPurchase)
    {
        $this->OfferPurchase = $OfferPurchase;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->TemplateData = $this->OfferPurchase->GenerateTemplate();
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
            try{ if(filter_var($this->OfferPurchase->consultant->email, FILTER_VALIDATE_EMAIL)) Mail::to($this->OfferPurchase->consultant->email)->send(new NotificationMail($value->title,$value->HTMLbody)); }
            catch (\Throwable $th) { Log::info($th);  }
        }
    }
    function SMS(){
        //SMS Function
    }
    function Notification($value){
        if(in_array($value->id,$this->customerKEY) && $this->OfferPurchase->consultant->notifiation_token){
            //Customer
        }
        else if(in_array($value->id,$this->AdminKEY)){
            //Admin Notification
        }
        else if(in_array($value->id,$this->consultantKEY) && $this->OfferPurchase->consultant->notifiation_token){
            try{
                $FireBaseNotification = new FireBaseNotification([$this->OfferPurchase->consultant->notifiation_token],$value->NotificationData(['type'=>'offer','id'=>$this->OfferPurchase->id]));
                $FireBaseNotification->SaveData($value->title,$value->WithoutHTML,null,$this->OfferPurchase->consultant->id);
                Log::info(get_object_vars($FireBaseNotification->response));
                }catch (\Throwable $th) { Log::info($th);   }
        }
    }
}
