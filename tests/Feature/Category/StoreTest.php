<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    /**
     * Intial Setup
     * 
     * @return
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->make();
    }

    /**
     * @test
     * 
     * @covers CategoryController::store()
     * 
     * Get request method will throw error message for authenticated user
     * 
     * Status 405
     * 
     * @return void
     */
    public function get_request_shows_error_for_authenticated_user(): void
    {
        $response = $this->actingAs($this->user)->get(route('category.store'));

        $response->assertStatus(405)
            ->assertSee('The GET method is not supported for this route. Supported methods: POST');
    }

    /**
     * @test
     * 
     * @covers CategoryController::store()
     * 
     * Get request method will throw error message for unauthenticated user
     * 
     * Status 405
     * 
     * @return void
     */
    public function get_request_shows_error_for_unauthenticated_user(): void
    {
        $response = $this->get(route('category.store'));

        $response->assertStatus(405)
            ->assertSee('The GET method is not supported for this route. Supported methods: POST');
    }

    /**
     * @test
     * 
     * @covers CategoryController::store()
     * 
     * Redirect to index page of category with flash message if category created successfully
     * 
     * Status 302
     */
    public function redirect_to_category_index_with_flash_message(): void
    {
        $category = [
            'title' => 'Testing Category again',
            'description' => 'Description about testing categories store function'
        ];

        $response = $this->actingAs($this->user)
            ->post(route('category.store'), $category);

        $response->assertStatus(302)
            ->assertRedirect(route('category.index'))
            ->assertSessionHas('success', 'category created successfully');

        $this->assertDatabaseHas('categories', [
            'title' => 'Testing Category again'
        ]);
    }

    /**
     * @test
     * 
     * @covers CatergoryController::store()
     * 
     * Unique field validation for title field
     * 
     * Status 302
     * 
     * @return void
     */
    public function title_must_be_unique(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->user)->post(route('category.store'), [
            'title' => $category->title,
            'description' => 'Description about title',
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['title']);
    }

    /**
     * @test 
     * 
     * @covers CategoryController::store()
     * 
     * @dataProvider categoryFormValidation
     * 
     * Show validation error message for invalid input
     * 
     * Status 302
     * 
     * @param $userInput, $field
     */
    public function validate_category_input_request($userInput, $field): void
    {
        $response = $this->actingAs($this->user)->post(route('category.store'), $userInput);

        $response->assertSessionHasErrors($field);
    }

    /**
     * Validation test for store method of category
     * 
     * @return array
     */
    public function categoryFormValidation(): array
    {
        return [
            'Title is required' => [['title' => ''], ['title']],
            'Title must be string' => [['title' => 1234], ['title']],
            'Title should not exceed 100 characters' => [['title' => Str::random(200)], ['title']],
            'Description is required' => [['description' => ''], ['description']],
            'Description should not exceed 300 characters' => [['description' => Str::random(350)], ['description']],
            'Description should have mininum 10 characters' => [['description' => Str::random(8)], ['description']],
        ];
    }
}
