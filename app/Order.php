<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = [
       'customer_id','order_date','order_status','total_qty','sub_total','vat','total',	
       'payment_status','pay','due'
    ];
}
