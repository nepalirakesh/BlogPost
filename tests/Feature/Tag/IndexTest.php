<?php

namespace Tests\Feature\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;
use App\Models\Tag;
use App\Models\User;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    /**
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
     * Summary of if_user_is_not_logined_redirect_to_login_page
     *
     * @return void
     */
    public function if_user_is_not_logined_redirect_to_login_page()
    {
        $response = $this->get('/tag')
            ->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * @test
     *
     * @covers TagController::index()
     *
     * Summary of it_can_show_tag_with_required_data
     *
     * @return void
     */
    public function it_can_show_tag_with_required_data()
    {
        $this->actingAs($this->user);
        $url = "/tag";

        $this->get($url)
            ->assertStatus(200)
            ->assertViewIs('blog.tag.index');
    }


    /**
     * @test
     *
     * @covers TagController::index()
     *
     * Summary of test_case_for_tag_read
     *
     * @return void
     */
    public function case_for_reading_tag()
    {
        $faker = Faker::create();
        $tag = new Tag([
            'title' => $faker->word,
            'description' => $faker->sentence()
        ]);

        $tag->save();

        $readTag = Tag::find($tag->id);
        $this->assertEquals($tag->title, $readTag->title);
        $this->assertEquals($tag->description, $readTag->description);

        $readTag = Tag::where('title', $tag->title)->first()
        ;
        $this->assertEquals($tag->id, $readTag->id);
        $this->assertEquals($tag->description, $readTag->description);

    }

    /**
     * @test
     *
     * @group tagcontroller
     *
     * Summary of check_tags_table
     *
     * @return void
     */
    public function check_existance_of_tag_model()
    {
        $tag = Tag::factory()->create();

        // Assert that a given model exists in the database:
        $this->assertModelExists($tag)
                // ->assertDatabaseCount('tags', 1)
            ->assertDatabaseHas('tags', [
                'title' => $tag->title
            ]);
    }

}
