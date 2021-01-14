<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = [
         'name','email','phone','address','shop_name','photo','account_holder','account_number',
         	'bank_name','bank_branch','city'
    ];
}
