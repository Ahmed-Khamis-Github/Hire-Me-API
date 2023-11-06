<?php

namespace App\Http\Controllers\API\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ApiResponse ;

class NotificationsController extends Controller
{

    public function  __construct (){
        $this->middleware('auth:sanctum') ;
    }


    public function notifications()
    {
        $user = Auth::user() ;
        $notifications = $user->notifications()->get();

        return ApiResponse::sendResponse(200, "", $notifications);
    }
}
