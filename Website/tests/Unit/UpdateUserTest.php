<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test user sign up functionality.
     *
     * @return void
     */
    public function test_user_can_update()
    {
        // Data yang diperlukan untuk pendaftaran
        $user = User::factory()->create();

        $userData = [
            'fullname' => 'Rangga Andhito Damahindra'
        ];

        // Melakukan permintaan POST ke endpoint pendaftaran
        $response = $this->put("/user/{$user->user_id}", $userData);

        // Memeriksa bahwa respons memiliki status HTTP 201 Created
        $response->assertStatus(200);

        // Anda juga dapat memeriksa pengalihan atau respons lain yang diharapkan
        // Misalnya, pengalihan ke halaman setelah pendaftaran (jika ada)
        // $response->assertRedirect('/home');

        // Debugging output
        dump('Response status: ' . $response->status());

        // Memeriksa database untuk pengguna baru
        dump('Checking database for new user');
        $this->assertDatabaseHas('users', ['user_id' => $user->user_id, 'fullname' => $userData['fullname']]);
    }
}
