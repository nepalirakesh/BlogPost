<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexTest extends TestCase
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
        $this->categories = Category::factory()->count(20)->create();
    }

    /**
     * @test
     * 
     * @covers CategoryController::index()
     * 
     * Unauthenticated user must be redirected to login page
     * 
     * Status 302
     * 
     * @return void
     */
    public function unauthenticated_user_redirected_to_login_page(): void
    {
        $response = $this->get(route('category.index'));

        $response->assertstatus(302)
                 ->assertRedirect('login')
                 ->assertSee('login');
    }

    /**
     * @test
     * 
     * @covers CategoryController::index()
     * 
     * Authenticated user can view Category index page 
     * 
     * Status 200
     * 
     * @return void
     */
    public function authenticated_user_can_view_category_index_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('category.index'));

        $response->assertstatus(200)
                 ->assertViewIs('blog.category.index')
                 ->assertViewHas('categories')
                 ->assertSeeInOrder(['/category/show', '/category/edit', '/category/delete']);

        $this->assertEquals(Auth::user()->name, $this->user->name);
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
