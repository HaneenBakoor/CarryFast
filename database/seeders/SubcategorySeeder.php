<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Subcategory;
use App\Models\Category;

     use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all()->keyBy('name');

        $subcategories = [
            ['name' => 'ساندويش', 'category' => 'وجبات سريعة'],
            ['name' => 'بيتزا', 'category' => 'وجبات سريعة'],
            ['name' => 'برغر',  'category' => 'وجبات سريعة'],
            ['name' => 'مشروبات', 'category' => 'وجبات سريعة'],

            ['name' => 'كنافة', 'category' => 'حلويات شرقية'],
            ['name' => 'بقلاوة', 'category' => 'حلويات شرقية'],

            ['name' => 'شوكولا',  'category' => 'حلويات غربية - ice cream shop'],
            ['name' => 'سوشي','category' => 'حلويات غربية - ice cream shop'],
            ['name' => 'ice cream',  'category' => 'حلويات غربية - ice cream shop'],
            ['name' => 'cake', 'category' => 'حلويات غربية - ice cream shop'],
        ];


foreach ($subcategories as $sub) {
    Subcategory::create([
        'id' => (string) Str::uuid(),
        'name' => $sub['name'],
        'category_id' => $categories[$sub['category']]->id,
    ]);
}
    }
}
