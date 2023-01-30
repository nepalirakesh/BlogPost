<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Post;
use App\Models\Author;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @group  postcontroller
     *
     *@covers PostController::store()
     *
     * Summary of a_logged_in_user_can_create_and_store_post
     * @return void
     */


    public function a_logged_in_user_can_create_and_store_post()
    {
        $user = User::factory()->create();
        $author = Author::factory()->create();
        $category = Category::factory()->create();
        $tags = Tag::factory()->create();
        $file = UploadedFile::fake()->image('test.jpg');
        
        $data = [
            'author_id' => $author->id,
            'title' => 'Test Titleeerererewrrggjjgghhgghe',
            'description' => 'Test asdasdasdasdasdasdasdasdasdasd',
            'content' => 'Test ContenDescriptionDescriptionDescriptionsdfsdfsdsafsdfsdDescriptionDescriptiontContenDescriptionDescriptionDescriptionsdfsdfsdsafsdfsdDescriptionDescriptiont',
            'category_id' => $category->id,
            'tags' => $tags->pluck('id')->toArray(),
            'image' => $file
        ];
     
        $response = $this->actingAs($user)->post(route('post.store'), $data);
        $response->assertStatus(302);

        $post = Post::first();
        
        $response->assertRedirect(route('post.index'))
            ->assertSessionHas('success', 'post added successfully');
        
        $this->assertDatabaseHas('posts', [
            'author_id' => $author->id,
            'title' => 'Test Titleeerererewrrggjjgghhgghe',
            'description' => 'Test asdasdasdasdasdasdasdasdasdasd',
            'content' => 'Test ContenDescriptionDescriptionDescriptionsdfsdfsdsafsdfsdDescriptionDescriptiontContenDescriptionDescriptionDescriptionsdfsdfsdsafsdfsdDescriptionDescriptiont',
            'category_id' => $category->id,
            'image' => $post->image,
        ]);

        if(Storage::exists('public\images\test.jpg')){
            Storage::delete('public\images\test.jpg');
        }

    }
}
