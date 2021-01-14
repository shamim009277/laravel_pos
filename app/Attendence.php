<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    protected $table = "attendences";

    protected $fillable = [

         'emp_id',	'date',	'year',	'status','att_date','month'
    ];

    
}
