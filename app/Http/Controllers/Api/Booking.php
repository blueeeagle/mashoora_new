<?php
namespace App\Http\Controllers\Api;

class Booking {
    public $consultant = null;
    public $schedule = null;
    public $data = null;
    public $type = null;
    public $Discount = null;
    public $offer = null;
    public $amount = 0;
    public $DiscountAmount = 0;
    
    public $cancellcustomer = ['status'=> false,'msg'=>''];
    public $cancellconsultant = ['status'=> false,'msg'=>''];
    
    public $admincurrnecy = null;
    public $consultantcurrency = null;
    public $customercurrnecy = null;
    public $Companysetting = null;
    public $Insurance = null;
    public $customerTimeZone = null;
    public $consultantTimeZone = null;
    public $diff = 0;
    function newconsultant($consultant){
        $this->consultant = $consultant;
        $this->schedule = null;
        $this->data = null;
        $this->type = null;
        $this->Discount = null;
        $this->offer = null;
        $this->amount = 0;
        $this->DiscountAmount = 0;
        $this->consultantcurrency = $consultant->country->currency;
        $this->customerTimeZone = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, Auth::guard('customer')->user()->dialingcountry->country_code)[0];
        $this->consultantTimeZone = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $consultant->country->country_code)[0];
        $this->updateprice();
    }

    function updateprice(){
        $this->consultant->{'video_amount_converted'} = ($this->customercurrnecy)?(float)$this->consultant->video_amount*(float)$this->customercurrnecy->price :(float)$this->consultant->video_amount;
        $this->consultant->{'voice_amount_converted'} = ($this->customercurrnecy)?(float)$this->consultant->voice_amount*(float)$this->customercurrnecy->price :(float)$this->consultant->voice_amount;
        $this->consultant->{'text_amount_converted'} = ($this->customercurrnecy)?(float)$this->consultant->text_amount*(float)$this->customercurrnecy->price :(float)$this->consultant->text_amount;
        $this->consultant->{'direct_amount_converted'} = ($this->customercurrnecy)?(float)$this->consultant->direct_amount*(float)$this->customercurrnecy->price :(float)$this->consultant->direct_amount;
        $this->consultant->{'customer_currency'} = $this->customercurrnecy;
    }
}

?>