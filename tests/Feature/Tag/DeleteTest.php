<?php

namespace Tests\Feature\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tag;
use App\Models\User;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group tagcontroller
     *
     * @test
     *
     * Summary of a_login_user_can_delete_post
     *
     * @return void
     */

    public function a_login_user_can_delete_tag()
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
                'description' => 'test desupdateddd'
            ]);

        $tag = Tag::first();

        // delete post
        $response = $this->delete(route('tag.delete', $tag->id));
    }
}
