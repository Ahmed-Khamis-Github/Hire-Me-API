<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Job;
use App\Models\Category;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::paginate(5);

        return view('dashboard.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|min:2',
            'min_salary' => 'required|number|min:2',
            'max_salary' => 'required|number|min:2',
            'type' => 'required',
            'location' => 'required|string',

        ]) ;
        
        $data = $request->all();
		
		Category::create($data);

		return redirect()->route('dashboard.jobs.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = Job::findOrFail($id);
        return view('dashboard.jobs.show' , compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $job = Job::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.jobs.edit' , compact('job' ,'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:2',
            'min_salary' => 'required|numeric|min:2',
            'max_salary' => 'required|numeric|min:2',
            'type' => 'required',
            'location' => 'required|string',

        ]) ;
        $job = JOb::findOrFail($id);


        $data = $request->all();

 
        $job->update($data);

        return redirect()->route('jobs.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     
        $job = Job::findOrFail($id);

        $job->delete();

        return redirect()->route('jobs.index');     
    }
}
