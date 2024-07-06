<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_applications()
    {
        $applications = Application::factory()->count(3)->create();
        
        $response = $this->get(route('applications.index'));

        $response->assertStatus(200);
        $response->assertViewHas('applications', function ($viewApplications) use ($applications) {
            return $viewApplications->count() === $applications->count();
        });
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('applications.create'));

        $response->assertStatus(200);
    }

    public function test_store_saves_new_application()
    {
        $user = User::factory()->create();
        $applicationData = [
            'application_date' => now(),
            'application_status' => 'pending',
            'user_resume' => 'resume.pdf',
            'user_id' => $user->id,
        ];

        $response = $this->post(route('applications.store'), $applicationData);

        $response->assertRedirect(route('applications.index'));
        $this->assertDatabaseHas('applications', $applicationData);
    }

    public function test_destroy_deletes_application()
    {
        $application = Application::factory()->create();

        $response = $this->delete(route('applications.destroy', $application));

        $response->assertRedirect(route('applications.index'));
        $this->assertDatabaseMissing('applications', ['id' => $application->id]);
    }
}
