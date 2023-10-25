<?php

namespace App\Http\Controllers\API\Front;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Front\JobResource;
use App\Models\Job;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Define the base query for job listings
            $query = Job::query();

            // Apply filters
            if ($request->filled('location')) {
                $query->where('location', $request->input('location'));
            }

            if ($request->filled('category')) {
                $categories = $request->input('category');
                $query->whereIn('category', $categories);
            }

            if ($request->filled('experience')) {
                $experience = $request->input('experience');
                $query->where('experience', $experience);
            }

            if ($request->filled('job_type')) {
                $jobTypes = $request->input('job_type');
                $query->whereIn('job_type', $jobTypes);
            }

            if ($request->filled('salary_range')) {
                $salaryRange = json_decode($request->input('salary_range'));
                $query->whereBetween('salary', [$salaryRange->min, $salaryRange->max]);
            }

            // Apply sorting 
            $sort = $request->input('sort', 'relevance');
            if ($sort === 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sort === 'oldest') {
                $query->orderBy('created_at', 'asc');
            }

            // Paginate the results
            $perPage = $request->input('per_page', 10);
            $jobListings = $query->paginate($perPage);

            $formattedJobListings = JobResource::collection($jobListings);

            // Format the job listings
            return ApiResponse::sendResponse(200, "", $formattedJobListings);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::sendResponse(500, 'An error occurred while fetching job listings');
        }
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
        try {
            $job = Job::findOrFail($id);
    
            $jobData = new JobResource($job);
    
            return ApiResponse::sendResponse(200, "", $jobData);
    
        } catch (ModelNotFoundException $e) {
    
            return ApiResponse::sendResponse(404, 'Job data not found');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
