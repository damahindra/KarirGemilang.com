<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class JobController extends Controller
{
    public function getAllJobs()
    {
        $jobs = Job::all();
        $jobsWithSelectedFields = $jobs->map(function($job) {
            return [
                'job_id' => $job->job_id,
                'job_title' => $job->job_title,
                'location_type' => $job->location_type,
                'job_location' => $job->job_location,
                'apply_before' => $job->apply_before,
                'exp_level' => $job->exp_level,
                'company_name' => Company::find(Employer::find($job->employer_id)->company_id)->company_name
            ];
        });
        return response()->json(["Message" => "Job retrieved successfully", "Jobs" => $jobsWithSelectedFields], 200);
    }

    public function getJob($id)
    {
        $job = Job::find($id);
        $employer = Employer::find($job->employer_id);
        $company = Company::find($employer->company_id);
        return response()->json(["Message" => "Job retrieved successfully", 
                                 "Job" => $job,
                                 "Employer" => $employer,
                                 "Company" => $company], 200);
    }

    public function destroy($id)
    {
        // Find the job by its ID
        $job = Job::find($id);

        if ($job) {
            // Delete the job
            $job->delete();

            // Return a response (you can customize this)
            return response()->json(['message' => 'Job deleted successfully.'], 200);
        }
        return response()->json(['message' => 'Job not found.'], 404);
        
    }
    public function create(Request $request, $id)
    {
        // Periksa apakah pengguna sudah login
        // if (!Auth::check()) {
        //     return response()->json(['message' => 'Please sign in to create job'], 400);
        // }

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
        // $employer_id = Auth::user()->employer_id;

        // Buat pekerjaan baru menggunakan metode create
        $job = Job::create([
            'job_title' => $validatedData['job_title'],
            'job_description' => $validatedData['job_description'],
            'prerequisites' => $validatedData['prerequisites'],
            'job_location' => $validatedData['job_location'],
            'location_type' => $validatedData['location_type'],
            'exp_level' => $validatedData['exp_level'],
            'apply_before' => $validatedData['apply_before'],
            'employer_id' => $id, // Isi dengan ID employer yang sedang login
        ]);

        // Kembalikan respon
        return response()->json(['message' => 'Job created successfully', 'Job' => $job], 201);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'job_title' => 'string|max:255',
            'job_description' => 'string',
            'prerequisites' => 'string',
            'job_location' => 'string|max:255',
            'location_type' => 'string|max:255',
            'exp_level' => 'string|max:255',
            'apply_before' => 'date'
        ]);

        // Cari pekerjaan berdasarkan ID
        $job = Job::find($id);

        // Cek apakah pekerjaan ditemukan
        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        // Perbarui data pekerjaan
        if (isset($validatedData['job_title'])) {
            $job->job_title = $validatedData['job_title'];
        }
        if (isset($validatedData['job_description'])) {
            $job->job_description = $validatedData['job_description'];
        }
        if (isset($validatedData['prerequisites'])) {
            $job->prerequisites = $validatedData['prerequisites'];
        }
        if (isset($validatedData['job_location'])) {
            $job->job_location = $validatedData['job_location'];
        }
        if (isset($validatedData['location_type'])) {
            $job->location_type = $validatedData['location_type'];
        }
        if (isset($validatedData['exp_level'])) {
            $job->exp_level = $validatedData['exp_level'];
        }
        if (isset($validatedData['apply_before'])) {
            $job->apply_before = $validatedData['apply_before'];
        }

        // Simpan perubahan
        $job->save();

        // Kembalikan respon
        return response()->json(['message' => 'Job updated successfully', 'Job' => $job], 200);
    }
}
