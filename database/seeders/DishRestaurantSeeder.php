<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Dish;
use App\Models\Restaurant;

class DishRestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $dishes = Dish::all();
        $restaurants = Restaurant::all()->keyBy('name');

        // ربط كل طبق بمطعمه حسب الاسم
        $mapping = [
            'ألو تشكن - Alo Chicken' => [
                'ساندويش دجاج كريسبي',
                'برغر دبل لحم',
                'بيتزا مارجريتا',
                'بطاطا مقلية مع جبنة',
                'عصير ليمون منعش',
                'برغر دجاج ناري',
                'بيتزا ببروني',
                'ساندويش زنجر',
            ],
            'حلوبات الرجب' => [
                'كنافة نابلسية',
                'بقلاوة بالفستق',
                'معمول تمر',
                'بلورية بالقشطة',
                'زنود الست',
                'غريبة السمنة',
                'بقلاوة جوز',
                'كنافة خشنة',
            ],
            'لوز - Looz' => [
                'آيس كريم نوتيلا',
                'تشيز كيك فراولة',
                'سوشي شوكولا',
                'براوني شوكولا داكنة',
                'آيس كريم فانيليا وكراميل',
                'كيك الشوكولا الغني',
                'سوشي حلويات بالفواكه',
                'شوكلاتة محشية بالبندق',
            ],
        ];

        foreach ($mapping as $restaurantName => $dishNames) {
            $restaurant = $restaurants[$restaurantName] ?? null;

            if ($restaurant) {
                foreach ($dishNames as $dishName) {
                    $dish = $dishes->firstWhere('name', $dishName);

                    if ($dish) {
                        DB::table('dishes_restaurants')->insert([
                            'id' => (string) Str::uuid(),
                            'restaurants_id' => $restaurant->id,
                            'dishes_id' => $dish->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}
