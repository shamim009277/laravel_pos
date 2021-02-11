<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Order;

class SalesController extends Controller
{
    public function salesList(){
    	$orders = Order::with('customer')->get();
    	return view('sales.all_sales',compact('orders'));
    }

    public function monthlyReport(Request $request){

    	$month = $request->get('month');
    	if ($month) {
    		$orders=Order::whereMonth('created_at',$month)->get();
    		$total = Order::whereMonth('created_at',$month)->get()->sum('total');
    	    $pay = Order::whereMonth('created_at',$month)->get()->sum('pay');
    	    $due = Order::whereMonth('created_at',$month)->get()->sum('due');
    	} else {
    		$orders = Order::with('customer')->get();
    		$total = Order::get()->sum('total');
    	    $pay = Order::get()->sum('pay');
    	    $due = Order::get()->sum('due');
    	}
    	
    	$months= Order::select(DB::raw('MONTH(created_at) month'))->distinct()->get();
    	

    	return view ('sales.monthly_report',['orders'=>$orders,'total'=>$total,'pay'=>$pay,'due'=>$due,'months'=>$months]);
    }

    public function dailyReport(){
        
        $orders = Order::with('customer')->whereDate('created_at',Carbon::today())->get();
        $total = Order::whereDate('created_at',Carbon::today())->get()->sum('total');
        $pay = Order::whereDate('created_at',Carbon::today())->get()->sum('pay');
        $due = Order::whereDate('created_at',Carbon::today())->get()->sum('due');
        //dd($orders);
        return view('sales.today',compact('orders','total','pay','due'));
    }
}
