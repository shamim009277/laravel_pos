<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = "salaries";

    protected $fillable = [
        'emp_id', 'amount','month','year'
    ];

    public function employee(){
    	return $this->belongsTo('App\Employee','emp_id');
    }
}
