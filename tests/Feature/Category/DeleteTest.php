<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
   
    private $user;
    private $category;

   /**
    * Initial setup
    * @return void
    */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
    }

    /**
     * @test
     * @covers CategoryController::delete()
     * Get request method should throw error for authenticated user
     * Status 405
     * @return void
     */
    public function get_request_should_throw_error_for_authenticated_user(): void
    {
        $response = $this->actingAs($this->user)->get(route('category.delete', $this->category->id));

        $response->assertStatus(405)
            ->assertSee('The GET method is not supported for this route. Supported methods: POST');
    }
    /**
     * @test
     * @covers CategoryController::delete()
     * Get request method should throw error for unauthenticated user
     * Status 405
     * @return void
     */
    public function get_request_should_throw_error_for_unauthenticated_user(): void
    {
        $response = $this->actingAs($this->user)->get(route('category.delete', $this->category->id));

        $response->assertStatus(405)
            ->assertSee('The GET method is not supported for this route. Supported methods: POST');
    }

    /**
     * @test
     * @covers CategoryController::store()
     * Delete requested category with flash message
     * Status 302
     * @return void
     */
    public function delete_category_with_flash_message(): void
    {
        $response = $this->actingAs($this->user)->delete(route('category.delete', $this->category));

        $response->assertStatus(302)
                 ->assertRedirect(route('category.index'))
                 ->assertSessionHas('delete');

        $this->assertDatabaseMissing('categories', ['title' => $this->category->title])
            ->assertDeleted($this->category);
    }
}
