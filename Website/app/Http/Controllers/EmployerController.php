<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index()
    {
        $employers = Employer::all();
        return view('employers.index', compact('employers'));
    }

    public function create(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|min:12',
            'birthdate' => 'required|date',
            'last_education' => 'string|max:255'
        ]);
    }

    public function store(Request $request)
    {
        Employer::create($request->all());
        return redirect()->route('employers.index');
    }

    public function show(Employer $employer)
    {
        return view('employers.show', compact('employer'));
    }

    public function edit(Employer $employer)
    {
        return view('employers.edit', compact('employer'));
    }

    public function update(Request $request, Employer $employer)
    {
        $employer->update($request->all());
        return redirect()->route('employers.index');
    }

    public function destroy(Employer $employer)
    {
        $employer->delete();
        return redirect()->route('employers.index');
    }
}
