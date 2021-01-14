<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "suppliers";

    protected $fillable = [
         'name','email','phone','address','type','photo','shop'	,'account_holder',
         'account_number','bank_name','bank_branch','city'
    ];

    public function products(){
        return $this->hasMany('App\Product');
    }
}
