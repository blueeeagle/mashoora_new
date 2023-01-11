<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['post_from','video_title','video_url','display_in_home','sort_no','status','firm_id','consultant_id','admin_id'];

}
