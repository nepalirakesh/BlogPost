<?php

namespace Tests\Feature\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tag;
use Faker\Factory as Faker;

class StoreTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * @test
     * @covers TagController::create()
     *
     * Summary of tagcontroller_tag_can_be_create
     * @return void
     */
    public function tagcontroller_tag_can_be_create()
    {
        $faker = Faker::create();

        $tag = new Tag([
            'title' => $faker->word,
            'description' => $faker->sentence()

        ]);
        $this->assertTrue($tag->save());

        $saveTag = Tag::find($tag->id);
        $this->assertEquals($tag->title, $saveTag->title);
        $this->assertEquals($tag->description, $saveTag->description);
    }

    // OR

    /**
     * @test
     * @covers TagController::store()
     *
     * Summary of a_logged_in_user_can_create_a_new_tag
     * @return void
     */
    public function a_logged_in_user_can_create_a_new_tag()
    {
        $faker = Faker::create();
        $user = User::factory()->create();


        $tag = [
            'title' => 'tag title',
            'description' => 'tag description',
        ];

        $response = $this->actingAs($user)->post(route('tag.store'), $tag)
            ->assertStatus(302)->assertRedirect(route('tag.index'))
            ->assertSessionHas('success', 'Tag created successfully.');

        $saved_tag = Tag::first();
        // check saved value
        $this->assertEquals('tag title', $saved_tag->title);
        $this->assertEquals('tag description', $saved_tag->description);


    }

    /**
     * @test
     * @dataProvider tag_data_provider
     * @covers TagController::store()
     * Summary of tag_validation
     * @param array $data
     * @param bool $expected
     * @return void
     */
    public function tag_validation(array $data, bool $expected)
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('tag.store'), $data);

        if ($expected) {
            $response->assertSessionHasNoErrors();
            // dd($response->getStatusCode());
            $response->assertStatus(302);
            $this->assertDatabaseHas('tags', $data);
        } else {
            $response->assertSessionHasErrors();
            $response->assertStatus(302);
        }


    }
    public function tag_data_provider()
    {
        return [
            'valid data' => [['title' => 'Test', 'description' => 'Test description'], true],
            'invalid data - null title' => [['title' => '', 'description' => 'Test description'], false],
            'invalid data - description too short' => [['title' => 'Title', 'description' => 'Test'], false],
            'invalid data - title unique' => [['title' => 'Title', 'description' => 'Test'], false],
        ];

    }

}
