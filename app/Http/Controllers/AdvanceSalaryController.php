<?php

namespace App\Http\Controllers;

use App\AdvanceSalary;
use App\Employee;
use Illuminate\Http\Request;

class AdvanceSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('advance_salary.list');
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
        $emp_id = $request->emp_id;
        $month = $request->month;

        $advance = AdvanceSalary::where('emp_id',$emp_id)
                  ->where('month',$month)
                  ->first();
        if ($advance) {
            echo "yes";
        } else {
            echo "no";
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
    public function edit(AdvanceSalary $advanceSalary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdvanceSalary  $advanceSalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdvanceSalary $advanceSalary)
    {
        //
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
