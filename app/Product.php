<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'product_name','cat_id','sup_id','product_code','product_garage','product_image',	
        'buy_date',	'expire_date','buying_price','selling_price',
    ];

    public function category(){
    	return $this->belongsTo('App\Category','cat_id');
    }

    public function supplier(){
    	return $this->belongsTo('App\Supplier','sup_id');
    }
}
