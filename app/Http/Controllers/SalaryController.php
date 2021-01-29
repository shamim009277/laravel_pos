<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Attendence;
use App\AdvanceSalary;
use App\Salary;
use Session;
use Response;
use Validator;

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
    	
    	
        $name = Employee::where('id',$id)
               ->first();
    	$name = $name->name;

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
    	$advance_salary =  AdvanceSalary::where('emp_id',$id)
    	                 ->where('year',$year)
    	                 ->where('month',$month)
    	                 ->first();
    	$paid = Salary::where('emp_id',$id)
    	       ->where('month',$month)
    	       ->where('year',$year)
    	       ->first();
    	                               
    	$total_day = ($attent+$absence+$leave);
    	
    	
    	if ($total_day==0) {
    		Session::flash('flash_message','This Employee is not eligible for salary');
                return redirect()->back()->with('status_color','warning');
    	} else {

    		if (!empty($paid)) {
    		Session::flash('flash_message','Salary is already paid');
                return redirect()->back()->with('status_color','warning');
    		} else {
    			$working = ($total_day-$absence);
			    	$salary_perday = ($base_salary/$total_day);
			    	if ($total_day==$working) {
			    		$atten_donus = 1500;
			    		$total_salary=($base_salary+$atten_donus);
			    	} else {
			    		$atten_donus=0;
			    		$total_salary=($base_salary-($absence*$salary_perday));
			    	}
			    	if (!empty($advance_salary)) {
			    		$advance_salary = $advance_salary->advance_salary;
			    		$total_salary = round($total_salary-$advance_salary);
			    	} else {
			    		$advance_salary=0;
			    		$total_salary = round($total_salary);
			    	}
			    	return view('salary.pay_salary',
		compact('advance_salary','id','year','month','total_day','working','base_salary','total_salary','name','atten_donus'));
		    	}
    		}	

    }

    public function storeSalary(Request $request){
        
        $validator = Validator::make($request->all(),[
             'year'=>'required',
             'amount'=>'required|regex:/^[0-9]+$/',
             'month'=>'required',
        ]);
        if ($validator->fails()) {    
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(),true);
            foreach($errorMessage as $value){
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message',$plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $data = array();
        $data['emp_id']=$request->emp_id;
        $data['year']=$request->year;
        $data['month']=$request->month;
        $data['amount']=$request->amount;

        try {
        	$bug = 0;
        	$insert = Salary::create($data);	
        } catch (\Exception $e) {
        	$bug = $e->errorInfo[1];
        }
        if ($bug==0) {
            Session::flash('flash_message','Salary Paid Successfully.');
            return redirect('admin/salary/paid_list')->with('status_color','success');
        } else {
            Session::flash('flash_message','Something Error Found');
            return redirect('admin/salary/paid_list')->with('status_color','danger');
        }
      
    }

    public function paidList(){
    	$salaries = Salary::orderBy('id','DESC')->get();
    	return view('salary.paid_list',compact('salaries'));
    }
}
