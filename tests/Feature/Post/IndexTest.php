<?php

namespace Tests\Feature\Post;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\Post;
use App\Models\Author;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;



class IndexTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    /**
     * @test
     * @covers PostController::index()
     *
     * Summary of test_a_logged_in_user_can_create_a_new_post
     * @return void
     */
    public function a_logged_in_user_can_view_posts()
    {
        $user = User::factory()->create();
        $posts = Post::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('post.index'))
            ->assertStatus(200)
            ->assertViewIs('blog.post.index')
            ->assertViewHas('posts');
        // dd($response->getStatusCode());


    }
}
