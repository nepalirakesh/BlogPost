<?php

namespace Tests\Feature\Author;


use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    private $tags;
    private $users;
    private $categories;

    /**
     * Initial Setup
     * 
     * @return void
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
     * 
     * @covers AuthrController::delete
     * 
     * User can delete an existing author
     * 
     * Status code:302
     * 
     * @return void
     */

    public function user_can_delete_author(): void
    {
        //Storing new Author through Author Controller
        $filename = Str::random(8) . '.jpg';
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
        $response->assertRedirect('author');
        $response->assertStatus(302);

        //Finding the first row in author table
        $author = Author::first();
        $this->assertTrue(Storage::exists('public/images/' . $author->image));


        //Deleting the created author through AuthorController using destroy function and successfully
        //redirect to authors index page
        $response = $this->actingAs($this->users)->DELETE(route('author.delete', $author->id));
        $response->assertRedirect('author')->assertSessionHas('delete');


        //Checking whether the created author image exists in the storage folder
        $this->assertFalse(Storage::exists('public/images/' . $author->image));
        $response->assertStatus(302);

        if(Storage::exists('public/images/'.$author->image)){
            Storage::delete('public/images/'.$author->image);
        }
    }
}
