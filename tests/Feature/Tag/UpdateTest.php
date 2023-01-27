<?php

namespace Tests\Feature\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;
use App\Models\Tag;
use App\Models\User;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @group tagcontroller
     * @covers TagController::update()
     * Summary of a_logged_in_user_can_update_tag
     * @return void
     */

    public function a_logged_in_user_can_update_tag()
    {
        // create user
        $user = User::factory()->create();

        // login user
        $response = $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->assertAuthenticated();

        // create a tag
        $response = $this->from(route('tag.create'))
            ->post(route('tag.store'), [
                'title' => 'test title',
                'description' => 'test description'
            ]);

        // update tag
        $tag = Tag::first();

        $response = $this->put(route('tag.update', $tag->id), [
            'title' => 'test title updated',
            'description' => 'test description updated'
        ]);
        // dd($response);

        $updated_tag = Tag::first();

        //check updated tag value

        $this->assertEquals('test title updated', $updated_tag->title);
        $this->assertEquals('test description updated', $updated_tag->description);
        $this->assertModelExists($updated_tag);

    }
}
