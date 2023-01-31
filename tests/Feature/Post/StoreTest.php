<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use App\Models\Author;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;

use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $author;
    private $category;
    private $tags;
    /**
     * Summary of setUp
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->author = Author::factory()->create();
        $this->category = Category::factory()->create();
        $this->tags = Tag::factory()->create();
    }
    /**
     * @test
     * @group  postcontroller
     *
     *@covers PostController::store()
     *
     * Summary of a_logged_in_user_can_create_and_store_post
     * @return void
     */

    public function a_logged_in_user_can_create_and_store_post()
    {
        $file = UploadedFile::fake()->image('test.jpg');

        $data = [
            'author_id' => $this->author->id,
            'title' => Str::random(20),
            'description' => Str::random(40),
            'content' => Str::random(100),
            'category_id' => $this->category->id,
            'tags' => $this->tags->pluck('id')->toArray(),
            'image' => $file
        ];

        $response = $this->actingAs($this->user)->post(route('post.store'), $data);
        $response->assertStatus(302);

        $post = Post::first();

        $response->assertRedirect(route('post.index'))
            ->assertSessionHas('success', 'post added successfully');

        $this->assertDatabaseHas('posts', [
            'author_id' => $this->author->id,
            'title' => $post->title,
            'description' => $post->description,
            'content' => $post->content,
            'category_id' => $this->category->id,
            'image' => $post->image,
        ])
            ->assertTrue(Storage::exists('public/images/' . $post->image));
    }
    /**
     * @test
     *
     *
     * @covers PostController::store()
     *
     * @dataProvider storeFormValidation
     *
     * @param $userInput, $field
     *
     * Status 302
     */
    public function validation_for_store_post($userInput, $field): void
    {
        $response = $this->actingAs($this->user)->post(route('post.store'), $userInput);

        $response->assertStatus(302)
            ->assertSessionHasErrors($field);

        if (Storage::exists('public\images\test.jpg')) {
            Storage::delete('public\images\test.jpg');
        }

    }

    /**
     * Set validation for Store Post Request
     *
     * @return array
     */
    public function storeFormValidation(): array
    {
        return [
            'Author name is required' => [['author_id' => ''], ['author_id']],
            'Title is required' => [['title' => ''], ['title']],
            'Description is required' => [['description' => ' '], ['description']],
            'Description should have minimum 30 characters' => [['description' => Str::random(20)], ['description']],
            'Description should not exceed 150 characters' => [['description' => Str::random(200)], ['description']],
            'Content should have minimum 100 characters' => [['content' => Str::random(20)], ['content']],
            'Image is required' => [['image' => ''], ['image']],
            'Category is required' => [['category_id' => ''], ['category_id']],
            'Tags field is required' => [['tags' => ''], ['tags']],
        ];
    }

}
