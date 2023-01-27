<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    
    private $user;
    private $category;

    /**
     * Initial Setup
     * 
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->make();
        $this->category = Category::factory()->create();
    }

    /**
     * @test
     * 
     * @covers CategoryController::show()
     * 
     * Unauthenticated users are redirected to login page
     * 
     * Status 302
     * 
     * @return void
     */
    public function redirect_to_login_if_unauthenticated() : void
    {
        $response = $this->get(route('category.show', $this->category));

        $response->assertStatus(302);
    }

    /**
     * @test
     * 
     * @covers CategoryController::show()
     * 
     * show requested  category if User is Authenticated
     * 
     * Status 200
     * 
     * @return void
     */
    public function show_category_if_authenticated() : void
    {
        $response = $this->actingAs($this->user)->get(route('category.show',$this->category));

        $response->assertStatus(200)
                 ->assertViewIs('blog.category.show')
                 ->assertViewHas('category');
         
        $this->assertModelExists($this->category)
             ->assertDatabaseHas('categories',['title' => $this->category->title]);       
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
