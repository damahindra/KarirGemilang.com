<?php

namespace Tests\Feature;

use App\Models\Employer;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_employers()
    {
        $employers = Employer::factory()->count(3)->create();
        
        $response = $this->get(route('employers.index'));

        $response->assertStatus(200);
        $response->assertViewHas('employers', function ($viewEmployers) use ($employers) {
            return $viewEmployers->count() === $employers->count();
        });
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('employers.create'));

        $response->assertStatus(200);
    }

    public function test_store_saves_new_employer()
    {
        $company = Company::factory()->create();
        $employerData = [
            'fullname' => 'Test Employer',
            'email' => 'test@example.com',
            'password' => 'password',
            'phone_number' => '1234567890',
            'birthdate' => '1990-01-01',
            'position' => 'Manager',
            'company_id' => $company->id,
        ];

        $response = $this->post(route('employers.store'), $employerData);

        $response->assertRedirect(route('employers.index'));
        $this->assertDatabaseHas('employers', [
            'fullname' => 'Test Employer',
            'email' => 'test@example.com',
        ]);
    }

    public function test_destroy_deletes_employer()
    {
        $employer = Employer::factory()->create();

        $response = $this->delete(route('employers.destroy', $employer));

        $response->assertRedirect(route('employers.index'));
        $this->assertDatabaseMissing('employers', ['id' => $employer->id]);
    }
}
