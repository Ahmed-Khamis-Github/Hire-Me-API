<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Social;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = User::where('role', 'admin')->with('socials')->first();

        return View('dashboard.contact.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     $admin = User::findOrFail($id);

    //     return view('dashboard.contact.edit' , compact('admin'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function edit(string $id)
{
    $admin = User::with('socials')->findOrFail($id);
    return view('dashboard.contact.edit', compact('admin'));
}

public function update(Request $request, string $id)
{
    $admin = User::with('socials')->findOrFail($id);


	$request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email',
        'mobile_number' => 'nullable|string',
        'github' => 'nullable|string',
        'linkedin' => 'nullable|string',
        'twitter' => 'nullable|string',
    ]);






    $data = $request->all();

    // Update the user's data
    $admin->update($request->all());
    // Update the associated social links
    foreach ($admin->socials as $social) {
        $social->update([
            'github_account' => $data['github'],
            'linkedin_account' => $data['linkedin'],
            'twitter_account' => $data['twitter'],
        ]);
    }
    return redirect()->route('contact.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
