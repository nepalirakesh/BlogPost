<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use withFaker;

    private $user;
    private $tags;
    private $post;

    /**
     * Initial Setup
     * @return void
     *
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->tags = Tag::factory()->count(3)->create();
        $this->post = Post::factory()->hasAttached($this->tags)->create();
    }

    /**
     * @test
     *
     * @group updatePost
     *
     * @covers PostController::update()
     *
     * Authencated User can update Post and flash message is shown upon successful update
     *
     * Stagus 302
     *
     * @return void
     */
    public function authenticated_user_can_update_post_with_flash_message(): void
    {
        $filename = Str::random(7) . '.jpg';

        $updatePost = [
            'author_id' => $this->post->author_id,
            'title' => 'This is an second updated Post',
            'description' => 'this is an updated description with more than 50 characters to pass minimum validation ',
            'content' => "The sky was a brilliant shade of orange as the sun set over the mountains. People bustled about,
            finishing their daily tasks before returning home to rest.",
            'image' => UploadedFile::fake()->image($filename),
            'category_id' => $this->post->category_id,
            'tags' => $this->post->tags->pluck('id')->toArray(),
        ];
        $oldImage = $this->post->image;

        $response = $this->actingAs($this->user)->PUT(route('post.update', $this->post), $updatePost);

        $response->assertStatus(302)
            ->assertSessionHas('update')
            ->assertRedirect(route('post.index'));

        $this->assertDatabaseHas(
            'posts',
            [
                'author_id' => $this->post->author_id,
                'title' => 'This is an second updated Post',
                'image' => $filename,
            ]
        );
        $updatePost = Post::first();
        $this->assertFalse(Storage::exists('public/images/' . $oldImage));
        $this->assertTrue(Storage::exists('public/images/' . $updatePost->image));

        if (Storage::exists('public/images/' . $filename)) {
            Storage::delete('public/images/' . $filename);
        }
    }

    /**
     * @test
     *
     * @group updatePost
     *
     * @covers PostController::update()
     *
     * @dataProvider updateFormValidation
     *
     * @param $userInput, $field
     *
     * Status 302
     */
    public function validation_for_update_post($userInput, $field): void
    {

        $response = $this->actingAs($this->user)->PUT(route('post.update', $this->post), $userInput);

        $response->assertStatus(302)
            ->assertSessionHasErrors($field);

        if (Storage::exists('public/images/' . $this->post->image)) {
            Storage::delete('public/images/' . $this->post->image);
        }
    }

    /**
     * Set validation for Update Post Request
     *
     * @return array
     */
    public function updateFormValidation(): array
    {
        return [

            'Author name is required' => [['author_id' => ''], ['author_id']],
            'Title is required' => [['title' => ''], ['title']],
            'Description is required' => [['description' => ' '], ['description']],
            'Description should have minimum 30 characters' => [['description' => Str::random(20)], ['description']],
            'Description should not exceed 150 characters' => [['description' => Str::random(200)], ['description']],
            'Content should have minimum 100 characters' => [['description' => Str::random(20)], ['content']],
            'Image is required' => [['image' => ''], ['image']],
            'Category is required' => [['category_id' => ''], ['category_id']],
            'Tags field is required' => [['tags' => ''], ['tags']],
        ];
    }
}
