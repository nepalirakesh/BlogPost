<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;

class PostFactory extends Factory
{
    private $factory;
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
            'content' => $this->faker->text,
            'author_id' => Author::factory()->create()->id,
            'category_id' => Category::factory()->create()->id
        ];
    }
}
