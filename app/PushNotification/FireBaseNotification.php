<?php
namespace App\PushNotification;

use Log;
use Edujugon\PushNotification\PushNotification;
use App\Models\Notificationdata;

Class FireBaseNotification {
    public $AndroiDeviceToken = [];
    Public $Notification;
    public $push = null;
    Public $response = null;

    public function __construct($AndroiDeviceToken = [],$Notification = []){
        $this->AndroiDeviceToken = $AndroiDeviceToken;
        $this->Notification = $Notification;
        if(!empty($this->AndroiDeviceToken)  && !empty($this->Notification)){
            $this->push = new PushNotification('fcm');
            $this->push->setApiKey('AAAAMTJ0KVA:APA91bHyMG97ymkjH9CaIF7LNMV6T_K_D4tJJpIRHVHvo24EGvO5U6IlQc7Ehm_88FpAavRTNh1GyJlQMKRT1RJfn0VJERgCDVeRHCwukyrpEZ3eNMlbklU4ks3yp-_2QINtMkWcqjNb');
            $this->SentNotification();
        }
    }

    function SentNotification(){
        $this->response = $this->push->setMessage($this->Notification)
        ->setDevicesToken($this->AndroiDeviceToken)
        ->send()
        ->getFeedback();
    }
    
    public function SaveData($title,$body,$customer_id=null,$consultant_id=null){
        $Notificationdata = new Notificationdata;
        $Notificationdata->title =  $title;
        $Notificationdata->body =  $body;
        $Notificationdata->customer_id =  $customer_id;
        $Notificationdata->consultant_id =  $consultant_id;
        $Notificationdata->save();
    }
}
