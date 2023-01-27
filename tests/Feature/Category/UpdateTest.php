<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;


class UpdateTest extends TestCase
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
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
    }

    /**
     * @test
     * 
     * @covers CategoryController::update()
     * 
     * Get request method will show error message for authenticated user
     * 
     * Status 405
     * 
     * @return void
     */
    public function get_request_shows_error_for_authenticated_user(): void
    {
        $response = $this->actingAs($this->user)->get(route('category.update', $this->category));

        $response->assertStatus(405)
            ->assertSee('The GET method is not supported for this route. Supported methods: PUT.');
    }

    /**
     * @test
     * 
     * @covers CategoryController::update()
     * 
     * Get request method will show error message for unauthenticated user
     * 
     * Status 405
     * 
     * @return void
     */
    public function get_request_shows_error_for_unauthenticated_user(): void
    {
        $response = $this->get(route('category.update', $this->category));

        $response->assertStatus(405)
            ->assertSee('The GET method is not supported for this route. Supported methods: PUT.');
    }

    /**
     * @test
     * 
     * @covers CategoryController::update()
     * 
     * Redirect to category index page with flash message for successful update
     * 
     * Status 302
     * 
     * @return void
     */
    public function redirect_to_category_index_with_flash_message(): void
    {
        $update_category = [
            'title' => $this->category->title,
            'description' => 'Update this descriptions changed'
        ];

        $response = $this->actingAs($this->user)->put(route('category.update', $this->category), $update_category);

        $response->assertStatus(302)
            ->assertRedirect(route('category.index'))
            ->assertSessionHas('update');

        $this->assertDatabaseHas('categories', ['description' => 'Update this descriptions changed']);
    }


    /**
     * @test 
     * 
     * @covers CategoryController::update()
     * 
     * @dataProvider updateValidation
     * 
     * Show validation error message for invalid input
     * 
     * Status 302
     * 
     * @param $userInput,$field 
     */
    public function validate_category_update_request($userInput, $field): void
    {
        $response = $this->actingAs($this->user)
            ->put(route('category.update', $this->category), $userInput);

        $response->assertStatus(302)
                 ->assertSessionHasErrors($field);
    }

    /**
     * @test
     * 
     * @covers CategoryController::update()
     * 
     * Show unique field validation error for title field
     * 
     * Status 302
     * 
     * @return void
     */
    public function title_must_be_unique(): void
    {
        $newCategory = Category::factory()->create();
        $response = $this->actingAs($this->user)->put(route('category.update',$this->category),[
            'title' => $newCategory->title,
            'description' => 'Check Unique Validation for this category'
        ]);

        $response->assertStatus(302)
                 ->assertSessionHasErrors('title');
    }

    /**
     * Validation test for update method of category
     * 
     * @return array
     */
    public function updateValidation(): array
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
