<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Log;
class NotificationSetting extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['type'];
    public $HTMLbody = '';
    public $WithoutHTML = '';

    function getVariable(){
        // Step 1
        if($this->id==1 || $this->id==2 || $this->id==3)
        {
            return array('name','email','phone_no','created_at');
        }
        elseif($this->id==4 || $this->id==5 || $this->id==6)
        {
            return array('name','email','phone_no','created_at');
        }elseif($this->id==7 || $this->id==8)
        {
            return array('name','email','phone_no','created_at');
        }
        //Step 2
        elseif($this->id==9 || $this->id==10 || $this->id==11)
        {
            return array('name','amount','created_at');
        }
        elseif($this->id==12 || $this->id==13 || $this->id==14)
        {
            return array('name','amount','created_at');
        }
        elseif($this->id==15 || $this->id==16)
        {
            return array('name','amount','created_at');
        }

        //Step 3
        elseif($this->id==17 || $this->id==18 || $this->id==19 || $this->id==20 || $this->id==21 || $this->id==22 || $this->id==23 || $this->id==24)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }

        //4
        elseif($this->id==25 || $this->id==26 || $this->id==27 || $this->id==28 || $this->id==29 || $this->id==30 || $this->id==31 || $this->id==32)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //5
        elseif($this->id==33 || $this->id==34 || $this->id==35 || $this->id==36 || $this->id==37 || $this->id==38 || $this->id==39 || $this->id==40)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //6
        elseif($this->id==41 || $this->id==42 || $this->id==43 || $this->id==44 || $this->id==45 || $this->id==46 || $this->id==47 || $this->id==48)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //7
        elseif($this->id==49 || $this->id==50 || $this->id==51 || $this->id==52 || $this->id==53 || $this->id==54 || $this->id==55 || $this->id==56)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //8
        elseif($this->id==57 || $this->id==58 || $this->id==59 || $this->id==60 || $this->id==61 || $this->id==62 || $this->id==63 || $this->id==64)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //9
        elseif($this->id==65 || $this->id==66 || $this->id==67 || $this->id==68 || $this->id==69 || $this->id==70 || $this->id==71 || $this->id==72)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //10
        elseif($this->id==73 || $this->id==74 || $this->id==75 || $this->id==76 || $this->id==77 || $this->id==78 || $this->id==79 || $this->id==80)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //11
        elseif($this->id==81 || $this->id==82 || $this->id==83 || $this->id==84 || $this->id==85 || $this->id==86 || $this->id==87 || $this->id==88)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //12
        elseif($this->id==89 || $this->id==90 || $this->id==91 || $this->id==92 || $this->id==93 || $this->id==94 || $this->id==95 || $this->id==96)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //13
        elseif($this->id==97 || $this->id==98 || $this->id==99 || $this->id==100 || $this->id==101 || $this->id==102 || $this->id==103 || $this->id==104)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //14
        elseif($this->id==105 || $this->id==106 || $this->id==107 || $this->id==108 || $this->id==109 || $this->id==110 || $this->id==111 || $this->id==112)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //15
        elseif($this->id==113 || $this->id==114 || $this->id==115 || $this->id==116 || $this->id==117 || $this->id==118 || $this->id==119 || $this->id==120)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //16
        elseif($this->id==121 || $this->id==122 || $this->id==123 || $this->id==124 || $this->id==125 || $this->id==126 || $this->id==127 || $this->id==128)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //17
        elseif($this->id==129 || $this->id==130 || $this->id==131 || $this->id==132 || $this->id==133 || $this->id==134 || $this->id==135 || $this->id==136)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //18
        elseif($this->id==137 || $this->id==138 || $this->id==139 || $this->id==140 || $this->id==141 || $this->id==142 || $this->id==143 || $this->id==144)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //19
        elseif($this->id==145 || $this->id==146 || $this->id==147 || $this->id==148 || $this->id==149 || $this->id==150 || $this->id==151 || $this->id==152)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //20
        elseif($this->id==153 || $this->id==154 || $this->id==155 || $this->id==156 || $this->id==157 || $this->id==158 || $this->id==159 || $this->id==160)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //21
        elseif($this->id==161 || $this->id==162 || $this->id==163 || $this->id==164 || $this->id==165 || $this->id==166 || $this->id==167 || $this->id==168)
        {
            return array('phone_no');
        }
        //22
        elseif($this->id==169 || $this->id==170 || $this->id==171 || $this->id==172 || $this->id==173 || $this->id==174 || $this->id==175 || $this->id==176)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //23
        elseif($this->id==177 || $this->id==178 || $this->id==179 || $this->id==180 || $this->id==181 || $this->id==182 || $this->id==183 || $this->id==184)
        {
            return array('BookingID','CustomerName','ConsultantName','CustomerAmount','ConsultantAmount','AppointmentConsultantDate','AppointmentCustomerDate','insurance','PolicyID','AppointmentType','Category','status','GracePeriod','Rating','Review');
        }
        //24
        elseif($this->id==185 || $this->id==186 || $this->id==187 || $this->id==188 || $this->id==189 || $this->id==190 || $this->id==191 || $this->id==192)
        {
            return array('ConsultantName','ConsultantEmail','ConsultantPhoneNo','TransactionType','TransactionID','Comments','PayDate','AdminAmount','consultantAmount','status');
        }
        //25
        elseif($this->id==193 || $this->id==194 || $this->id==195 || $this->id==196 || $this->id==197 || $this->id==198 || $this->id==199 || $this->id==200)
        {
            return array('ConsultantName','ConsultantEmail','ConsultantPhoneNo','TransactionType','TransactionID','Comments','PayDate','AdminAmount','consultantAmount','status');
        }
        //26
        elseif($this->id==201 || $this->id==202 || $this->id==203 || $this->id==204 || $this->id==205 || $this->id==206 || $this->id==207 || $this->id==208)
        {
            return array('ConsultantName','ConsultantEmail','ConsultantPhoneNo','TransactionType','TransactionID','Comments','PayDate','AdminAmount','consultantAmount','status');
        }


        //doubt 27
        elseif($this->id==209 || $this->id==210 || $this->id==211 || $this->id==212 || $this->id==213 || $this->id==214 || $this->id==215 || $this->id==216)
        {
            return array('ConsultantName','ConsultantEmail','ConsultantPhoneNo');
        }
        //28
        elseif($this->id==217 || $this->id==218 || $this->id==219 || $this->id==220 || $this->id==221 || $this->id==222 || $this->id==223 || $this->id==224)
        {
            return array('ConsultantName','ConsultantEmail','ConsultantPhoneNo');
        }
        //29
        elseif($this->id==225 || $this->id==226 || $this->id==227 || $this->id==228 || $this->id==229 || $this->id==230 || $this->id==231 || $this->id==232)
        {
            return array('ConsultantName','ConsultantEmail','ConsultantPhoneNo');
        }
        //30
        elseif($this->id==233 || $this->id==234 || $this->id==235|| $this->id==236 || $this->id==237 || $this->id==238 || $this->id==239 || $this->id==240)
        {
            return array('ConsultantName','ConsultantEmail','ConsultantPhoneNo','consultantAmount','AdminAmount','description','offerTitle','CustomerAmount','CustomerName','PurchaseID');
        }
        //31
        elseif($this->id==241 || $this->id==242 || $this->id==243 || $this->id==244 || $this->id==245 || $this->id==246 || $this->id==247 || $this->id==248)
        {
            return array('ConsultantName','ConsultantEmail','ConsultantPhoneNo','consultantAmount','AdminAmount','description','offerTitle');
        }
        //32
        elseif($this->id==249 || $this->id==250 || $this->id==251 || $this->id==252 || $this->id==253 || $this->id==254 || $this->id==255 || $this->id==256)
        {
            return array('ConsultantName','ConsultantEmail','ConsultantPhoneNo','type','consultantAmount','promocode','promotitle');
        }

        else return [];
    }
    public function NotificationData($bodyLocArgs = ''){
        return ['notification' =>
        ['title'=>$this->title,
        'body'=>$this->WithoutHTML,
        'bodyLocArgs'=>$bodyLocArgs,
        'sound' => 'default']];
    }

    public function CreateBody($Model){
        $VALUES = [];
        $REPLASEVALUE = [];
        foreach ($this->getVariable() as $value) {
            # code...
            $REPLASEVALUE[] = "{".$value."}";
            $VALUES[] = $Model->{$value} ?? '';
        }
        $this->HTMLbody = str_replace($REPLASEVALUE,$VALUES,$this->description);
        $this->WithoutHTML = strip_tags($this->HTMLbody);
    }

}
