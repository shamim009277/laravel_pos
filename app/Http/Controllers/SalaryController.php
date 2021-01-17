<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Attendence;
use Session;
use Response;

class SalaryController extends Controller
{
    public function index(){

    	$employees = Employee::all();
    	return view('salary.salary',compact('employees'));
    }

    public function showSalary($id){
    	$id = \Crypt::decrypt($id);
    	$month = date('F');
    	if ($month=="January") {
    		$month = date('F',strtotime("-1 months"));
    		$year = date('Y',strtotime("-1 years"));
    	} else {
    		$month = date('F');
    		$year = date('Y');
    	}
    	
    	
    	
    	$atten_donus = 1500;

    	

    	$base_salary = Employee::select('salary')
    	             ->where('id',$id)
    	             ->first();
        $base_salary = $base_salary->salary;    
    	$attent = Attendence::where('emp_id',$id)
    	               ->where('year',$year)
    	               ->where('month',$month)
    	               ->where('status','Present')
    	               ->count();
    	$absence = Attendence::where('emp_id',$id)
    	               ->where('year',$year)
    	               ->where('month',$month)
    	               ->where('status','Absence')
    	               ->count();
    	$leave = Attendence::where('emp_id',$id)
    	               ->where('year',$year)
    	               ->where('month',$month)
    	               ->where('status','Leave')
    	               ->count();

    	$total_day = ($attent+$absence+$leave);
    	
    	
    	if ($total_day==0) {
    		Session::flash('flash_message','This Employee is not eligible for salary');
                return redirect()->back()->with('status_color','warning');
    	} else {
    		$working = ($total_day-$absence);
	    	$salary_perday = ($base_salary/$total_day);
	    	if ($total_day==$working) {
	    		$total_salary=($base_salary+$atten_donus);
	    	} else {
	    		$total_salary=($base_salary-($absence*$salary_perday));
	    	}
    	}
    	

    }
}
