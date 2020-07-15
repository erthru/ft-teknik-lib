<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Item;

class ItemSeeder extends Seeder
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
            Item::create([
                "code" => uniqid(),
                "title" => $faker->word,
                "isbn_issn" => $faker->isbn10,
                "classification" => $faker->sentence,
                "publication_year" => $faker->year,
                "type" => rand(0,1) ? "BOOK" : "ESSAY",
                "author_name" => $faker->firstName." ".$faker->lastName
            ]);
        };
    }
}
