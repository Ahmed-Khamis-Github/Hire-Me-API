<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(5);
        return view('dashboard.companies.index', compact('companies'));

        }

    /**


     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        return view('dashboard.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return view('dashboard.companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, string $id)
    {
        $request->validate([

                'title' => 'required|string|max:255',
                'company_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'mobile_number' => 'required|string|max:255',
                'email' => 'required|email|max:255',

        ]);
        $company = company::findOrFail($id);
        $company->update($request->all());
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('companies.index');
    }
}
