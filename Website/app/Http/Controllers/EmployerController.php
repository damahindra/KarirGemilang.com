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

    public function create()
    {
        return view('employers.create');
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
