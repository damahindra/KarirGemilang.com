<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApplicationController extends Controller
{
    public function getApplicationsByJobId($id)
    {
        $applications = Application::where('job_id', $id)->get();
        return response()->json(['Applications' => $applications], 200);
    }

    public function create(Request $request, $job_id)
    {
        
        // Validate the incoming request
        $request->validate([
            'resume_path' => 'required|file|mimes:pdf', // Ensure the file is a PDF and max size is 2MB
        ]);

        // Get the authenticated user
        // $user = Auth::user();
        // $user_id = $user->user_id;
        $user_id = 2;

        // Handle the file upload
        if ($request->hasFile('resume_path')) {
            $resumePath = $request->file('resume_path')->store('resumes', 'public');
        } else {
            return response()->json(['message' => 'Resume file is required'], 400);
        }

        // Create the application
        $application = Application::create([
            'job_id' => (int)$job_id,
            'user_id' => $user_id,
            'application_date' => now(),
            'resume_path' => $resumePath
        ]);

        // Return a response
        return response()->json(['message' => 'Application submitted successfully.', 'application' => $application], 201);
    }

    public function getApplication($job_id, $application_id)
    {
        $application = Job::find($job_id)->application()->where('application_id', $application_id)->first();
        return response()->json(["Application", $application], 200);
    }
}
