<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplier;
use Faker\Generator as Faker;
use Illumunete\Support\Str;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        
        'name'=>$faker->name,
        'email'=>$faker->email,
        'phone'=>Str::random(11),
        'address'=>$faker->address,
        'type'=>$faker->word,
        'photo'=>$faker->image,
        'shop'=>$faker->word,
        'account_holder'=>$faker->name,
        'account_number'=>$faker->bankAccountNumber,
        'bank_name'=>$faker->name,
        'bank_branch'=>$faker->name,
        'city'=>$faker->city,
    ];
});
