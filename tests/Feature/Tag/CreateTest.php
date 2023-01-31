<?php

namespace Tests\Feature\Tag;

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
     * Summary of setUp
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    /**
     * @test
     *
     * Summary of unauthenticated_user_can_not_view_tag_create_form
     * @return void
     */
    public function unauthenticated_user_can_not_view_tag_create_form()
    {
        $response = $this->get('tag/create');
        $response->assertStatus(302)
            ->assertRedirect(route('login'));
    }
    /**
     * @test
     *
     * @group tagcontroller
     *
     * Summary of a_logged_in_user_can_view_create_form
     *
     * @return void
     */

    public function a_logged_in_user_can_view_create_form()
    {
        $response = $this->actingAs($this->user)->get('tag/create');
        $response->assertStatus(200)
            ->assertViewIs('blog.tag.create')
            ->assertSeeInOrder(['Title', 'Description']);
    }

}
