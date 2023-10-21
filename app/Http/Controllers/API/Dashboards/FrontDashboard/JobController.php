<?php

namespace App\Http\Controllers\API\Dashboards\FrontDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Http\Resources\jobs_candidates_settings\JobsResource;
use App\helpers\ApiResponse;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all jobs

        $jobs = JobsResource::collection(Job::all());
        return ApiResponse::sendResponse(200, "", $jobs);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //new job
        $data = $request->all();
        Job::create($data);

        
        $jobs = JobsResource::collection(Job::all());
        return ApiResponse::sendResponse(200, "", $jobs);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = Job::findOrFail($id);
        
        return ApiResponse::sendResponse(200, "", $job);

        // return $job; 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $job = Job::findOrFail($id);
        
         $job->update($request->all());

            //show all after update
            $data =new  JobsResource($job);
            return ApiResponse::sendResponse(200, "", $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);

        $job->delete();

        //show all after delete
        $jobs = JobsResource::collection(Job::all());
        return ApiResponse::sendResponse(200, "", $jobs);

    }
}
