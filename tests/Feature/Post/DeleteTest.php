<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $post;
    /**
     * Summary of setUp
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create();
    }
    /**
     * @test
     *
     * @group  postcontroller
     *
     * Summary of testDeletePost
     *
     * Status 302
     * @return void
     */
    public function delete_post()
    {
        $response = $this->actingAs($this->user)->delete(route('post.delete', $this->post->id));
        $response->assertStatus(302)
            ->assertRedirect(route('post.index'))
            ->assertSessionHas('delete', 'post deleted successfully');

        $this->assertDatabaseMissing('posts', ['id' => $this->post->id])
            ->assertFalse(Storage::exists('public/images/' . $this->post->image));

        if (Storage::exists('public/images/' . $this->post->image)) {
            Storage::delete('public/images/' . $this->post->image);
        }
    }
}
