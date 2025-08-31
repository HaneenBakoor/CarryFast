<?php
namespace Database\Seeders;

use App\Models\Dish;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;use Illuminate\Support\Str;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {$faker = Faker::create();

        $user = User::Where('email','haneenbakoor512@gmail.com')->first();
        $dishes = Dish::all();

        // Check if there are users and dishes to prevent errors.
        if (!$user || !$dishes) {
            echo "Please ensure the users and dishes tables are populated first.\n";
            return;
        }

        // Create 20 sample cart items.
        for ($i = 0; $i < 20; $i++) {
            DB::table('carts')->insert([
                // Generate a UUID for the primary key.
                'id'         => (string) Str::uuid(),

                // Assign a random user to the cart item.
                'user_id'    => $user->id,

                // Assign a random dish to the cart item.
                'dishes_id'  => $dishes->random()->id,

                // Generate a random quantity between 1 and 5.
                'quantity'   => $faker->numberBetween(1, 5),

                // Set the timestamps for the record.
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }}

   }
