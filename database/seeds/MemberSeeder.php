<?php

use Illuminate\Database\Seeder;
use App\Member;
use Faker\Factory;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for($i=0; $i<100; $i++){
            Member::create([
                "nim" => $faker->unique()->randomNumber,
                "full_name" => $faker->name,
                "phone" => $faker->e164PhoneNumber,
                "address" => $faker->address,
                "gender" => rand(0, 1) ? "MEN" : "WOMEN",
                "major_id" => 1,
                "study_program_id" => rand(0, 1) ? 1 : 2
            ]);
        }
    }
}
