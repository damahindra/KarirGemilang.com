<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Faker;


class GetJobTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test for guests (users who are not logged in) can view a job by ID.
     */
    public function test_guest_can_view_job_by_id(): void
    {
        // Create a job using factory or directly

        $job = Job::factory()->create([
            'job_title' => '$this->faker->jobTitle',
            'job_description' => '$this->faker->paragraph',
            'prerequisites' => '$this->faker->paragraph',
            'job_location' => '$this->faker->word',
            'location_type' => '$this->faker->state',
            'exp_level' => '$this->faker->word',
            'apply_before' => '$this->faker->date'
            // Add more attributes as needed
        ]);

        // Perform a GET request to the job's URL
        $response = $this->get('/jobs' . $job->id);

        // Assert that the response status is 200
        $response->assertStatus(200);
        // Assert that the response contains the job's title
        $response->assertSee($job->job_title);
        $response->assertSee($job->job_description);
        $response->assertSee($job->prerequisites);
        $response->assertSee($job->job_location);
        $response->assertSee($job->location_type);
        $response->assertSee($job->exp_level);
        $response->assertSee($job->apply_before);
    }

    /**
     * Test for authenticated users can view a job by ID.
     */
    public function test_authenticated_user_can_view_job_by_id(): void
    {
        // Create a user and a job using factories
        $user = User::factory()->create();
        $job = Job::factory()->create();

        // Perform a GET request to the job's URL while authenticated as the user
        $response = $this->actingAs($user)->get('/jobs' . $job->id);

        // Assert that the response status is 200
        $response->assertStatus(200);
        // Assert that the response contains the job's title
        $response->assertSee($job);
    }
}
