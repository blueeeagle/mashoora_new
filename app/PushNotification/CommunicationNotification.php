<?php
namespace App\PushNotification;

use Log;
use App\Models\Communication;
use App\Models\CommunicationSend;
use Edujugon\PushNotification\PushNotification;

Class CommunicationNotification {
    public $Communication;
    public $CommunicationSend;
    public $AndroiDeviceToken = [];
    public $AppleDeviceToken = [];


    public function __construct(Communication $Communication){
        $this->Communication = $Communication;
        $this->CommunicationSend = $Communication->data;
        $this->SeperateDevice();
    }

    function SendToAndroid(){
        $push = new PushNotification('fcm');
        Log::alert("Notification IN");
        Log::alert($this->AndroiDeviceToken);
        $response = $push->setMessage($this->notificationMessage())
        ->setApiKey('AAAA5l0ZryY:APA91bGc0eCMkJ52rKFfy3lUUroSMF-3doGmRBkEe1xD33hKAH6q1P3-wYZ53QZcv__dgNp1nOBZDPaTPIW--0QbcWe_Ph9ASdEDt06aqpbdz7sN7YzuUpZG4YWlBbZdmK65Y0s2hJoT')
        ->setDevicesToken($this->AndroiDeviceToken)
        ->send()
        ->getFeedback();
        // dd($response);
        Log::alert(get_object_vars($response));
    }

    function notificationMessage(){
        return  ['notification' =>
        ['title'=>'This is the title',
        'body'=>'This is the message',
        'sound' => 'default']];
    }

    function SeperateDevice(){
        foreach ($this->CommunicationSend->sendto as $value) {
            # code...
            Log::info($value);
            if($value->deviceType == 'Android') $this->AndroiDeviceToken[] =  $value->notifiation_token;
        }
    }
}
