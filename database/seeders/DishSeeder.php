<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class DishSeeder extends Seeder
{
    public function run()
    {

        $subcategories = Subcategory::all()->keyBy('name');

        $dishes = [
            // 🐔 Alo Chicken
            ['name' => 'ساندويش دجاج كريسبي', 'price' => 1500, 'image' => 'dishes/crispy_chicken.jpg','subcategory' => 'ساندويش'],
            ['name' => 'برغر دبل لحم', 'price' => 1800, 'image' => 'dishes/double_burger.jpg', 'subcategory' => 'برغر'],
            ['name' => 'بيتزا مارجريتا', 'price' => 2300, 'image' => 'dishes/margherita.jpg', 'subcategory' => 'بيتزا'],
            ['name' => 'بطاطا مقلية مع جبنة', 'price' => 1000, 'image' => 'dishes/cheesy_fries.jpg',  'subcategory' => 'مشروبات'],
            ['name' => 'عصير ليمون منعش', 'price' => 700, 'image' => 'dishes/lemonade.jpg', 'subcategory' => 'مشروبات'],
            ['name' => 'برغر دجاج ناري', 'price' => 1700, 'image' => 'dishes/spicy_chicken.jpg', 'subcategory' => 'برغر'],
            ['name' => 'بيتزا ببروني', 'price' => 2500, 'image' => 'dishes/pepperoni.jpg', 'subcategory' => 'بيتزا'],
            ['name' => 'ساندويش زنجر', 'price' => 1600, 'image' => 'dishes/zinger.jpg',  'subcategory' => 'ساندويش'],

            // 🍮 حلوبات الرجب
            ['name' => 'كنافة نابلسية', 'price' => 2000, 'image' => 'dishes/knafeh.jpg', 'subcategory' => 'كنافة'],
            ['name' => 'بقلاوة بالفستق', 'price' => 1800, 'image' => 'dishes/baklava_pistachio.jpg', 'subcategory' => 'بقلاوة'],
            ['name' => 'معمول تمر', 'price' => 900, 'image' => 'dishes/maamoul.jpg',  'subcategory' => 'كنافة'],
            ['name' => 'بلورية بالقشطة', 'price' => 1400, 'image' => 'dishes/baloria.jpg','subcategory' => 'بقلاوة'],
            ['name' => 'زنود الست', 'price' => 1300, 'image' => 'dishes/znoud.jpg','subcategory' => 'كنافة'],
            ['name' => 'غريبة السمنة', 'price' => 800, 'image' => 'dishes/ghraybeh.jpg', 'subcategory' => 'بقلاوة'],
            ['name' => 'بقلاوة جوز', 'price' => 1600, 'image' => 'dishes/baklava_walnut.jpg', 'subcategory' => 'بقلاوة'],
            ['name' => 'كنافة خشنة', 'price' => 1900, 'image' => 'dishes/coarse_knafeh.jpg', 'subcategory' => 'كنافة'],

            // 🍨 Looz
            ['name' => 'آيس كريم نوتيلا', 'price' => 1700, 'image' => 'dishes/nutella_icecream.jpg','subcategory' => 'ice cream'],
            ['name' => 'تشيز كيك فراولة', 'price' => 2200, 'image' => 'dishes/strawberry_cheesecake.jpg',  'subcategory' => 'cake'],
            ['name' => 'سوشي شوكولا', 'price' => 1800, 'image' => 'dishes/chocolate_sushi.jpg', 'subcategory' => 'سوشي'],
            ['name' => 'براوني شوكولا داكنة', 'price' => 2000, 'image' => 'dishes/dark_brownie.jpg', 'subcategory' => 'شوكولا'],
            ['name' => 'آيس كريم فانيليا وكراميل', 'price' => 1600, 'image' => 'dishes/vanilla_caramel.jpg', 'subcategory' => 'ice cream'],
            ['name' => 'كيك الشوكولا الغني', 'price' => 2100, 'image' => 'dishes/chocolate_cake.jpg','subcategory' => 'cake'],
            ['name' => 'سوشي حلويات بالفواكه', 'price' => 1900, 'image' => 'dishes/fruit_sweets_sushi.jpg',  'subcategory' => 'سوشي'],
            ['name' => 'شوكلاتة محشية بالبندق', 'price' => 1500, 'image' => 'dishes/hazelnut_choco.jpg',  'subcategory' => 'شوكولا'],
        ];

       foreach ($dishes as $dish) {
    Dish::create([
        'id' => (string) Str::uuid(),
        'name' => $dish['name'],
        'price' => $dish['price'],
        'image' => $dish['image'],
        'sub_category_id' => $subcategories[$dish['subcategory']]->id,
        'description' => match ($dish['name']) {
            'ساندويش دجاج كريسبي' => 'دجاج مقرمش مع خس وصوص خاص داخل خبز طري.',
            'برغر دبل لحم' => 'برغر بلحم مزدوج، جبنة، وصلصة مشوية.',
            'بيتزا مارجريتا' => 'عجينة رقيقة مع صلصة طماطم وجبنة موتزاريلا.',
            'بطاطا مقلية مع جبنة' => 'بطاطا ذهبية مغطاة بجبنة ذائبة.',
            'عصير ليمون منعش' => 'عصير ليمون طبيعي مع نعناع وسكر خفيف.',
            'برغر دجاج ناري' => 'دجاج حار مع صوص سبايسي وخضار طازجة.',
            'بيتزا ببروني' => 'بيتزا بجبنة وشرائح ببروني حارة.',
            'ساندويش زنجر' => 'دجاج زنجر مقرمش مع صوص ثوم وخس.',
            'كنافة نابلسية' => 'كنافة ناعمة محشوة بالجبنة ومغطاة بالقطر.',
            'بقلاوة بالفستق' => 'طبقات عجين محشوة بالفستق ومغطاة بالقطر.',
            'معمول تمر' => 'معمول تقليدي محشو بعجينة التمر.',
            'بلورية بالقشطة' => 'حلوى شرقية محشوة بالقشطة ومزينة بالفستق.',
            'زنود الست' => 'عجينة مقرمشة محشوة بالقشطة ومغطاة بالقطر.',
            'غريبة السمنة' => 'بسكويت ناعم مصنوع من السمنة والدقيق.',
            'بقلاوة جوز' => 'بقلاوة محشوة بالجوز ومغطاة بالقطر.',
            'كنافة خشنة' => 'كنافة خشنة محشوة بالجبنة ومحمّرة بالفرن.',
            'آيس كريم نوتيلا' => 'آيس كريم غني بنكهة نوتيلا وشوكولا.',
            'تشيز كيك فراولة' => 'تشيز كيك بطبقة فراولة طازجة.',
            'سوشي شوكولا' => 'لفائف شوكولا محشوة بكريمة وبسكويت.',
            'براوني شوكولا داكنة' => 'براوني كثيف بنكهة الشوكولا الداكنة.',
            'آيس كريم فانيليا وكراميل' => 'آيس كريم فانيليا مع صوص كراميل.',
            'كيك الشوكولا الغني' => 'كيك شوكولا بطبقات كثيفة وكريمة.',
            'سوشي حلويات بالفواكه' => 'سوشي حلويات محشو بكريمة وفواكه طازجة.',
            'شوكلاتة محشية بالبندق' => 'قطع شوكولا محشوة بكريمة البندق.',
            default => 'طبق شهي مقدم بعناية.',
        },
    ]);
}
    }
}
