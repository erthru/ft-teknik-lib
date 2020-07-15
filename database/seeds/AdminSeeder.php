<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $body = [
            "username" => "admin",
            "password" => Hash::make("admin")
        ];

        Admin::create($body);
    }
}
