<?php

namespace Tests\Feature\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;
use App\Models\Tag;
use App\Models\User;

class CreateTest extends TestCase
{
    /**
     * @test
     * Summary of a_logged_in_user_can_view_create_form
     * @return void
     */

    public function a_logged_in_user_can_view_create_form()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('tag/create');
        $response->assertStatus(200)
            ->assertViewIs('blog.tag.create')
            ->assertSeeInOrder(['Title', 'Description']);



    }


}
