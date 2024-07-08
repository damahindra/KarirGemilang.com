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
            'title' => '$this->faker->sentence',
            'description' => '$this->faker->paragraph',
            // Add more attributes as needed
        ]);

        // Perform a GET request to the job's URL
        $response = $this->get('/jobs' . $job->id);

        // Assert that the response status is 200
        $response->assertStatus(200);
        // Assert that the response contains the job's title
        $response->assertSee($job->job_title);
        $response->assertSee($job->description);
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
        $response->assertSee($job->job_title);
    }
}
