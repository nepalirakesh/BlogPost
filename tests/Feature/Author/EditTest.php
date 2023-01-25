<?php

namespace Tests\Feature\Author;

namespace Tests\Feature\Author;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use App\Models\Author;
use Faker\Factory as Faker;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Str;

class EditTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $tags;
    private $users;
    private $categories;

    /**
     * Users factory 
     * Tags factory
     * Categories factory
     */

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
     * @covers AuthorController::edit
     * User must login to view edit page of Author
     * status 200
     * @return void
     */

    public function user_must_login_to_view_edit_author(): void
    {
        $response = $this->actingAs($this->users)->get('/edit/2');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @covers AuthorController::update
     * User can edit Author
     * Status code:302
     * @return void
     */
    public function user_can_edit_author(): void
    {
        $faker = Faker::create();
        $filename = 'image.jpg';
        $image = UploadedFile::fake()->image($filename);

        //Storing new author 
        $author = new Author;
        $author->name = 'Ram';
        $author->email = 'ram@example.com';
        $author->image = $image;
        $author->description = $faker->sentence;
        $author->save();

        //Finding the first row of author Table
        $uauthor = Author::first();
        $this->assertTrue(Storage::exists('public/images/' . $filename));


        //Updating the value of author by authenticated user
        $imagefile = 'testimage.jpg';
        $image = UploadedFile::fake()->image($imagefile);
        $newauthor = [
            'name' => 'Name test',
            'email' => 'email123@example.com',
            'image' => $image,
            'description' =>  'test description wow'
        ];
        $response = $this->actingAs($this->users)->PUT(route('author.update', $uauthor->id), $newauthor);

        //Finding the first row of author Table
        $uauthor = Author::first();

        //Updated image Created at the storage path
        $this->assertTrue(Storage::exists('public/images/' . $uauthor->image));

        //Previous image Deleted from the storage path
        $this->assertFalse(File::exists('public/images/' . $filename));
        $response->assertRedirect('author')->assertSessionHas('update');


        //Matching the updated value in Database
        $this->assertDatabaseHas('authors', [
            'name' => 'Name test',
            'email' => 'email123@example.com',
            'image' => $imagefile,
            'description' =>  'test description wow'
        ]);

        $response->assertStatus(302);
    }


    /**
     * @test
     * @dataProvider requiredEditValidation
     * @covers AuthorController::update
     * User can edit Author
     * @param $UserInput
     */
    public function validate_edit_author($UserInput, $field): void
    {
        $faker = Faker::create();
        $image = UploadedFile::fake()->image('image.jpg');

        //Creating a new author and saving in Database
        $author = new Author;
        $author->name = 'Ram';
        $author->email = 'ram@example.com';
        $author->image = $image;
        $author->description = $faker->sentence;
        $author->save();

        //Finding the first row in the database
        $uauthor = Author::first();

        //Updating the author with data providers for validation errors
        $response = $this->actingAs($this->users)->PUT(route('author.update', $uauthor->id), $UserInput);
        $response->assertSessionHasErrors($field);
    }

    /**
     * @return array
     */
    public function requiredEditValidation(): array
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
