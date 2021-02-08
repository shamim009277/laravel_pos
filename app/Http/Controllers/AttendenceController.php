<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Employee;
use App\Attendence;
use Session;
use Resonse;
use Validator;

use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function takeAttendence(){
    	$employees = Employee::orderBy('id','DESC')->get();
        return view('attendence.take_attendence',compact('employees'));
    }

    public function storeAttendence(Request $request){
        
        //return $request->all();
        $date = $request->date;
        $att_date = Attendence::where('date',$date)->first();
        if ($att_date) {
        	Session::flash('flash_message','Alredy Attendence Taken.');
            return redirect()->back()->with('status_color','warning');
        } else {

        $validator = Validator::make($request->all(),[

             'status'=>'required',
  
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
        
        	foreach ($request->emp_id as $id) {
        	$data = array();
        	$data['emp_id'] = $id;
        	$data['status'] = $request->status[$id];
        	$data['date'] = $request->date;
        	$data['year'] = $request->year;
        	$data['att_date'] = $request->att_date;
        	$data['month'] = $request->month;
            
           $take_attendence = Attendence::create($data); 
        }
        if ($take_attendence) {
        	Session::flash('flash_message','Attendence Taken Successfully.');
                return redirect()->back()->with('status_color','success');
        } else {
        	Session::flash('flash_message','Something Error Found');
                return redirect()->back()->with('status_color','error');
        }
        
        

        }    
    }

    public function allAttendence(){
    	$attendences = DB::table('attendences')
    	              ->select('att_date')
    	              ->groupBy('att_date')
    	              ->get();

    	return view('attendence.all_attendence',compact('attendences'));
    }

    public function editAttendence($data){
    	$data = \Crypt::decrypt($data);
    	$employees = DB::table('attendences')
    	                ->join('employees','employees.id','=','attendences.emp_id')
    	                ->select('attendences.*','employees.name','employees.photo')
    	                ->where('att_date',$data)
    	                ->get();
    	return view('attendence.update_attendence',compact('employees','data'));
    }

    public function updateAttendence(Request $request,$data){
    	$today_date = $request->att_date;
    	if ($data!==$today_date) {
    		Session::flash('flash_message',"You can't update this data today");
                return redirect()->back()->with('status_color','error');
    	} else {

          $validator = Validator::make($request->all(),[
             'status'=>'required',
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

        foreach ($request->id as $id) {
        	$data = array();
        	$data['status'] = $request->status[$id];
        	$data['date'] = $request->date;
        	$data['year'] = $request->year;
        	$data['att_date'] = $request->att_date;
        	$data['month'] = $request->month;

        	$attendence = Attendence::where('att_date',$request->att_date)
        	              ->where('id',$id)->first();
        	$update = $attendence->update($data);
        }
        if ($update) {
        	Session::flash('flash_message','Attendence Updated Successfully.');
                return redirect('admin/all_attendence')->with('status_color','success');
        } else {
        	Session::flash('flash_message','Something Error Found');
                return redirect('admin/all_attendence')->with('status_color','error');
        }
        
    	}

    }

    public function getAttendence($id){
         
         $attendence = Attendence::where('att_date',$id)->get();
         return json_decode($attendence);
    }

    public function monthlyAttendence(Request $request){
        $year = date('Y');
        $month = $request->get('month');
        if ($month) {
          $month = $request->get('month');
        } else {
          $month = date('F');
        }
         
        $get_months =Attendence::select('month')
                     ->where('year',$year)->distinct()
                     ->get();
        $dates = Attendence::select('date')
               ->groupBy('date')
               ->where('month',$month)
               ->where('year',$year)
               ->get();
        $emp_ids = Attendence::select('emp_id')
               ->with('employee')
               ->groupBy('emp_id')
               ->where('month',$month)
               ->where('year',$year)
               ->get();
        //dd($date);
        return view('attendence.monthly_attendence',compact('dates','emp_ids','month','get_months'));
    }





}
