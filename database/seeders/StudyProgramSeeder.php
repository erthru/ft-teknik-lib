<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\StudyProgram;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudyProgram::create([
            "name" => "Sistem Informasi",
            "major_id" => 1,
        ]);

        StudyProgram::create([
            "name" => "Pendidikan Teknologi Informasi",
            "major_id" => 1,
        ]);
    }
}
