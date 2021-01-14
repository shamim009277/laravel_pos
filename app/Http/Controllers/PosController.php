<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Customer;
use App\Category;
use App\Setting;
use Validator;
use Session;
use Response;
use Cart;

class PosController extends Controller
{
    public function index(){
    	$products = Product::orderBy('id','DESC')->get();
    	$customers = Customer::orderBy('id','DESC')->get();
    	$categories = Category::orderBy('id','DESC')->get();
    	return view('pos.pos',compact('products','customers','categories'));
    }

    public function addCard(Request $request){
    	
    	$data = array();
    	$data['id'] = $request->id;
    	$data['name'] = $request->name;
    	$data['qty'] = 1;
    	$data['price'] = $request->price;
    	$data['weight'] = $request->price;

        $addProduct = Cart::add($data);
        if ($addProduct) {
        	Session::flash('flash_message','Product Added Successfully.');
                return redirect()->back()->with('status_color','success');
        } else {
        	Session::flash('flash_message','Something Found.');
                return redirect()->back()->with('status_color','error');
        }
        
    }

    public function updateCard(Request $request){

    	$rowId=$request->rowId;
    	$qty=$request->qty;

    	$update = Cart::update($rowId, $qty);
    	if ($update) {
    		Session::flash('flash_message','Quantity Updated Successfully.');
                return redirect()->back()->with('status_color','success');
    	} 
    }

    public function removeCart(Request $request,$id){
        $rowId=$id;
    	$remove = Cart::remove($rowId);

    	Session::flash('flash_message','Quantity Updated Successfully.');
                return redirect()->back()->with('status_color','success');	
    }

    public function createInvoice(Request $request){
    	$count = Cart::count();
    	if ($count == 0) {
    	Session::flash('flash_message','Please Select Product Items. Then You Can Create Invoice.');
                return redirect()->back()->with('status_color','warning');	
    	} else {
    		$validator = Validator::make($request->all(),[
                 'customer_id'=>'required',
    		]);

    		if ($validator->fails()) {    
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(),true);
            foreach($errorMessage as $value){
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message','Please select A Customer First.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
        $customer_id = $request->customer_id; 
        Session::put('customer_id',$customer_id);    
         return redirect('admin/create_invoice');
    	}
    	
    }

    public function showInvoice(){
        $id = Session::get('customer_id');
        $customer = Customer::where('id',$id)->first();
        $products = Cart::content();
        $setting = Setting::first();
        return view('pos.invoice',compact('customer','products','setting'));
    }
}
