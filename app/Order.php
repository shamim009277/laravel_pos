<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\OrderConfirm;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    protected $table = "orders";

    protected $fillable = [
       'customer_id','order_date','order_status','total_qty','sub_total','vat','total',	
       'payment_status','pay','due','last_pay'
    ];

    protected $dispatchesEvents = [
        'created' => OrderConfirm::class,
    ];

    public function customer(){
    	return $this->belongsTo('App\Customer');
    }

    public function orderDetails(){
        return $this->hasMany('App\OrderDetail');
    }
}
