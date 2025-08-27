<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

         public function run()
    {
        $faker = Faker::create();

        // Create a specific, well-known coupon for testing purposes.
        DB::table('coupons')->insert([
            'id' => (string) Str::uuid(),
            'code' => 'WELCOME10',
            'discount_type' => 'percentage',
            'discount_value' => 0.10, // 10% off
            'max_uses' => 3,
            'is_active' => true,
            'expires_at' => Carbon::now()->addWeeks(2),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create 15 random coupons for general use.
        for ($i = 0; $i < 15; $i++) {
            DB::table('coupons')->insert([
                'id' => (string) Str::uuid(),
                'code' => Str::upper(Str::random(10)), // Generate a random 10-character code
                'discount_type' => $faker->randomElement(['percentage', 'fixed']),
                'discount_value' => $faker->randomFloat(2, 5, 50),
                'max_uses' => $faker->numberBetween(1, 5),
                'is_active' => $faker->boolean(80), // 80% chance of being active
                'expires_at' => Carbon::now()->addDays($faker->numberBetween(1, 30)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}
