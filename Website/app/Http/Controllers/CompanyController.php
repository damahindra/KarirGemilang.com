<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getCompany($id)
    {
        $company = Company::where('company_id', $id)->get();
        return response()->json(['Company' => $company], 200);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        Company::create($request->all());
        return redirect()->route('companies.index');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $company->update($request->all());
        return redirect()->route('companies.index');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index');
    }
}
