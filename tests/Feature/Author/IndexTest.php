<?php

namespace Tests\Feature\Author;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;


class IndexTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $tags;
    private $user;
    private $categories;

    /**
     * Initial Setup
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();

        $this->user = User::factory()->create();
        $this->tags  = Tag::factory()->create();
        $this->categories = Category::factory()->create();
    }

    /**
     * @test
     * 
     * @Covers Login check to view author index
     * 
     * @return void
     */
    public function user_login_with_email_and_password(): void
    {
        //Login check
        $this->post('login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();

        //logged user can view index page of author
        $this->actingAs($this->user)->get('author')
            ->assertStatus(200);
    }

    /**
     * @test
     * 
     * @covers logout
     * 
     * @return void
     */
    public function user_can_logout(): void
    {
        $this->actingAs($this->user)->post('/logout');
        $this->assertGuest();
    }
}
