<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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

        // update number of total applicants in job
        $job = Job::find((int)$job_id);
        $job->total_applicants += 1;
        $job->save();

        // Return a response
        return response()->json(['message' => 'Application submitted successfully.', 'application' => $application], 201);
    }

    public function download(Request $request, $job_id, $application_id)
    {
        $application = Application::find($application_id);
        $user = User::find($application->user_id);
        $filePath = 'public/'.$application->resume_path; // Path file yang ingin diunduh
        $fileName = 'Resume-'.$user->fullname.'-'.$application->application_date.'.pdf'; // Nama file yang diunduh

        // Cek apakah file ada di storage
        if (Storage::exists($filePath)) {
            Storage::download($filePath, $fileName);
            return response()->json(['Message' => "File downloaded successfully."], 200);
        } else {
            return response()->json(["Message" => "File not found."], 404);
        }
    }
}
