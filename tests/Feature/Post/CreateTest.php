<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     *
     * @group  postcontroller
     *
     * Summary of a_logged_in_user_can_view_create_form
     * 
     * @return void
     */
    public function a_logged_in_user_can_view_create_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('post.create'))
            ->assertStatus(200)
            ->assertViewIs('blog.post.create')
            ->assertViewHas(['tags', 'categories', 'authors']);
    }
}
