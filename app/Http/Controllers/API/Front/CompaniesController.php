<?php

namespace App\Http\Controllers\API\Front;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Front\BrowseCompaniesResource;
use App\Http\Resources\Front\CompanyResource;
use App\Models\Company;
use App\Models\Review;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Support\Collection;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagination = [3, ['*'], 'page'];

        $paginatedCompanies = Company::with('users')->paginate(...$pagination);
            $companies = BrowseCompaniesResource::collection($paginatedCompanies);
            $response = [
                'data' => $companies,
                'current_page' => $paginatedCompanies->currentPage(),
                'last_page' => $paginatedCompanies->lastPage()
            ];

        return ApiResponse::sendResponse(200, '', $response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function applyFilters(Request $request)
    {
        // Define the base query for job listings
        $query = Company::query();

        // Apply filters
        if ($request->filled('company_name')) {
            $keyword = $request->input('company_name');
            $query->where('company_name', 'LIKE', '%' . $keyword . '%');
        }

        // Sorting criteria
        $sort = $request->input('sort');

        if ($sort === 'a-z') {
            $query->orderBy('company_name', 'asc');
        } elseif ($sort === 'z-a') {
            $query->orderBy('company_name', 'desc');
        }

        // Paginate the filtered results
        $pagination = [3, ['*'], 'page'];
        $paginatedCompaniesListings = $query->paginate(...$pagination);

        $formattedCompaniesListings = CompanyResource::collection($paginatedCompaniesListings);
        $response = [
            'data' => $formattedCompaniesListings,
            'current_page' => $paginatedCompaniesListings->currentPage(),
            'last_page' => $paginatedCompaniesListings->lastPage()
        ];

        // Format the filtered Companie listings
        return ApiResponse::sendResponse(200, "", $response);
    }

}
