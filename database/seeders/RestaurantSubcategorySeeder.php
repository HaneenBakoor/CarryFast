<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;
use App\Models\Subcategory;

class RestaurantSubcategorySeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = Restaurant::all()->keyBy('name');
        $subcategories = Subcategory::all()->keyBy('name');

        $mapping = [
            'ألو تشكن - Alo Chicken' => ['ساندويش', 'بيتزا', 'برغر', 'مشروبات'],
            'حلوبات الرجب' => ['كنافة', 'بقلاوة'],
            'لوز - Looz' => ['ice cream', 'cake', 'سوشي', 'شوكولا'],
        ];

        foreach ($mapping as $restaurantName => $subcategoryNames) {
            $restaurant = $restaurants[$restaurantName] ?? null;

            if ($restaurant) {
                foreach ($subcategoryNames as $subName) {
                    $subcategory = $subcategories[$subName] ?? null;

                    if ($subcategory) {
                        DB::table('restaurants_subcategories')->insert([
                            'id' => (string) Str::uuid(),
                            'restaurants_id' => $restaurant->id,
                            'sub_categories_id' => $subcategory->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}
