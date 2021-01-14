<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Session;
use Validator;
use Response;

class EmployeeController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id','DESC')->get();
        return view('employer.list',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employer.add_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

              'name'=>'required | min:3',
              'email'=>'required | email',
              'phone'=>'required | min:11',
              'photo'=>'required | mimes:jpeg,jpg,png,gif |max:1024',
              'address'=>'required',
              'experience'=>'required',
              'nid_no'=>'required | min:8',
              'salary'=>'required',
              'birth'=>'required',
              'vacation'=>'required',
              'city'=>'required | min:2',
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
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['phone'] = $request->phone;
        $input['address'] = $request->address;
        $input['experience'] = $request->experience;
        $input['nid_no'] = $request->nid_no;
        $input['salary'] = $request->salary;
        $input['birth'] = $request->birth;
        $input['vacation'] = $request->vacation;
        $input['city'] = $request->city;


        $image = $request->file('photo');
        if ($image) {
            $ext = strtolower($image->getClientOriginalExtension());
            $imageName = uniqid().".".$ext;
            $path = 'images/employee/';
            $image_url = $path.$imageName;
            $success = $image->move($path,$imageName);
            if ($success) {
                $input['photo'] = $imageName;
            } else {
                $input['image'] = 'default.png';
            }
            
            try {
                $bug = 0;
                $insert = Employee::create($input);
                
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Employee Added Successfully.');
                return redirect('admin/employee')->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect('admin/employee')->with('status_color','danger');
            }
            
            
        } 

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = \Crypt::decrypt($id);
        $single_employee = Employee::findOrFail($id);
        return view('employer.add_edit',compact('single_employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[

              'name'=>'required | min:3',
              'email'=>'required | email',
              'phone'=>'required | min:11',
              'photo'=>'required | mimes:jpeg,jpg,png,gif |max:1024',
              'address'=>'required',
              'experience'=>'required',
              'nid_no'=>'required | min:8',
              'salary'=>'required',
              'birth'=>'required',
              'vacation'=>'required',
              'city'=>'required | min:2',
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

        $employee = Employee::findOrFail($id);

        $input = $request->all(); 
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['phone'] = $request->phone;
        $input['address'] = $request->address;
        $input['experience'] = $request->experience;
        $input['nid_no'] = $request->nid_no;
        $input['salary'] = $request->salary;
        $input['birth'] = $request->birth;
        $input['vacation'] = $request->vacation;
        $input['city'] = $request->city;

    if ($request->file('photo') !== ($employee->photo)) {

        $image = $request->file('photo');
    if ($image) {
        $ext = strtolower($image->getClientOriginalExtension());
        $imageName = uniqid().".".$ext;
        $path = 'images/employee/';
        $image_url = $path.$imageName;
        $success = $image->move($path,$imageName);
     if ($success) {
            $old_image = $path.$employee->photo;
            if (file_exists($old_image)) {
                @unlink($old_image);
            } 

         $input['photo'] = $imageName;    
        } 
           
        } 
        
      } else {
          $input['photo'] = $employee->photo;
      }

      try {
          $bug = 0;
          $employee->update($input);
      } catch (\Exception $e) {
          $bug = $e->errorInfo[1];
      }

if ($bug==0) {
        Session::flash('flash_message','Employee Updated Successfully.');
        return redirect('admin/employee')->with('status_color','success');
    } else {
        Session::flash('flash_message','Something Error Found');
        return redirect('admin/employee')->with('status_color','danger');
    }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
