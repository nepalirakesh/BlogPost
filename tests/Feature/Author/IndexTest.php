<?php

namespace Tests\Feature\Author;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * login route check
     *
     * @return void
     */
    public function test_login_view()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_login_with_email_and_password()
    {
        $user = UserFactory::factory()->create();
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
    }
}
