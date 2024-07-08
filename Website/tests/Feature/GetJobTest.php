<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetJobTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test for guests (users who are not logged in) can view a job by ID.
     */
    public function test_guest_can_view_job_by_id(): void
    {
        $job = Job::factory()->create();

        $response = $this->get('/jobs/' . $job->id);

        $response->assertStatus(200);
        $response->assertSee($job->title); // Assuming 'title' is a field in your 'jobs' table
    }

    /**
     * Test for authenticated users can view a job by ID.
     */
    public function test_authenticated_user_can_view_job_by_id(): void
    {
        $user = User::factory()->create();
        $job = Job::factory()->create();

        $response = $this->actingAs($user)->get('/jobs/' . $job->id);

        $response->assertStatus(200);
        $response->assertSee($job->title); // Assuming 'title' is a field in your 'jobs' table
    }
}
