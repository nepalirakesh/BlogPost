<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;



class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('authors')->insert([
                'name' => $faker->name,
                'description' => $faker->paragraph,
                'image' => $faker->imageUrl(),
                'email' => $faker->email,
            ]);
        }
    }
}
