<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    public function index()
    {
        $employers = Employer::all();
        return view('employers.index', compact('employers'));
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
}
