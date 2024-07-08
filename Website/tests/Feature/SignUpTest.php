<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignUpTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test user sign up functionality.
     *
     * @return void
     */
    public function test_user_can_sign_up()
    {
        // Data yang diperlukan untuk pendaftaran
        $userData = [
            'fullname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => '123456789101',
            'birthdate' => '2002-12-01',
            'password' => 'password123', // Sesuaikan dengan kebutuhan Anda
        ];

        // Melakukan permintaan POST ke endpoint pendaftaran
        $response = $this->post('/user/signup', $userData);

        // Memeriksa bahwa respons memiliki status HTTP 201 Created
        $response->assertStatus(201);

        // Anda juga dapat memeriksa pengalihan atau respons lain yang diharapkan
        // Misalnya, pengalihan ke halaman setelah pendaftaran (jika ada)
        // $response->assertRedirect('/home');

        // Debugging output
        dump('Response status: ' . $response->status());

        // Memeriksa database untuk pengguna baru
        dump('Checking database for new user');
        $this->assertDatabaseHas('users', ['email' => $userData['email']]);
    }
}
