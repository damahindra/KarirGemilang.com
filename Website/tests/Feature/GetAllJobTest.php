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
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/jobs'); // ganti '/jobs' dengan endpoint yang sesuai

        $response->assertStatus(200);
        //$response->assertSee('Jobs'); // ganti 'Jobs' dengan teks atau elemen yang diharapkan muncul di halaman
    }
}
