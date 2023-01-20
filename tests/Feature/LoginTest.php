<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_view_load()
    {
        $response = $this->get('/login');
        // dd($response->getContent());
        $response->assertStatus(200)
            ->assertSeeText('Login')
            ->assertViewIs('auth.login');
    }

    // public function test_user_login_with_email_and_password(): void
    // {
    //     // create user
    //     $user = User::factory()->create();

    //     // login
    //     $this->actingAs($user)->post('login', [
    //         'email' => $user->email,
    //         'password' => 'password'
    //     ])->assertRedirect('/dashboard');
    // }

    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(302); //Everything is OK. That means that route to which successful login should be redirected has been found.
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }
    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post('/logout');
        $this->assertGuest();
    }

}
