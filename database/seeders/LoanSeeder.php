<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Loan;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $date = "2020/05/12";

        for($i=0; $i<50; $i++){
            Loan::create([
                "borrowed_date" => $date,
                "due_date" => date("Y-m-d", strtotime($date. " + 7 days")),
                "returned_date" => rand(0, 1) ? date("Y-m-d", strtotime($date. " + 4 days")) : null,
                "is_lost" => "0",
                "item_id" => $faker->unique()->numberBetween(1, 99),
                "member_id" => $faker->numberBetween(1, 99),
                "admin_id" => 1,
            ]);
        }
    }
}
