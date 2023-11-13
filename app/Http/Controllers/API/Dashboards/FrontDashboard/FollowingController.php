<?php

namespace App\Http\Controllers\API\Dashboards\FrontDashboard;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\FollowedCompanyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    //
		public function  __construct()
	{
		$this->middleware('auth:sanctum');
	}
	public function index(){
		/*
			company_id
			logo
			company_name
		*/
		$user =  Auth::user();
		$followings=new FollowedCompanyResource($user->follows);
        $followings=FollowedCompanyResource::collection($followings)->paginate(2,null,null,'page');
				// dd($followings);
        return ApiResponse::sendResponse(200, 'Data found',$followings);
	}

}
