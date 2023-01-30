<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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
            'title' => $this->faker->title,
            'description' => $this->faker->text(50),
            'image' => $this->faker->image('public/storage/images',500,500,null,false),
            'content' => $this->faker->paragraph(4),
            'author_id' => Author::factory()->create()->id,
            'category_id' => Category::factory()->create()->id
        ];
    }
}
