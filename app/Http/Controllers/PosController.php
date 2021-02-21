<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Category;
use App\Customer;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Setting;
use Carbon\Carbon;
use Cart;
use Response;
use Session;
use Validator;

class PosController extends Controller
{
    public function index(Request $request){
        if ($request->has('category')) {
            $id = $request->get('category');
            $products = Product::where('cat_id',$id)
                      ->orderBy('id','DESC')->get();
        } else {
            $products = Cache('products',function(){
               return Product::with('category','supplier')->orderBy('id','DESC')->get();
            });
            //$products = Product::with('category')->orderBy('id','DESC')->get();
        }
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

    	Session::flash('flash_message','Product Deleted Successfully.');
                return redirect()->back()->with('status_color','error');	
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

    public function confirmOrder(Request $request){
    	//return $request->all();
        $validator = Validator::make($request->all(),[
            'payment_status'=>'required',
            'due'=>'required|integer|min:0',
            'pay'=>'required|integer|min:0',

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

        try {
        	$bug=0;

            $data = array();
	        $data['customer_id'] = $request->customer_id;
	        $data['order_date'] = date("d/m/yy");
	        $data['order_status'] = "Pending";
	        $data['total_qty'] = Cart::count();
	        $data['sub_total'] = Cart::subtotal();
	        $data['vat'] = Cart::tax();
	        $data['total'] = $request->total;
	        $data['payment_status'] = $request->payment_status;
	        $data['pay'] = $request->pay;
	        $data['due'] = $request->due;
            $data['last_pay'] = Carbon::now();

	        $order = Order::create($data)->id;
            //dd($order);

	        if ($order) {
	        	
             $cartItem = Cart::content();
	         $productItem =Product::all();
	         $input = array();
	         foreach ($cartItem as $cart) {
	         	$input['order_id']   =$order;
	         	$input['product_id'] =$cart->id;
	         	$input['quantity']   =$cart->qty;
	         	$input['unit_price'] =$cart->price;
	         	$input['total_price']=$cart->subtotal;
	         	foreach ($productItem as $product) {
	         		if ($cart->id==$product->id) {
	         			   $ravinue=(($product->selling_price)*($cart->qty))-(($product->buying_price)*($cart->qty));
	         			$input['revinue']=$ravinue;   
	         		} 
	         	}
	         	$details = OrderDetail::create($input);
	           }
	           if ($details) {
	           	Cart::destroy();
	           	Session::forget('customer_id');
	           } 
	           
	        } 
	
        } catch (\Exception $e) {
        	return $but = $e->getMessage();
        }

        if ($bug==0) {
                Session::flash('flash_message','Order Completed Successfully.');
                return redirect('admin/pos')->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect('admin/pos')->with('status_color','danger');
            }
       
    } 

    public function getDuePayment(Request $request){
        //return $request->all();
       
       $validator = Validator::make($request->all(),[
            'due'=>'required|regex:/^[1-9]+/|not_in:0',
        ],$messages=[

            'due.required' => 'Please insert a valid number',
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

           $id = $request->order_id;
           $predue = $request->due;
           $order = Order::findOrFail($id);
           $pay = ($order->pay+$predue);
           $due = ($order->due-$predue);
           $last_pay = Carbon::now();

        if ($predue>$due) {
            Session::flash('flash_message','Please insert a valid payment value');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        } else {
            try {
                $bug=0;
                $update = Order::where('id',$id)->update([
                    "pay" => $pay,
                    "due" => $due,
                    "last_pay" => $last_pay
                 ]);
                
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Due Payment Collect Successfully');
                return redirect()->back()->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect()->back()->with('status_color','danger');
            }
        } 
       
    }   

         
}
