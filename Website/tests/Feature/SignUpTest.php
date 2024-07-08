<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SignUpTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the signup process.
     */
    public function test_user_can_sign_up(): void
    {
        // Debugging output
        dump('Starting test_user_can_sign_up');

        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Debugging output
        dump('Response status: ' . $response->status());

        $response->assertStatus(302); // Assuming the user is redirected after signup
        $response->assertRedirect('/home'); // Assuming the user is redirected to /home after signup

        // Debugging output
        dump('Checking database for new user');

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);

        // Debugging output
        dump('Test completed successfully');
    }
}
