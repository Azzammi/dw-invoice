<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Customer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);      
        //factory(Product::class, 40)->create();
        factory(Customer::class, 40)->create();
    }
}
