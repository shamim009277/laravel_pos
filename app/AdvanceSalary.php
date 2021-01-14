<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvanceSalary extends Model
{
    protected $table = "advance_salaries";

    protected $fillable = [
         'emp_id','month','year','advance_salary'
    ];

    public function employee(){
    	return $this->belongsTo('App\Employee');
    }
}
