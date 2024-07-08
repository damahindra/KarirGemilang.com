<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Carbon\Carbon;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the CV submission process.
     */
    public function test_user_can_submit_cv(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $job = Job::factory()->create();

        $cv = UploadedFile::fake()->create('cv.pdf', 100);

        $response = $this->actingAs($user)->post('/applications', [
            'user_id' => $user->id,
            'job_id' => $job->id,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'cv' => $cv,
            'status' => 'submitted',
        ]);

        $response->assertStatus(302); // Assuming the user is redirected after submitting the CV
        $response->assertRedirect('/applications'); // Assuming the user is redirected to the applications page

        // Verify the file was stored
        Storage::disk('public')->assertExists('cvs/' . $cv->hashName());

        // Verify the application record was created in the database
        $this->assertDatabaseHas('applications', [
            'user_id' => $user->id,
            'job_id' => $job->id,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'cv' => 'cvs/' . $cv->hashName(),
            'status' => 'submitted',
        ]);
    }
}
