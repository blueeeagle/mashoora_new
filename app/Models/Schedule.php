<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consultant;
use App\Models\Appointment;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [];
        protected $appends = ['scheduleformate'];

    public function Consultant(){
        return $this->belongsTo(Consultant::class);
    }
    public function getScheduleformateAttribute(){
        return $this->schedule;
    }
    public function Appointment(){
        return $this->hasMany(Appointment::class);
    }

    public function GenerateTemplate(){
        $this->TemplateData = new \stdClass();
        $this->TemplateData->{'ConsultantName'} = $this->Consultant->name;
        $this->TemplateData->{'ConsultantEmail'} = $this->Consultant->email;
        $this->TemplateData->{'ConsultantPhoneNo'} = $this->Consultant->phone_no;
        return $this->TemplateData;

    }
}

