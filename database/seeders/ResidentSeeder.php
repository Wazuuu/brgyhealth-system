<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resident;
use Faker\Factory as Faker;

class ResidentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1245; $i++) {
            $gender = $faker->randomElement(['male', 'female']);
            $age = $faker->numberBetween(0, 80);
            $birth_date = now()->subYears($age)->subDays(rand(0, 364));
            $status = $faker->randomElement(['healthy','sick']);
            $pregnant = ($gender === 'female' && $age >= 18 && $age <= 45) ? $faker->boolean(10) : false;

            Resident::create([
                'first_name' => $faker->firstName($gender),
                'last_name' => $faker->lastName,
                'birth_date' => $birth_date,
                'gender' => $gender,
                'status' => $status,
                'pregnant' => $pregnant,
            ]);
        }
    }
}
