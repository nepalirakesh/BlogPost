<?php

namespace Tests\Feature\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tag;

class EditTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $tag;
    /**
     * Initial Setup
     * Summary of setUp
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->tag = Tag::factory()->create();
    }
    /**
     * @test
     *
     * Summary of guest_user_can_not_view_edit_form
     * @return void
     */
    public function guest_user_can_not_view_edit_form()
    {
        $response = $this->get(route('tag.edit', $this->tag->id));

        $response->assertStatus(302)
            ->assertRedirect(route('login'));
    }


    /**
     * @test
     *
     * @group tagcontroller
     *
     * A basic feature test example.
     *
     * @return void
     */
    public function a_logged_in_user_can_view_edit_form()
    {
        $response = $this->actingAs($this->user)->get(route('tag.edit', $this->tag->id));

        $response->assertStatus(200)->assertViewIs('blog.tag.edit')
            ->assertViewHas('tag')
            ->assertSee(['Title', 'Update']);
    }
}
