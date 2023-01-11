<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedule;
use Carbon\Carbon;
use App\Models\Companysetting;
use App\SMS\SmsCommunication;
use App\Models\NotificationSetting;
use App\Mail\NotificationMail;
use App\PushNotification\FireBaseNotification;
use Illuminate\Support\Facades\Mail;

class scheduleRremainder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Schedule:OneDay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public $Companysetting;
    public $NotificationSettingIDS = [209,210,211,212,213,214,215,216];
    public $TYPE = [209=>'pn',210=>'mail',211=>'sms',212=>'pn',213=>'mail',214=>'sms',215=>'pn',216 =>'mail'];
    public $NotificationSetting = [];
    public $Schedule;
    public $TemplateData;

    //Identify Data Type
    public $customerKEY = [209,210,211];
    public $consultantKEY = [212,213,214];
    public $AdminKEY = [215,216];

    public function handle()
    {
        $ScheduleSeven = Schedule::whereBetween('to_date',[Carbon::now()->subDays(8)->toDateTimeString(),Carbon::now()->subDays(6)->toDateTimeString()])->get();
        $ScheduleThree = Schedule::whereBetween('to_date',[Carbon::now()->subDays(4)->toDateTimeString(),Carbon::now()->subDays(2)->toDateTimeString()])->get();
        $ScheduleOne = Schedule::whereBetween('to_date',[Carbon::now()->subDays(2)->toDateTimeString(),Carbon::now()->now()->toDateTimeString()])->get();
        $ScheduleOne->merge($ScheduleThree);
        $ScheduleOne->merge($ScheduleSeven);

        $this->Companysetting = Companysetting::where('id',1)->first();
        $this->NotificationSetting = NotificationSetting::whereIn('id',$this->NotificationSettingIDS)->where('status',1)->get();

        foreach ($ScheduleOne as $Schedule) {
            $this->Schedule = $Schedule;
            $this->TemplateData = $this->Schedule->GenerateTemplate();
            $this->StartServer();
        }
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
            //customer
        }
        else if(in_array($value->id,$this->AdminKEY)){
            try{ if(filter_var($this->Companysetting->email, FILTER_VALIDATE_EMAIL)) Mail::to($this->Companysetting->email)->send(new NotificationMail($value->title,$value->HTMLbody)); }
            catch (\Throwable $th) { Log::info($th);  }
        }
        else if(in_array($value->id,$this->consultantKEY)){
            //COnsultant
            try{ if(filter_var($this->Schedule->Consultant->email, FILTER_VALIDATE_EMAIL)) Mail::to($this->Schedule->Consultant->email)->send(new NotificationMail($value->title,$value->HTMLbody)); }
            catch (\Throwable $th) { Log::info($th);  }
        }
    }
    function SMS($value){
        $SmsCommunication = new SmsCommunication('','');
    }
    function Notification($value){
        if(in_array($value->id,$this->customerKEY) && $this->Appointment->customer->notifiation_token){
            //Customer
        }
        else if(in_array($value->id,$this->AdminKEY)){
            //Admin Notification
        }
        else if(in_array($value->id,$this->consultantKEY) && $this->Schedule->Consultant->notifiation_token){
            try{
                $FireBaseNotification = new FireBaseNotification([$this->Schedule->Consultant->notifiation_token],$value->NotificationData(['type'=>'Schedule','id'=>$this->Schedule->id]));
                $FireBaseNotification->SaveData($value->title,$value->WithoutHTML,null,$this->Schedule->Consultant->id);
                Log::info(get_object_vars($FireBaseNotification->response));
                }catch (\Throwable $th) { Log::info($th);   }
        }
    }
}
