<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    public function getEmployer($id)
    {
        $employer = Employer::find($id);
        return response()->json(["message" => "Retrieving Employer Successful", "Employer" => $employer], 200);
    }

    public function create(Request $request)
    {
         // Validate the incoming request
         $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:employers,email',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:20',
            'birthdate' => 'required|date',
            'position' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_city' => 'required|string|max:255',
            'company_country' => 'required|string|max:100',
            'company_benefits' => 'required|string',
            'company_industry' => 'required|string|max:100',
            'company_description' => 'required|string'
        ]);

        // Create the company
        $company = Company::create([
            'company_name' => $request->company_name,
            'company_city' => $request->company_city,
            'company_country' => $request->company_country,
            'company_benefits' => $request->company_benefits,
            'company_industry' => $request->company_industry,
            'company_description' => $request->company_description
        ]);

        $company_id = $company->company_id;

        // Create the employer
        $employer = Employer::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'birthdate' => $request->birthdate,
            'company_id' => $company_id // Set the company ID
        ]);

        // Return a response (you can customize this)
        return response()->json(['message' => 'Employer registered successfully.', 'employer' => $employer], 201);
    }

    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('employer')->attempt($credentials)) {
            // Authentication passed...
            $user = Auth::guard('employer')->user();

            return response()->json([
                'message' => 'Login successful',
                'employer' => $user,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'string|max:255',
            'email' => 'email|unique:employers,email',
            'password' => 'string|min:8',
            'phone_number' => 'string|max:20',
            'birthdate' => 'date',
            'position' => 'string|max:255',
            'company_name' => 'string|max:255',
            'company_city' => 'string|max:255',
            'company_country' => 'string|max:100',
            'company_benefits' => 'string',
            'company_industry' => 'string|max:100',
            'company_description' => 'string'
        ]);

        // Find the user by ID
        $employer = Employer::find($id);

        if (!$employer) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Perbarui data pekerjaan
        if (isset($validatedData['fullname'])) {
            $employer->fullname = $validatedData['fullname'];
        }
        if (isset($validatedData['email'])) {
            $employer->email = $validatedData['email'];
        }
        if (isset($validatedData['password'])) {
            $employer->password = $validatedData['password'];
        }
        if (isset($validatedData['phone_number'])) {
            $employer->phone_number = $validatedData['phone_number'];
        }
        if (isset($validatedData['birthdate'])) {
            $employer->birthdate = $validatedData['birthdate'];
        }
        if (isset($validatedData['position'])) {
            $employer->position = $validatedData['position'];
        }
        if (isset($validatedData['company_name'])) {
            $employer->company_name = $validatedData['company_name'];
        }
        if (isset($validatedData['company_city'])) {
            $employer->company_city = $validatedData['company_city'];
        }
        if (isset($validatedData['company_country'])) {
            $employer->company_country = $validatedData['company_country'];
        }
        if (isset($validatedData['company_benefits'])) {
            $employer->company_benefits = $validatedData['company_benefits'];
        }
        if (isset($validatedData['company_industry'])) {
            $employer->company_industry = $validatedData['company_industry'];
        }
        if (isset($validatedData['company_description'])) {
            $employer->company_description = $validatedData['company_description'];
        }

        // Simpan perubahan
        $employer->save();

        return response()->json(['message' => 'Employer updated successfully.', 'employer' => $employer], 200);
    }

    public function destroy($id)
    {
        // Find the job by its ID
        $employer = Employer::find($id);

        if ($employer) {
            // Delete the job
            $employer->delete();

            // Return a response (you can customize this)
            return response()->json(['message' => 'Employer deleted successfully.'], 200);
        }
        return response()->json(["message" => "Employer not found"], 404);
        
    }
}
