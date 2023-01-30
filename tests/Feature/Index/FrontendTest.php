<?php

namespace Tests\Feature\Index;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;


class FrontendTest extends TestCase
{
    use RefreshDatabase;
    private $categories;
    private $posts;

    /**
     * Initial Setup
     * 
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->categories = Category::factory()->count(5)->create();
        $this->posts = Post::factory()->count(5)->create();
    }

    /**
     * @test
     * 
     * @Covers IndexController::showFrontend
     * 
     * @return void
     */
    public function anyone_can_view_ShowFrontend(): void
    {
        $response = $this->assertGuest()->get('/')->assertStatus(200);
        $response->assertViewIs('home')
            ->assertViewHas(['posts', 'categories']);
            
            $allPost = Post::all();
        
            foreach($allPost as $post){
                if(Storage::exists('public/images/'.$post->image)){
                    Storage::delete('public/images/'.$post->image);
                }
        }

   
    }

    /**
     * @test
     * 
     * @Covers IndexController::getCategory
     * 
     * @return void
     */
    public function get_category_id(): void
    {
        $cat = Category::first();
        $c = Category::all();
        $post = Post::first();

        $response = $this->assertGuest()->get('home/categories/' . $cat->id)->assertStatus(200);
        $response->assertViewIs('home')->assertViewHasAll(
            [
                'posts',
                'categories',
                'cat'
            ]
        );
        
        $allPost = Post::all();

        foreach($allPost as $post){
            if(Storage::exists('public/images/'.$post->image)){
                Storage::delete('public/images/'.$post->image);
            }
    }
    }

    /**
     * @test
     * 
     * @Covers IndexController::singlePostshow()
     * 
     * @return void
     */
    public function view_single_post()
    {
        $posts = Post::factory()->create();


        $response = $this->get(route('page', $posts->id));
        $response->assertStatus(200)
            ->assertViewIs('page')
            ->assertViewHasAll([
                'posts' => $posts,
            ]);
     
            $allPost = Post::all();

            foreach($allPost as $post){
                if(Storage::exists('public/images/'.$post->image)){
                    Storage::delete('public/images/'.$post->image);
                }
        }
        }

}
