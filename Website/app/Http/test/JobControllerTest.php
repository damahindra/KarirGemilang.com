<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\Employer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_jobs()
    {
        $jobs = Job::factory()->count(3)->create();
        
        $response = $this->get(route('jobs.index'));

        $response->assertStatus(200);
        $response->assertViewHas('jobs', function ($viewJobs) use ($jobs) {
            return $viewJobs->count() === $jobs->count();
        });
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('jobs.create'));

        $response->assertStatus(200);
    }

    public function test_store_saves_new_job()
    {
        $employer = Employer::factory()->create();
        $jobData = [
            'job_title' => 'Software Developer',
            'apply_before' => now()->addDays(30),
            'exp_level' => 'Junior',
            'job_description' => 'Develop software applications',
            'location_type' => 'Remote',
            'location' => 'Anywhere',
            'prerequisites' => 'Programming skills',
            'total_applicants' => 0,
            'employer_id' => $employer->id,
        ];

        $response = $this->post(route('jobs.store'), $jobData);

        $response->assertRedirect(route('jobs.index'));
        $this->assertDatabaseHas('jobs', $jobData);
    }

    public function test_destroy_deletes_job()
    {
        $job = Job::factory()->create();

        $response = $this->delete(route('jobs.destroy', $job));

        $response->assertRedirect(route('jobs.index'));
        $this->assertDatabaseMissing('jobs', ['id' => $job->id]);
    }
}
