<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $currencies = [
            [
                'id' => (string) Str::uuid(),
                'name' => 'Syrian Pound',
                'code' => 'SYR',
                'symbol' => 'ل.س',
                // This is a dummy rate. It's often relative to a base currency like USD.
                'exchange_rate' => 1.0,
                'is_default' => true,
                'fuel_price_per_liter' => 500.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'United States Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'exchange_rate' => 10700.00, // Example: 1 USD to SYR
                'is_default' => false,
                'fuel_price_per_liter' => 1.25,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Turkish Lira',
                'code' => 'TRY',
                'symbol' => '₺',
                'exchange_rate' => 450.00, // Example: 1 TRY to SYR
                'is_default' => false,
                'fuel_price_per_liter' => 25.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];


        DB::table('currencies')->insert($currencies);
    }
}
