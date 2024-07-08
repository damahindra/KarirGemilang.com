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
        $job = Job::where("job_id", $id);

        if ($job) {
            // Delete the job
            $job->delete();

            // Return a response (you can customize this)
            return response()->json(['message' => 'Job deleted successfully.'], 200);
        }
        return response()->json(['message' => 'Job not found.'], 404);
        
    }
    public function create(Request $request)
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must be logged in to create a job.');
        }

        // Validasi input
        $validatedData = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
            'prerequisites' => 'required|string',
            'job_location' => 'required|string|max:255',
            'location_type' => 'required|string|max:255',
            'exp_level' => 'required|string|max:255',
            'apply_before' => 'required|date'
        ]);

        // Dapatkan ID employer yang sedang login
        $employer_id = Auth::user()->employer_id;

        // Buat pekerjaan baru menggunakan metode create
        $job = Job::create([
            'job_title' => $validatedData['job_title'],
            'job_description' => $validatedData['job_description'],
            'prerequisites' => $validatedData['prerequisites'],
            'job_location' => $validatedData['job_location'],
            'location_type' => $validatedData['location_type'],
            'exp_level' => $validatedData['exp_level'],
            'apply_before' => $validatedData['apply_before'],
            'employer_id' => $employer_id, // Isi dengan ID employer yang sedang login
        ]);

        // Kembalikan respon
        return response()->json(['message' => 'Job created successfully', 'Job' => $job], 201);
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
            'prerequisites' => 'required|string',
            'job_location' => 'required|string|max:255',
            'location_type' => 'required|string|max:255',
            'exp_level' => 'required|string|max:255',
            'apply_before' => 'required|date'
        ]);

        // Cari pekerjaan berdasarkan ID
        $job = Job::where("job_id", $id);

        // Perbarui data pekerjaan
        if (isset($validatedData['job_title'])) {
            $job->job_title = $validatedData['job_title'];
        }
        if (isset($validatedData['job_description'])) {
            $job->job_description = $validatedData['job_description'];
        }
        if (isset($validatedData['job_requirements'])) {
            $job->job_requirements = $validatedData['job_requirements'];
        }
        if (isset($validatedData['salary'])) {
            $job->salary = $validatedData['salary'];
        }

        // Simpan perubahan
        $job->save();

        // Kembalikan respon
        return response()->json(['message' => 'Job updated successfully', 'Job' => $job], 200);
    }
}
