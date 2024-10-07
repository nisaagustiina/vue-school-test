<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'timezone' => $faker->timezone,
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
