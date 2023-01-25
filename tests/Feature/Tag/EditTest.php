<?php

namespace Tests\Feature\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tag;

class EditTest extends TestCase
{
    /**
     * @test
     *
     * A basic feature test example.
     *
     * @return void
     */
    public function a_logged_in_user_can_view_edit_form()
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();
        $response = $this->actingAs($user)->get(route('tag.edit', $tag->id));

        $response->assertStatus(200)->assertViewIs('blog.tag.edit')
            ->assertSee(['Title', 'Update']);
    }
}
