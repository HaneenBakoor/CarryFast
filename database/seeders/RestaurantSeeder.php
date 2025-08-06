<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Support\Str;
class RestaurantSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all()->keyBy('name');

        $restaurants = [
            [
                'name' => 'ألو تشكن - Alo Chicken',
                'description' => 'أشهى الساندويشات والبيتزا والدجاج المقلي 🍗🍕',
                'image' => 'restaurants/alo_chicken.jpg',
                'category' => 'وجبات سريعة',
            ],
            [
                'name' => 'حلوبات الرجب',
                'description' => 'حلويات شرقية أصلية منذ عام 1980 🍮',
                'image' => 'restaurants/rajab_sweets.jpg',
                'category' => 'حلويات شرقية',
            ],
            [
                'name' => 'لوز - Looz',
                'description' => 'مذاق الحلويات الغربية والآيس كريم الفاخر 🍨🍰',
                'image' => 'restaurants/looz.jpg',
                'category' => 'حلويات غربية - ice cream shop',
            ],
        ];

        foreach ($restaurants as $data) {
            Restaurant::create([


                'id' => (string) Str::uuid(),
                'name' => $data['name'],
                'description' => $data['description'],
                'image' => $data['image'],
                'opening_time' => '10:00:00',
                'closing_time' => '23:30:00',
                'estimated_delivery_time' => 20,
                'minimum_order_value' => 2500,
                'category_id' => $categories[$data['category']]->id,
            ]);
        }
    }
}
