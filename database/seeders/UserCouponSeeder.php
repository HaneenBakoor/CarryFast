<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Coupon;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserCouponSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        // Check if the pivot table is already seeded to prevent duplicates.
        // We now check for the new table name 'users_coupons'.
        if (DB::table('users_coupons')->exists()) {
            echo "users_coupons pivot table is already seeded. Skipping.\n";
            return;
        }

        // Fetch a sample of users and coupons.
        $user = User::where('email','haneenbakoor512@gmail.com')->first();
        $coupons = Coupon::inRandomOrder()->limit(5)->get();

        // Check if the required tables have data.
        if (!$user || $coupons->isEmpty()) {
            echo "Please ensure the users and coupons tables are seeded first.\n";
            return;
        }

        $couponUser = [];

            // Randomly select a few coupons for each user.
            $usedCoupons = $coupons->random($faker->numberBetween(1, 3));

            foreach ($usedCoupons as $coupon) {
                // Prepare the data to be inserted into the pivot table.
                $couponUser[] = [
                    // Add the new 'id' column with a UUID
                    'id' => (string) Str::uuid(),
                    'user_id' => $user->id,
                    'coupon_id' => $coupon->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            
        }

        // Insert the data into the pivot table.
        // The table name is 'users_coupons' as per your migration schema.
        if (!empty($couponUser)) {
            DB::table('users_coupons')->insert($couponUser);
            echo "Successfully seeded " . count($couponUser) . " user-coupon relationships.\n";
        } else {
            echo "No user-coupon relationships were created.\n";
        }
    }
}
