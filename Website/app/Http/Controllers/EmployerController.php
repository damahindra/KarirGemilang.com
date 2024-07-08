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
        $employer = Employer::where('employer_id', $id)->get();
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

        // Create the employer
        $employer = Employer::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'birthdate' => $request->birthdate,
            'company_id' => $company->id // Set the company ID
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
}
