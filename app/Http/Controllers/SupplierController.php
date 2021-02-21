<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Response;
use Validator;

class SupplierController extends Controller
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
        $suppliers = Supplier::orderBy('id','DESC')->get();
        return view('supplier.list',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.add_edit');
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

             'name'=>'required',
             'email'=>'required',
             'phone'=>'required | min:10',
             'address'=>'required',
             'shop'=>'required | max:200',
             'photo'=>'required | mimes:jpeg,jpg,png,gif |max:1024',
             'account_holder'=>'required : max:200',
             'account_number'=>'required | min:10',
             'bank_name'=>'required | max:200',
             'bank_branch'=>'required | max:200',
             'city'=>'required | max:200',
             'type'=>'required | max:200',
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
        $input['shop'] = $request->shop;
        $input['account_holder'] = $request->account_holder;
        $input['account_number'] = $request->account_number;
        $input['bank_name'] = $request->bank_name;
        $input['bank_branch'] = $request->bank_branch;
        $input['city'] = $request->city;
        $input['type'] = $request->type;
        
        $image = $request->file('photo');
        if ($image) {
            $ext = strtolower($image->getClientOriginalExtension());
            $imageName = uniqid().".".$ext;
            $path = 'images/supplier/';
            $image_url = $path.$imageName;
            $success = $image->move($path,$imageName);
            if ($success) {
                $input['photo'] = $imageName;
            } else {
                $input['image'] = 'default.png';
            }
            
            try {
                $bug = 0;
                $insert = Supplier::create($input);
                
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Supplier Added Successfully.');
                return redirect('admin/supplier')->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect('admin/supplier')->with('status_color','danger');
            }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = \Crypt::decrypt($id);
        $single_supplier = Supplier::findOrFail($id);
        return view('supplier.add_edit',compact('single_supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $id = \Crypt::decrypt($id);
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $supplier = Supplier::findOrFail($id);
        $path = 'images/supplier/';
        $old_image = $path.$supplier->photo;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
        $supplier->delete();
        Session::flash('flash_message','Supplier Deleted Successfully');
                return redirect()->back()->with('status_color','danger'); 
        
    }
}
