<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Addition;
use App\Models\Restaurant;
use App\Models\Dish;
use Illuminate\Support\Facades\DB;

class AdditionSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = Restaurant::all()->keyBy('name');

        $additions = [
            ['name' => 'صوص حار', 'price' => 400, 'restaurant' => 'ألو تشكن - Alo Chicken'],
            ['name' => 'شيدر إضافي', 'price' => 600, 'restaurant' => 'ألو تشكن - Alo Chicken'],
            ['name' => 'شوكولا دارك', 'price' => 700, 'restaurant' => 'لوز - Looz'],
            ['name' => 'سيروب فواكه', 'price' => 500, 'restaurant' => 'حلوبات الرجب'],
        ];

        foreach ($additions as $add) {
            $restaurant = $restaurants[$add['restaurant']] ?? null;

            if ($restaurant) {
                $addition = Addition::create([
                    'id' => (string) Str::uuid(),
                    'name' => $add['name'],
                    'price' => $add['price'],
                    'restaurant_id' => $restaurant->id,
                ]);

                //  ربط الإضافة ببعض الأطباق عشوائيًا من نفس المطعم
                $dishes = $restaurant->dishes()->inRandomOrder()->limit(2)->get();

                foreach ($dishes as $dish) {
                    DB::table('dishes_additions')->insert([
                        'id' => (string) Str::uuid(),
                        'dishes_id' => $dish->id,
                        'additions_id' => $addition->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
