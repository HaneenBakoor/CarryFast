<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Dish;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Currency;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Fetch the specific user and currency as single models.
        $user = User::where('email', 'haneenbakoor512@gmail.com')->first();
        $currency = Currency::where('code', 'SYR')->first();

        // Fetch all other collections.
        $users = User::all();
        $dishes = Dish::all();
        $coupon = Coupon::all();
        // Fetch only delivery users to choose from
        $deliveryUsers = User::where('role', 'delivery')->get();

        // Check if required tables have data.
        if ($users->isEmpty() || $dishes->isEmpty() || !$currency) {
            echo "Please ensure users, dishes, and currencies tables are seeded first.\n";
            return;
        }

        // Loop to create a few sample orders.
        for ($i = 0; $i < 15; $i++) {
            // Use a database transaction to ensure data integrity.
            DB::beginTransaction();

            try {
                // Determine a random state for the order.
                $state = $faker->randomElement(['pending', 'on_the_way', 'delivered']);

                $deliveryPerson = null;
                // Only assign a delivery person if the state is not 'pending'.
                if ($state !== 'pending' && $deliveryUsers->isNotEmpty()) {
                    $deliveryPerson = $deliveryUsers->random();
                }

                $totalPrice = 0;
                $orderItems = [];

                // Create a few random items for this order.
                $numItems = $faker->numberBetween(1, 5);
                for ($j = 0; $j < $numItems; $j++) {
                    if ($dishes->isNotEmpty()) {
                        $dish = $dishes->random();
                        $quantity = $faker->numberBetween(1, 3);
                        $unitPrice = $dish->price;

                        $subtotal = $unitPrice * $quantity;
                        $totalPrice += $subtotal;

                        $orderItems[] = [
                            'id' => (string) Str::uuid(),
                            'dishes_id' => $dish->id,
                            'currency_id' => $currency->id,
                            'unit_price' => $unitPrice,
                            'quantity' => $quantity,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }
                }

                if (empty($orderItems)) {
                     DB::rollBack();
                     continue;
                }

                $discountAmount = 0;
                if ($coupon) {
                    // Make sure $coupon is a single model instance before trying to access its properties.
                    if ($coupon instanceof \Illuminate\Support\Collection) {
                        $coupon = $coupon->first();
                    }

                    if ($coupon->discount_type === 'percentage') {
                        $discountAmount = $totalPrice * ($coupon->discount_value / 100);
                    } else {
                        $discountAmount = $coupon->discount_value;
                    }
                    $totalPrice -= $discountAmount;
                    $totalPrice = max(0, $totalPrice);
                }

                // Insert the new order into the database.
                $orderId = (string) Str::uuid();
                DB::table('orders')->insert([
                    'id' => $orderId,
                    'user_id' => $user->id,
                    // Use a ternary operator to set the delivery_id or null.
                    'delivery_id' => $deliveryPerson ? $deliveryPerson->id : null,
                    'total_price' => $totalPrice,
                    'state' => $state,
                    'currency_id' => $currency->id,
                    'coupon_id' => $coupon ? $coupon->id : null,
                    'discount_amount' => $discountAmount,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                // Insert the order items.
                foreach ($orderItems as $item) {
                    $item['order_id'] = $orderId;
                    DB::table('order_items')->insert($item);
                }

                DB::commit();

            } catch (\Exception $e) {
                DB::rollBack();
                echo "Failed to seed order: " . $e->getMessage() . "\n";
            }
        }
    }
}
