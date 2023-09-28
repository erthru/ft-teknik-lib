<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Major;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Major::create([
            "name" => "Teknik Informatika"
        ]);

        Major::create([
            "name" => "Teknik Sipil"
        ]);

        Major::create([
            "name" => "Teknik Elektro"
        ]);

        Major::create([
            "name" => "Teknik Kriya"
        ]);

        Major::create([
            "name" => "Teknik Industri"
        ]);
    }
}
