<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;


class EditTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $post;
    private $tags;

    /**
     * Initial Setup
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->tags = Tag::factory()->count(3)->create();
        $this->post = Post::factory()->hasAttached($this->tags)->create();
    }

    /**
     *
     * @test
     * 
     * @group PostEdit
     * 
     * @covers PostController::edit()
     * 
     * Guest user is redirected to login page
     * 
     * Status 302 
     * 
     * @return void
     */
    public function guest_user_is_redirected_to_login_page(): void
    {
        $response = $this->get(route('post.edit', $this->post));

        $response->assertStatus(302)
            ->assertRedirect(route('login'));

        if (Storage::exists('public/images/' . $this->post->image)) {
            Storage::delete('public/images/' . $this->post->image);
        }
    }

    /**
     * @test
     * 
     * @group PostEdit
     * 
     * @covers PostController::edit()
     * 
     * Authenticated user can view edit form of selected post
     * 
     * Status 200
     * 
     * @return void
     */
    public function authenticated_user_can_view_edit_page(): void
    {

        $authors = Author::all();
        $categories = Category::all();
        $tags = Tag::all();

        $response = $this->actingAs($this->user)->get(route('post.edit', $this->post));

        $response->assertStatus(200)
            ->assertViewIs('blog.post.edit')
            ->assertViewHasAll([
                'post' => $this->post,
                'authors' => $authors,
                'categories' => $categories,
                'tags' => $tags,
            ]);

        if (Storage::exists('public/images/' . $this->post->image)) {
            Storage::delete('public/images/' . $this->post->image);
        }
    }

    /**
     * @test
     * 
     * @group  PostEdit
     * 
     * @covers AuthenticatesUsers::logout()
     * 
     * Authenticated user is redirect to home page if logout successfully
     * 
     * Status 302
     * 
     * @return void
     */
    public function redirect_to_home_if_logout(): void
    {
        $response = $this->actingAs($this->user)->post(route('logout'));

        $response->assertStatus(302)
            ->assertRedirect(route('home'));

        if (Storage::exists('public/images/' . $this->post->image)) {
            Storage::delete('public/images/' . $this->post->image);
        }
    }
}
