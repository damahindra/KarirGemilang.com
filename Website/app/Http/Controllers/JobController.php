<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function getAllJobs()
    {
        $jobs = Job::all();
        return response()->json($jobs);
    }

    public function getJob($id)
    {
        $job = Job::where('job_id', $id)->get();
        return response()->json($job);
    }

    public function store(Request $request)
    {
        Job::create($request->all());
        return redirect()->route('jobs.index');
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $job->update($request->all());
        return redirect()->route('jobs.index');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index');
    }
}
