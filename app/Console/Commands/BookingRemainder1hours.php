<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Models\Companysetting;
use Carbon\Carbon;
use App\SMS\SmsCommunication;
use App\Models\NotificationSetting;
use Edujugon\PushNotification\PushNotification;
use App\Mail\NotificationMail;
use App\PushNotification\FireBaseNotification;
use Illuminate\Support\Facades\Mail;
use Log;
class BookingRemainder1hours extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BookingReminder:1hour';

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
    public $Appointment;
    public $TemplateData = null;
    public $Booking = null;
    public $Companysetting;
    public $NotificationSettingIDS = [33,34,35,36,37,38,39,40];
    public $TYPE = [33=>'pn',34=>'mail',35=>'sms',36=>'pn',37=>'mail',38=>'sms',39=>'pn',40 =>'mail'];
    public $NotificationSetting = [];

    //Identify Data Type
    public $customerKEY = [33,34,35];
    public $consultantKEY = [36,37,38];
    public $AdminKEY = [39,40];

    public function handle()
    {
        $ArrayAppointment = Appointment::where('reminder_one',0)->where('appointment_date','<',Carbon::now()->subHours(1)->toDateTimeString())->get();
        $this->Companysetting = Companysetting::where('id',1)->first();
        $this->NotificationSetting = NotificationSetting::whereIn('id',$this->NotificationSettingIDS)->where('status',1)->get();
        foreach ($ArrayAppointment as $Appointment) {
            # code...
            $this->Appointment = $Appointment;
            $this->TemplateData = $this->Appointment->GenerateTemplate();
            $this->Booking = $Appointment->Booking;
            $this->StartServer();
        }
        Appointment::whereIn('id',$ArrayAppointment->Pluck('id'))->update(['reminder_one'=>1]);
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
    function SMS($value){
        $SmsCommunication = new SmsCommunication('','');
    }
    function Notification($value){
        if(in_array($value->id,$this->customerKEY) && $this->Appointment->customer->notifiation_token){
            $FireBaseNotification = new FireBaseNotification([$this->Appointment->customer->notifiation_token],$value->NotificationData(['type'=>'Booking','id'=>$this->Appointment->id]));
            $FireBaseNotification->SaveData($value->title,$value->WithoutHTML,$this->Appointment->customer->id);
            Log::info(get_object_vars($FireBaseNotification->response));
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
