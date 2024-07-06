<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::all();
        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        return view('applications.create');
    }

    public function store(Request $request)
    {
        Application::create($request->all());
        return redirect()->route('applications.index');
    }

    public function show(Application $application)
    {
        return view('applications.show', compact('application'));
    }

    public function edit(Application $application)
    {
        return view('applications.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $application->update($request->all());
        return redirect()->route('applications.index');
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route('applications.index');
    }
}
