<?php

namespace Tests\Feature\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tag;

class ShowTest extends TestCase
{
    private $user;
    /**
     * @test
     *
     * Summary of show_the_single_tag_view
     * @return void
     */
    public function show_the_single_tag_view()
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();
        $response = $this->actingAs($user)->get(route('tag.show', $tag->id))
            ->assertStatus(200)
            ->assertViewIs('blog.tag.show')
            ->assertSee('Tag');

        $this->assertDatabaseHas('tags', [
            'title' => $tag->title,
            'description' => $tag->description
        ]);


    }
}
