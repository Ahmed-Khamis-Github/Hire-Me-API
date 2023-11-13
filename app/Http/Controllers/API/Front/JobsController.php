<?php

namespace App\Http\Controllers\API\Front;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Front\JobResource;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
{

    public function  __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'applyFilters']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $is_authenticated = isset($request->header()['authorization']);

        if ($is_authenticated) {
            return redirect()->route('jobs-authenticated');
        }

        try {
            // Paginate the results
            $pagination = [10, ['*'], 'page'];

            $paginatedJobs = Job::orderBy('created_at', 'desc')->paginate(...$pagination);
            $formattedJobListings = JobResource::collection($paginatedJobs);
            $response = [
                'data' => $formattedJobListings,
                'current_page' => $paginatedJobs->currentPage(),
                'last_page' => $paginatedJobs->lastPage(),
                'is_authenticated' => $is_authenticated,
            ];

            // Format the job listings
            return ApiResponse::sendResponse(200, '', $response);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::sendResponse(500, 'An error occurred while fetching job listings');
        }
    }

    public function indexAuth(Request $request)
    {

        try {
            // Paginate the results
            $pagination = [10, ['*'], 'page'];

            $paginatedJobs = Job::orderBy('created_at', 'desc')->paginate(...$pagination);
            $formattedJobListings = JobResource::collection($paginatedJobs);
            $response = [
                'data' => $formattedJobListings,
                'current_page' => $paginatedJobs->currentPage(),
                'last_page' => $paginatedJobs->lastPage(),
                'is_authenticated' => true,
            ];

            // Format the job listings
            return ApiResponse::sendResponse(200, '', $response);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::sendResponse(500, 'An error occurred while fetching job listings');
        }
    }


    /**
     * Applying filters to the job listing.
     */
    public function applyFilters(Request $request)
    {
        $is_authenticated = isset($request->header()['authorization']);

        if ($is_authenticated) {
            return redirect()->route('applyFilters-authenticated');
        }

        // Define the base query for job listings
        $query = Job::query();

        // Apply filters
        if ($request->filled('location')) {
            $query->where('location', $request->input('location'));
        }

        if ($request->filled('category_name')) {
            $categoryName = $request->input('category_name');

            // Find the category ID based on the category name
            $categoryId = Category::where('name', $categoryName)->first();

            if ($categoryId) {
                // Use the found category ID to filter jobs
                $query->where('category_id', $categoryId->id);
            }
        }

        if ($request->filled('experience')) {
            $experience = $request->input('experience');
            $query->where('experience', $experience);
        }

        if ($request->filled('type')) {
            $jobTypes = $request->input('type');

            // The 'type' parameter is expected to be an array, but if it's a string, convert it to an array.
            if (!is_array($jobTypes)) {
                $jobTypes = [$jobTypes];
            }

            $query->whereIn('type', $jobTypes);
        }

        if ($request->filled('min_salary') && $request->filled('max_salary')) {
            $minSalary = $request->input('min_salary');
            $maxSalary = $request->input('max_salary');
            $query->where('min_salary', '>=', $minSalary)->where('max_salary', '<=', $maxSalary);
        } elseif ($request->filled('min_salary')) {
            $minSalary = $request->input('min_salary');
            $query->where('min_salary', '>=', $minSalary);
        } elseif ($request->filled('max_salary')) {
            $maxSalary = $request->input('max_salary');
            $query->where('max_salary', '<=', $maxSalary);
        }

        // Sorting criteria
        $sort = $request->input('sort');

        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        }

        // Paginate the filtered results
        $pagination = [2, ['*'], 'page'];
        $paginatedJobsListings = $query->paginate(...$pagination);

        $formattedJobListings = JobResource::collection($paginatedJobsListings);
        $response = [
            'data' => $formattedJobListings,
            'current_page' => $paginatedJobsListings->currentPage(),
            'last_page' => $paginatedJobsListings->lastPage()
        ];

        // Format the filtered job listings
        return ApiResponse::sendResponse(200, "", $response);
    }


    public function applyFiltersAuth(Request $request)
    {
        // Define the base query for job listings
        $query = Job::query();

        // Apply filters
        if ($request->filled('location')) {
            $query->where('location', $request->input('location'));
        }

        if ($request->filled('category_name')) {
            $categoryName = $request->input('category_name');

            // Find the category ID based on the category name
            $categoryId = Category::where('name', $categoryName)->first();

            if ($categoryId) {
                // Use the found category ID to filter jobs
                $query->where('category_id', $categoryId->id);
            }
        }

        if ($request->filled('experience')) {
            $experience = $request->input('experience');
            $query->where('experience', $experience);
        }

        if ($request->filled('type')) {
            $jobTypes = $request->input('type');

            // The 'type' parameter is expected to be an array, but if it's a string, convert it to an array.
            if (!is_array($jobTypes)) {
                $jobTypes = [$jobTypes];
            }

            $query->whereIn('type', $jobTypes);
        }

        if ($request->filled('min_salary') && $request->filled('max_salary')) {
            $minSalary = $request->input('min_salary');
            $maxSalary = $request->input('max_salary');
            $query->where('min_salary', '>=', $minSalary)->where('max_salary', '<=', $maxSalary);
        } elseif ($request->filled('min_salary')) {
            $minSalary = $request->input('min_salary');
            $query->where('min_salary', '>=', $minSalary);
        } elseif ($request->filled('max_salary')) {
            $maxSalary = $request->input('max_salary');
            $query->where('max_salary', '<=', $maxSalary);
        }

        // Sorting criteria
        $sort = $request->input('sort');

        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        }

        // Paginate the filtered results
        $pagination = [2, ['*'], 'page'];
        $paginatedJobsListings = $query->paginate(...$pagination);

        $formattedJobListings = JobResource::collection($paginatedJobsListings);
        $response = [
            'data' => $formattedJobListings,
            'current_page' => $paginatedJobsListings->currentPage(),
            'last_page' => $paginatedJobsListings->lastPage()
        ];

        // Format the filtered job listings
        return ApiResponse::sendResponse(200, "", $response);
    }
}
