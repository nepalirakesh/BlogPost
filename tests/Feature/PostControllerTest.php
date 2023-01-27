<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PostControllerTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * Initial settings
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->tags = Tag::factory()->create();
        $this->categories = Category::factory()->create();
        $this->authors = Author::factory()->create();

    }

    /**
     * @test
     * @covers PostController::create()
     *
     * Summary of it_can_show_page_to_create_posts_with_required_datas
     *
     * @return void
     */
    public function it_can_show_page_to_create_posts_with_required_datas(): void
    {
        $this->actingAs($this->user);
        $tags = Tag::all();
        $categories = Category::all();
        $authors = Author::all();
        // dd($tags);
        $url = "/post/create";

        $this->get($url)
            ->assertStatus(200)
            ->assertViewIs('blog.post.create')
            ->assertViewHasAll([
                'tags' => $tags,
                'authors' => $authors,
                'categories' => $categories
            ]);

    }

}
