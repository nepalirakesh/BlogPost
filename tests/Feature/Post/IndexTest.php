<?php

namespace Tests\Feature\Post;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;



class IndexTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $posts;
    /**
     * Initial Setup
     * Summary of setUp
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->posts = post::factory()->create();
    }
    /**
     * @test
     *
     * @group  postcontroller
     *
     * Summary of if_unauthenticated_user_tries_to_view_tag_redirect_to_login
     * @return void
     */
    public function if_unauthenticated_user_tries_to_view_tag_redirect_to_login()
    {
        $response = $this->get('/post')
            ->assertStatus(302);
        $response->assertRedirect('/login');
    }
    /**
     * @test
     *
     * @group  postcontroller
     *
     * @covers PostController::index()
     *
     * Summary of test_a_logged_in_user_can_create_a_new_post
     * @return void
     */
    public function a_logged_in_user_can_view_posts()
    {
        $response = $this->actingAs($this->user)
            ->get(route('post.index'))
            ->assertStatus(200)
            ->assertViewIs('blog.post.index')
            ->assertViewHas('posts');

        if (Storage::exists('public/images/' . $this->posts->image)) {
            Storage::delete('public/images/' . $this->posts->image);
        }
    }
    /**
     * @test
     *
     * @group  postcontroller
     *
     * Summary of user_can_logged_out
     * @return void
     */
    public function user_can_logged_out()
    {
        $this->actingAs($this->user)->post(route('logout'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }
}
