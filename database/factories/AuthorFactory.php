<?php

namespace Database\Factories;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model=Author::class;
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'image'=>$this->faker->image,
            'description'=>$this->faker->text,
        ];
    }
}
