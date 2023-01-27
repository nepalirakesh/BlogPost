<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    /**
     * Initial Setup
     * 
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
     * @covers AuthenticatesUsers::showLoginForm()
     * 
     * Unauthenticated users are redirected to login page
     * 
     * Status 302
     * 
     * @return void
     */
    public function redirect_to_login_page(): void
    {
        $response = $this->get(('/dashboard'));

        $response->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * 
     * Authenticated user are redirect to dashboard if tried to access login page
     * 
     * Status 302
     * 
     * @return void
     */
    public function redirect_to_dashboard(): void
    {
        $response = $this->actingAs($this->user)->get(route('login'));

        $response->assertStatus(302)
            ->assertRedirect('/dashboard');
    }

    /**
     * @test
     *
     *  User cannot login with incorrect credentials
     * 
     * Status 302
     * 
     * @return void
     */
    public function user_cannot_login_with_incorrect_credentials(): void
    {
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'passord' => 'abcd321444',
        ]);

        $response->assertStatus(302)
                 ->assertSessionHasErrors('password');
    }

    /**
     * @test
     * 
     * Authenicated user is redirected to home if logout successfully
     * 
     * Status 302
     * 
     * @return void
     */
    public function authenticated_user_redirected_to_home_if_logout(): void
    {
        $response = $this->actingAs($this->user)->post(route('logout'));
        $response->assertStatus(302)
                 ->assertRedirect(route('home'));
    }
}
