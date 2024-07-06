<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_companies()
    {
        $companies = Company::factory()->count(3)->create();
        
        $response = $this->get(route('companies.index'));

        $response->assertStatus(200);
        $response->assertViewHas('companies', function ($viewCompanies) use ($companies) {
            return $viewCompanies->count() === $companies->count();
        });
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('companies.create'));

        $response->assertStatus(200);
    }

    public function test_store_saves_new_company()
    {
        $companyData = [
            'company_name' => 'Test Company',
            'company_city' => 'Test City',
            'company_country' => 'Test Country',
            'company_benefits' => 'Test Benefits',
            'company_industry' => 'Test Industry',
            'company_description' => 'Test Description',
        ];

        $response = $this->post(route('companies.store'), $companyData);

        $response->assertRedirect(route('companies.index'));
        $this->assertDatabaseHas('companies', $companyData);
    }

    public function test_destroy_deletes_company()
    {
        $company = Company::factory()->create();

        $response = $this->delete(route('companies.destroy', $company));

        $response->assertRedirect(route('companies.index'));
        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}
