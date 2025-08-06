<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'وجبات سريعة', 'image' => 'categories/fast_food.jpg'],
            ['name' => 'حلويات شرقية', 'image' => 'categories/eastern_sweets.jpg'],
            ['name' => 'حلويات غربية - ice cream shop', 'image' => 'categories/western_sweets.jpg'],
        ];

        foreach ($categories as $category) {
             Category::create([
        'id' => (string) Str::uuid(),
        'name' => $category['name'],
        'image' => $category['image'],
    ]);
        }
    }
}
