<?php

namespace Tests\Feature\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tag;
use App\Models\User;
use Faker\Factory as Faker;

class DeleteTest extends TestCase
{
    /**
     * @test
     * @covers TagController::destroy()
     *
     * Summary of tag_can_be_deleted
     * @return void
     */
    public function tag_can_be_deleted()
    {
        $faker = Faker::create();

        $tag = new Tag([
            'title' => $faker->word,
            'description' => $faker->sentence
        ]);
        $tag->save();

        // Delete the tag
        $this->assertTrue($tag->delete());

        // Test reading the deleted Tag by its ID
        $deletedTag = Tag::find($tag->id);
        $this->assertNull($deletedTag);

    }
    // OR
    /**
     * @test
     * Summary of a_login_user_can_delete_post
     * @return void
     */

    public function a_login_user_can_delete_post()
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
