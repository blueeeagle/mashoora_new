<?php
namespace App\SMS;
use Log;

class SmsCommunication
{
    private $ModileNumber;
    private $TEXT;
    Private $country = null;

    public function __construct($ModileNumber,$TEXT,$country = null){
        $this->country = $country;
        $this->ModileNumber = $ModileNumber;
        $this->TEXT = $TEXT;
    }

    function SentSMS(){
        Log::info($this->TEXT.' '.$this->ModileNumber);
    }
}
