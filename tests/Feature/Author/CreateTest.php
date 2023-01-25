<?php

namespace Tests\Feature\Author;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use App\Models\Author;
use Faker\Factory as Faker;

class CreateTest extends TestCase
{
    use WithFaker;

    private $tags;
    private $users;
    private $categories;



    public function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();

        $this->users = User::factory()->create();
        $this->tags  = Tag::factory()->create();
        $this->categories = Category::factory()->create();
    }


    /**
     * @test
     * @covers AuthorController::create
     * Login Check to view create page
     * @return void
     */
    public function user_must_login_to_view_create_author(): void
    {
        $response = $this->post('login', [
            'email' => $this->users->email,
            'password' => $this->users->password
        ]);
        $response->assertStatus(302);
    }


    /**
     * @test
     * @covers AuthorController::store()
     * User can create new author
     * Status:302 
     * @return void
     */
    public function user_can_create_author(): void
    {
        $filename = 'test.jpg';
        $this->actingas($this->users);
        $image = UploadedFile::fake()->image($filename);
        $email = $this->faker->unique()->email;
        $description = $this->faker->text;

        $author = [
            'name' => 'test name',
            'email' => $email,
            'image' => $image,
            'description' => $description,
        ];
        $response = $this->post('/store', $author);
        $response->assertRedirect('author')->assertSessionHas('success');
        $response->assertStatus(302);


        $author = Author::first();


        //Checking whether the created image exists in storage folder
        $this->assertTrue(Storage::exists('public/images/' . $author->image));

        //Checking the database whether for created author
        $this->assertDatabaseHas('authors', [
            'name' => 'test name',
            'email' => $email,
            'image' => $filename,
            'description' => $description
        ]);
    }


    /**
     * @test
     * @covers AuthorController::store()
     * @dataProvider AuthorValidation
     * @param $UserInput
     * Author Create validation check
     * Status:302 
     * 
     */
    public function validation_check_create_author($UserInput, $field): void
    {

        $faker = Faker::create();
        $image = UploadedFile::fake()->image('image.jpg');
        $author = new Author;
        $author->name = 'Ram';
        $author->email = 'ram@example.com';
        $author->image = $image;
        $author->description = $faker->sentence;
        $author->save();
        $this->actingas($this->users);

        $response = $this->post('/store', $UserInput);
        $response->assertSessionHasErrors($field);
    }

    /**
     * @return array
     */
    public function AuthorValidation(): array
    {
        return [
            'Name Required'         => [['name' => ''], ['name']],
            'Name must be string'   => [['name' => 1234], ['name']],
            'Name can have Max 30'  => [['name' => Str::random(300)], ['name']],
            'Email Required'        => [['email' => ''], ['email']],
            'Email must be unique'  => [['email' => 'ram@example.com'], ['email']],
            'Image Required'        => [['image' => ''], ['image']],
            'Description Required'  => [['description' => ''], ['description']],
            'Description Minimum'   => [['description' => Str::random(5)], ['description']],
            'Description Maximum'   => [['description' => Str::random(400)], ['description']],

        ];
    }
}
