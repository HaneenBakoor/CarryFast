<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

      User::factory()->create([
    'fname' => 'Test',
    'lname' => 'User',

]);
$this->call([
    CategorySeeder::class,
    SubcategorySeeder::class,
    RestaurantSeeder::class,
    DishSeeder::class,
   AdditionSeeder::class,
   DishRestaurantSeeder::class,
   RestaurantSubcategorySeeder::class
]);
    }
}
