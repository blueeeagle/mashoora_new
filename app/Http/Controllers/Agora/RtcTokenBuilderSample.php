<?php
namespace App\Http\Controllers\Agora;
use App\Http\Controllers\Agora\RtcTokenBuilder;


class RtcTokenBuilderSample {

    public function  tok($tokenExpirationInSeconds,$role = 1){
        $appId = "80fdd13f7f7e4e4c8582e4b15877e36a";
        $appCertificate = "88090c3ce7e34417aa5404c68f5e16d8";
        $Randm = time().$this->getName();
        $channelName = $Randm;
        $uid = '';
        $uidStr = $Randm;
        // $tokenExpirationInSeconds = 3600;
        $privilegeExpirationInSeconds = 3600;

$token = RtcTokenBuilder::buildTokenWithUid($appId, $appCertificate, $channelName, $uid, $role, $tokenExpirationInSeconds, $privilegeExpirationInSeconds);
// echo 'Token with int uid: ' . $token . PHP_EOL;

// $token = RtcTokenBuilder::buildTokenWithUserAccount($appId, $appCertificate, $channelName, $uidStr, RtcTokenBuilder::ROLE_PUBLISHER, $tokenExpirationInSeconds, $privilegeExpirationInSeconds);
// echo 'Token with user account: ' . $token . PHP_EOL;

// $token = RtcTokenBuilder::buildTokenWithUidAndPrivilege($appId, $appCertificate, $channelName, $uid, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds);
// echo 'Token with int uid and privilege: ' . $token . PHP_EOL;

// $token = RtcTokenBuilder::buildTokenWithUserAccountAndPrivilege($appId, $appCertificate, $channelName, $uidStr, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds, $privilegeExpirationInSeconds);
// echo 'Token with user account and privilege: ' . $token . PHP_EOL;
        return [$token,$channelName];
    }
    
    function getName($n = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}
}
