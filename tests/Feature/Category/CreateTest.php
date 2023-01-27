<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    /**
     * Initial Setup
     * 
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->make();
    }

    /**
     * @test
     * 
     * @covers CategoryController::create()
     * 
     * Unathenticated user will be redirected to login page.
     * 
     * Response 302
     * 
     * @return void
     */
    public function unauthenticated_user_redirected_to_login_page(): void
    {
        $response = $this->get(route('category.create'));

        $response->assertStatus(302)
                 ->assertRedirect(route('login'))
                 ->assertSee('login');
    }

    /**
     * @test
     *
     * @covers AuthenticatesUsers::logout()
     * 
     * Authenticated user is redirect to home page if logout successfully
     * 
     * Status 302
     * 
     * @return void
     */
    public function redirect_to_home_if_logout(): void
    {
        $response = $this->actingAs($this->user)->post(route('logout'));
        
        $response->assertStatus(302)
                 ->assertRedirect(route('home'));
    }

    /**
     * @test
     * 
     * @covers CategoryController::create()
     * 
     * Show form to create category if authenticated
     * 
     * Response 200
     * 
     * @return void
     */
    public function show_create_category_page_if_authenticated(): void
    {
        $response = $this->actingAs($this->user)->get(route('category.create'));

        $response->assertStatus(200)
                 ->assertViewIs('blog.category.create')
                 ->assertSeeInOrder(['Title', 'Description', 'Submit'])
                 ->assertSee('/category/store');
    }
}
