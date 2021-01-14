<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'email'=>$faker->email,
        'phone'=>Str::random(11),
        'photo'=>$faker->image,
        'address'=>$faker->address,
        'experience'=>$faker->sentence,
        'nid_no'=>Str::random(8),
        'salary'=>$faker->randomNumber,
        'birth'=>$faker->date,
        'vacation'=>$faker->sentence,
        'city'=>$faker->city,
    ];

});
