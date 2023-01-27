<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function a_logged_in_user_can_update_post()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)-> from(route('post.create'))
        ->post(route('post.store'),[

        ]);

        $response->assertStatus(200);
    }
}
