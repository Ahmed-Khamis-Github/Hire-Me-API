<?php

namespace App\Http\Controllers\API\Dashboards\FrontDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ApiResponse;

class DashboardHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        // return ApiResponse::sendResponse(200, 'Data found',  \request()->header());
        $user = Auth::user();
        $id = $user->id;

        if (isset($user->company_name)) {
            //to get jobs number
            try {
                $data['jobs_number'] = Job::where('company_id', $id)->count();
            } catch (\Exception $e) {
                $data['jobs_number']  = 0;
            }
             $data['jobs_applied'] =0;
            foreach($user->jobs->all() as $job ){
                $data['jobs_applied'] += $job->Apply()->where('job_id', $job->id)->count();
            }
            // $data['jobs_applied']=$user->jobs;
            try {
                $data['reviews_number'] = Review::where('company_id', $id)->count();
            } catch (\Exception $e) {
                $data['reviews_number'] = 0;
            }
            $data['location'] = $user->location;
            $data['name'] = $user->company_name;
            $data['logo'] = $user->logo;
            $data['about'] = $user->about;
            $data['quantity'] = $user->quantity;
			

        } else {
            //to get number of jobs applied for
            try {
                $data['jobs_applied']  = $user->Apply()->count();
            } catch (\Exception $e) {
                $data['jobs_applied'] = 0;
            }
            //to get reviews number
            try {
                $data['reviews_number']= Review::where('user_id', $id)->count();
            } catch (\Exception $e) {
                $data['reviews_number']= 0;
            }
            $data['location'] = $user->nationality;
            $data['name'] = $user->first_name. ' ' . $user->last_name;
            $data['logo'] = $user->avatar;
            $data['about'] = $user->about;
        }
        return ApiResponse::sendResponse(200, 'Data found', $data);
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
