<?php

namespace App\Http\Controllers\API\Front;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Front\BrowseCompaniesResource;
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
