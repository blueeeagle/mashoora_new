<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Communication;
use App\Models\CommunicationSend;
use Log;
use App\Mail\CommuicationMail;
use Illuminate\Support\Facades\Mail;
use App\PushNotification\CommunicationNotification;

class CommunicationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Sent:Communication';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Communication';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $Communication = Communication::where('status',0)->where('send_on',  date('Y-m-d'))->get();
        foreach ($Communication as $value) {
            # code...
            if($value->communication_mode == 2) $this->SentEmail($value);
            else if($value->communication_mode == 1) $this->SentNotification($value);
            else if($value->communication_mode == 0) $this->SentSMS($value);
            $value->status = 1;
            $value->update();
        }
    }

    function SentEmail($value){
        foreach ($value->data->sendto as $user) {
            Log::info($user->email);
            try{ if(filter_var($user->email, FILTER_VALIDATE_EMAIL)) Mail::to($user->email)->send(new CommuicationMail($value)); }
            catch (\Throwable $th) {  Log::info($th); }
        }
    }

    function SentNotification($value){
        $CommunicationNotification  = new CommunicationNotification($value);
        $CommunicationNotification->SendToAndroid();
    }

    function SentSMS($value){
        $CommunicationNotification  = new CommunicationNotification($value);
        $CommunicationNotification->SendToAndroid();
    }
}
