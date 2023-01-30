<?php

namespace Tests\Feature\Post;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Author;
use App\Models\Tag;


class CreateTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $tags;
    private $authors;
    private $categories;


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
