<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function getApplicationsByJobId($id)
    {
        $applications = Application::where('job_id', $id)->get();
        return response()->json(['Applications' => $applications], 200);
    }

    public function create(Request $request)
    {
        
        return view('applications.create');
    }

    public function getApplication($job_id, $application_id)
    {
        $application = Job::find($job_id)->application()->where('application_id', $application_id)->first();
        return response()->json(["Application", $application], 200);
    }
}
