<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class SalesController extends Controller
{
    public function salesList(){
    	$orders = Order::with('customer')->get();
    	return view('sales.all_sales',compact('orders'));
    }
}
