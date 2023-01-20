<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Author;
use App\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $authors = Author::all();
        $categories = Category::all();
        for ($i = 0; $i < 10; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'image' => $faker->imageUrl(),
                'content' => $faker->paragraphs(3, true),
                'author_id' => $faker->randomElement($authors)->id,
                'category_id' => $faker->randomElement($categories)->id,
            ]);
        }
    }
}
