<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_users()
    {
        $users = User::factory()->count(3)->create();
        
        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertViewHas('users', function ($viewUsers) use ($users) {
            return $viewUsers->count() === $users->count();
        });
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('users.create'));

        $response->assertStatus(200);
    }

    public function test_store_saves_new_user()
    {
        $userData = [
            'fullname' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'phone_number' => '1234567890',
            'birthdate' => '1990-01-01',
            'last_education' => 'Bachelor',
        ];

        $response = $this->post(route('users.store'), $userData);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'fullname' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    public function test_destroy_deletes_user()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', $user));

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
