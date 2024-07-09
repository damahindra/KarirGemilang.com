<?php

namespace Tests\Unit;

use App\Models\Employer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployerSignupTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic unit test example.
     */
    public function test_employer_can_signup(): void
    {
        // Data yang diperlukan untuk pendaftaran
        $employer = [
            'fullname' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => 'password123', // Example password hashing
            'phone_number' => $this->faker->phoneNumber,
            'birthdate' => '2003-11-09', // Example birthdate within the last 20 years
            'position' => $this->faker->jobTitle,
            'company_name' => $this->faker->company,
            'company_city' => $this->faker->city,
            'company_country' => $this->faker->country,
            'company_benefits' => $this->faker->sentence,
            'company_industry' => $this->faker->word,
            'company_description' => $this->faker->paragraph,
        ];

        // Melakukan permintaan POST ke endpoint pendaftaran
        $response = $this->post('/employer/signup', $employer);

        // Memeriksa bahwa respons memiliki status HTTP 201 Created
        $response->assertStatus(201);
    }
}
