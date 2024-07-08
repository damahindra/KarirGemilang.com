<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAllJobTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test for guests (users who are not logged in).
     */
    public function test_guest_can_view_all_jobs(): void
    {
        $response = $this->get('/jobs'); // ganti '/jobs' dengan endpoint yang sesuai

        $response->assertStatus(200);
        //$response->assertSee('Jobs'); // ganti 'Jobs' dengan teks atau elemen yang diharapkan muncul di halaman
    }

    /**
     * Test for authenticated users.
     */
    public function test_authenticated_user_can_view_all_jobs(): void
    {
        // Create a new user instance
        $user = new User();
        $user->fullname = 'Nama Pengguna';
        $user->email = 'contoh@email.com';
        $user->password = bcrypt('password');
        $user->phone_number = '123456789101';
        $user->birthdate = '2002-12-01';
        $user->last_education = 'High School';
        $user->save();

        // Authenticate as the created user
        $response = $this->actingAs($user)->get('/jobs'); // replace '/jobs' with the actual endpoint

        $response->assertStatus(200);
        //$response->assertSee('Jobs'); // uncomment and adjust as needed
    }
}