<?php
namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Check if the table is empty to avoid duplicates on multiple runs
        if (User::all()->isNotEmpty()) {
            echo "Users table is already seeded. Skipping.\n";
            return;
        }

        DB::table('users')->insert([
            'id'                => (string) Str::uuid(),
            'name'              => 'Admin User',
            'email'             => 'admin@carryfast.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('12345678'),
            'role'              => 'admin',
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        DB::table('users')->insert([
            'id'                => (string) Str::uuid(),
            'name'              => 'Customer User',
            'email'             => 'customer@example.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('12345678'),
            'role'              => 'user',
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        // Create 10 delivery users
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'id'                      => (string) Str::uuid(),
                'name'                    => $faker->name,
                'email'                   => $faker->unique()->safeEmail,
                'email_verified_at'       => now(),
                'password'                => Hash::make('password'),
                'role'                    => 'delivery',
                'created_at'              => now(),
                'updated_at'              => now(),
                'motorcycle_brand'        => $faker->randomElement(['Honda', 'Yamaha', 'Suzuki', 'Kawasaki']),
                'motorcycle_model'        => $faker->randomElement(['CB500', 'R1', 'GSX-R', 'Ninja 400']) . ' ' . $faker->numberBetween(2018, 2023),
                'license_plate'           => $faker->regexify('[A-Z]{2}[0-9]{4}[A-Z]{2}'),
                'fuel_consumption_per_km' => $faker->randomFloat(2, 0.03, 0.08),

            ]);
        }
        User::create([
            'id'                => (string) Str::uuid(),
            'name'              => 'haneen',
            'email'             => 'haneenbakoor512@gmail.com',
            'password'          => Hash::make('12345678'),
            'image'             => $faker->imageUrl(),
            'phone_number'      => $faker->phoneNumber,
            'role'              => 'user',
            'google_id'         => null,
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);
    }
}
