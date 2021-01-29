<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employees";

    protected $fillable = [
         'name','email','phone','photo','address','experience','nid_no','salary','birth','vacation'	,'city'
    ];

    public function advance(){

    	return $this->hasOne('App\AdvanceSalary');
    }

    public function attendence(){
    	return $this->hasOne('App\Attendence');
    }

    public function salary(){
        return $this->hasOne('App\Salary');
    }
    
}
