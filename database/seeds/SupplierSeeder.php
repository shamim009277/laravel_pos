<?php

use Illuminate\Database\Seeder;
use app\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Supplier::class,5)->create();
    }
}
