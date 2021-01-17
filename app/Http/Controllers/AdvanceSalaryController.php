<?php

namespace App\Http\Controllers;

use App\AdvanceSalary;
use App\Employee;
use Illuminate\Http\Request;
use Session;
use Response;
use Validator;

class AdvanceSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advances = AdvanceSalary::all();
        return view('advance_salary.list',compact('advances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('advance_salary.add_edit',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $validator = Validator::make($request->all(),[
             'year'=>'required',
             'advance_salary'=>'required|regex:/^[0-9]+$/',
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


        $emp_id = $request->emp_id;
        $salary = Employee::select('salary')
                 ->where('id',$emp_id)
                 ->first();
        $salary = $salary->salary;
        $add_salary = ($salary/2);
        $month = $request->month;
        $year = $request->year;
        $advance_salary = $request->advance_salary;

        $advance = AdvanceSalary::where('emp_id',$emp_id)
                  ->where('month',$month)
                  ->where('year',$year)
                  ->first();
        if ($advance) {
            Session::flash('flash_message','Already advance salary paid');
            return redirect()->back()->with('status_color','error');
        } else {
            if ($advance_salary>$add_salary) {
                Session::flash('flash_message','You can pay 50% of your basic salary');
            return redirect()->back()->with('status_color','warning');
            } else {
                $data = array();
                $data['emp_id'] = $request->emp_id;
                $data['month'] = $request->month;
                $data['advance_salary'] = $request->advance_salary;
                $data['year'] = $request->year;

                try {
                    $bug =0;
                    $insert = AdvanceSalary::create($data);
                } catch (\Exception $e) {
                    $bug = $e->errorInfo[1];
                }
                if ($bug==0) {
                    Session::flash('flash_message','Advanced Salary Paid Successfully.');
                    return redirect('admin/advance_salary')->with('status_color','success');
                } else {
                    Session::flash('flash_message','Something Error Found');
                    return redirect('admin/advance_salary')->with('status_color','danger');
                }
            }
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdvanceSalary  $advanceSalary
     * @return \Illuminate\Http\Response
     */
    public function show(AdvanceSalary $advanceSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdvanceSalary  $advanceSalary
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $employees = Employee::all();
        $single_advance = AdvanceSalary::findOrFail($id);
        return view('advance_salary.add_edit',compact('single_advance','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdvanceSalary  $advanceSalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
             'year'=>'required',
             'advance_salary'=>'required|regex:/^[0-9]+$/',
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


        $emp_id = $request->emp_id;
        $salary = Employee::select('salary')
                 ->where('id',$emp_id)
                 ->first();
        $salary = $salary->salary;
        $add_salary = ($salary/2);
        $month = $request->month;
        $year = $request->year;
        $advance_salary = $request->advance_salary;


            if ($advance_salary>$add_salary) {
                Session::flash('flash_message','You can pay 50% of your basic salary');
            return redirect()->back()->with('status_color','warning');
            } else {
                $single_advance = AdvanceSalary::findOrFail($id);
                $data = array();
                $data['emp_id'] = $request->emp_id;
                $data['month'] = $request->month;
                $data['advance_salary'] = $request->advance_salary;
                $data['year'] = $request->year;

                try {
                    $bug =0;
                    $single_advance->update($data);
                } catch (\Exception $e) {
                    $bug = $e->errorInfo[1];
                }
                if ($bug==0) {
                    Session::flash('flash_message','Advanced Salary Updated Successfully.');
                    return redirect('admin/advance_salary')->with('status_color','success');
                } else {
                    Session::flash('flash_message','Something Error Found');
                    return redirect('admin/advance_salary')->with('status_color','danger');
                }
            }
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdvanceSalary  $advanceSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdvanceSalary $advanceSalary)
    {
        //
    }
}
