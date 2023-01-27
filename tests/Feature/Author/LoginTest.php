<?php

namespace Tests\Feature\Author;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    private $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * @test
     * @Cover Login
     * @return void
     */
    public function user_must_login_to_view_index(): void
    {
        $response = $this->post('login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(302); //Everything is OK. That means that route to which successful login should be redirected has been found.
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($this->user);

        $response = $this->actingAs($this->user)->get('author');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @covers login failed when incorrrect email and password
     * @return void
     * 
     */
    public function user_login_failed(): void
    {
        $response = $this->post('login', [
            'email' => 'asdjashdjkasdj@gmail.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302)->assertSessionHasErrors('email', 'password');
    }




    /**
     * @test
     * @return void
     * 
     */
    public function user_can_logout(): void
    {

        $this->actingAs($this->user)->post('/logout');
        $this->assertGuest();
    }
}
