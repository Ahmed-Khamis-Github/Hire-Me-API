<?php

namespace App\Http\Controllers\API\Dashboards\FrontDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\helpers\ApiResponse;
use App\Http\Resources\jobs_candidates_settings\CandidatesResource;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     
        $users = User::with('profile')->get();
        
        // $data =  candidatesResource::collection($users);
        // dd($data);
        // return ApiResponse::sendResponse(200, "", $data);

        return $users ;


    
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
