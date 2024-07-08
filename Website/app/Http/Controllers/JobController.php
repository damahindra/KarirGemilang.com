<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function getAllJobs()
    {
        $jobs = Job::all();
        return response()->json(["Message" => "Job retrieved successfully", "Jobs" => $jobs], 200);
    }

    public function getJob($id)
    {
        $job = Job::where('job_id', $id)->get();
        return response()->json(["Message" => "Job retrieved successfully", "Job" => $job], 200);
    }

    public function destroy($id)
    {
        // Find the job by its ID
        $job = Job::findOrFail($id);

        // Delete the job
        $job->delete();

        // Return a response (you can customize this)
        return response()->json(['message' => 'Job deleted successfully.'], 200);
    }
}
