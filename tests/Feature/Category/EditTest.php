<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class EditTest extends TestCase
{
    use RefreshDatabase;

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

        $this->user = User::factory()->create();
        $this->categories = Category::factory()->count(5)->create();
    }
    /**
     * @test
     * 
     * @covers CategoryController::delete()
     * 
     * Unauthenticate User is redirected to login page
     * 
     * Status 302
     * 
     * @return void
     */
    public function unauthenticated_user_redirect_to_login_page(): void
    {
        $category = Category::first();
        $response = $this->get(route('category.edit', $category));

        $response->assertStatus(302)
                 ->assertRedirect(route('login'));
    }

    /**
     * @test
     * 
     * @covers CategoryController::edit()
     * 
     * Authenticated User can view Edit form
     * 
     * Status 200
     * 
     * @return void
     */
    public function authenticated_user_can_view_edit_form(): void
    {
        $category = Category::first();
        
        $response = $this->actingAs($this->user)->get(route('category.edit', $category));

        $response->assertStatus(200)
                 ->assertViewIs('blog.category.edit')
                 ->assertSeeInOrder(['title', 'description'])
                 ->assertViewHas('category');
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
}
