<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Expense;
use Validator;
use Response;
use Session;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function index(){
    	return view('expense.list');
    }

    public function getCategory(){

    	$category = Category::all();
    	return json_encode($category);
    }

    public function addForm(){
    	return view('expense.add_expense');
    }

    public function storeExpense(Request $request){
    	$validator = Validator::make($request->all(),[

             'details'=>'required|max:255',
             'amount'=>'required',
  
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

        $input = $request->all();
        $input['details'] = $request->details;
        $input['amount'] = $request->amount;
        $input['date'] = $request->date;
        $input['month'] = $request->month;

        try {
                $bug = 0;
                $insert = Expense::create($input);
                
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Expense Added Successfully.');
                return redirect()->back()->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect()->back()->with('status_color','error');
            }
    }

    public function editExpense($id){

        $single_expense = Expense::findOrFail($id);
        return view('expense.add_expense',compact('single_expense'));
    }

    public function updateExpense(Request $request,$id){
        $validator = Validator::make($request->all(),[

             'details'=>'required|max:255',
             'amount'=>'required',
  
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
        $expense = Expense::findOrFail($id);
        $input = $request->all();
        $input['details'] = $request->details;
        $input['amount'] = $request->amount;
        $input['date'] = $request->date;
        $input['month'] = $request->month;

        try {
                $bug = 0;
                $expense ->update($input);
                
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Expense Added Successfully.');
                return redirect('admin/expense/today_expense')->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect('admin/expense/today_expense')->with('status_color','error');
            }

    }

    public function todayExpense(){
                 
        $date = date("d.m.Y");
        $expenses = Expense::where('date',$date)->get();
        $total = Expense::where('date',$date)->get()->sum('amount');
        return view('expense.today_expense',compact('expenses','total')); 

    }

    public function monthlyExpense(Request $request){

        $month =$request->get('month');
        if ($month) {
                $month =$request->get('month');
             } else {
                $month = date("F");
             }
        $get_months = Expense::select('month')->distinct()->get();
        $expenses = Expense::where('month',$month)->get();
        $total = Expense::where('month',$month)->get()->sum('amount');
        return view('expense.monthly_expense',compact('expenses','total','month','get_months')); 
    }

    
}
