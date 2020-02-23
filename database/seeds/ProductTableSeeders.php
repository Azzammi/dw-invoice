<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Product;

class ProductTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Data faker indonesia
         $faker = Faker::create('id_ID');
         //Membuat data dummy sebanyak 10 record
         for($x = 0; $x<=50; $x++){
             //Insert data dummy pegawai dengan faker
             DB::table('guru')->insert([
                 'nama' => $faker->name,
                 'umur' => $faker->numberBetween(25,50),                
             ]);
         }
    }   
}
