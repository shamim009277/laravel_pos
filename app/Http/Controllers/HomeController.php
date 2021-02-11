<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\OrderDetail;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

     
$weak_total = Order::where('created_at','>=',Carbon::now()->subdays(7))->get()->sum('total');
$weak_pay = Order::where('created_at','>=',Carbon::now()->subdays(7))->get()->sum('pay');
$weak_sales = Order::where('created_at','>=',Carbon::now()->subdays(7))->get()->sum('total_qty');
$weak_due = Order::where('created_at','>=',Carbon::now()->subdays(7))->get()->sum('due');

$total = Order::select('total')->get()->sum('total');
$pay = Order::select('pay')->get()->sum('pay');
$sales = Order::select('total_qty')->get()->sum('total_qty');
$due = Order::select('due')->get()->sum('due');

    $data = DB::table('order_details')
          ->join('products','order_details.product_id','products.id')
          ->select(
             DB::raw('products.product_name as product'),
             DB::raw('count(*) as number'))
          ->groupBy('product_name')
          ->where('order_details.created_at','>=',Carbon::now()->subdays(7))
          ->get();


    $date = Order::select('order_date')
          ->where('created_at','>=',Carbon::now()->subdays(7))->distinct()
          ->get();
         
    $months = Order::distinct()->get(
                DB::raw('MONTH(created_at) as month'));
    //dd($months);
    

        return view('home',compact('weak_total','weak_pay','weak_due','weak_sales','data','date','total','pay','sales','due','months'));
    }
}
