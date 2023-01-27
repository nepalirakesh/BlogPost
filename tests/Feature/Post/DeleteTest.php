<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    /**
     * @test
     *
     * Summary of testDeletePost
     * @return void
     */
    public function delete_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $response = $this->actingAs($user)->delete(route('post.delete', $post->id));
        $response->assertRedirect(route('post.index'));
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
