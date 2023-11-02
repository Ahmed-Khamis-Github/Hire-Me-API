<?php

namespace App\Http\Controllers\API\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Job;
use App\Http\Resources\Home\CategoriesResource;
use App\Http\Resources\Home\JobsResource;
use App\Http\Resources\Home\JobTitleResource;
use App\Http\Resources\Home\JobCitiesResource;
use App\helpers\ApiResponse;

// use App\Http\Resources\ProductResource;

class HomeController extends Controller
{

    public function categories(){
        $categories = Category::limit(8)->get();

        foreach($categories as $category) {
          $category->load(['jobs' => function($q) {
            $q->take(2);
          }]);
        }
        $getCategories = CategoriesResource::collection($categories);

        return ApiResponse::sendResponse(202,"data return successfully",$getCategories);

    }


    public function listJob(){
        $jobs = Job::limit(5)->get();
        $getJobs = JobsResource::collection($jobs);
        return ApiResponse::sendResponse(202,"data return succesfully",$getJobs);
    }



    public function listCities()
{
    $cities = Job::select('location')->distinct()->get();
    $getCities = JobCitiesResource::collection($cities);
    return ApiResponse::sendResponse(202, "City-wise job count", $getCities);
}

    public function search(Request $request)
    {
        $query = $request->input('title');
        $location = $request->input('location');

        $jobs = Job::query();

        if ($query) {
            $jobs->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'LIKE', "%$query%");
            });
        }
        if ($location) {
            $jobs->where(function ($queryBuilder) use ($location) {
                $queryBuilder->where('location', 'LIKE', "%$location%");
            });
        }
        $searchResults = JobsResource::collection($jobs->get());

        return ApiResponse::sendResponse(200, "Search results", $searchResults);
    }
    //return number of jobs
    public function jobs(){
        $numberOfJobs = Job::count();
        return ApiResponse::sendResponse(200,"",$numberOfJobs);
    }


}
