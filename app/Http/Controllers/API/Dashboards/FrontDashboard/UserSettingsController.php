<?php

namespace App\Http\Controllers\API\Dashboards\FrontDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\helpers\ApiResponse;


class UserSettingsController extends Controller
{

    public function  __construct (){
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()

    {

        $user = Auth::user();
        return ApiResponse::sendResponse(200, "returned successfully", $user);

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
            //   $user = User::findOrFail(Auth::user()->id);
      $user = User::findOrFail($id);

      return $user;
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
    public function update(Request $request)
    {
        $user = Auth::user();

       $storedPassword = $user->password;

        $userProvidedPassword = $request->input('password'); //current
        $new_password = $request->input('new_password');   //new


        if(!empty($new_password)  && !empty($userProvidedPassword)){
            // return response()->json('no data');
            if (Hash::check($userProvidedPassword, $storedPassword)) {

                $user->password = Hash::make($request->new_password);
                $user->save();
                
                }
         else{
        return ApiResponse::sendResponse(404, "invalid password", []);
                    
                }
        }

        $data = $request->except('password' , 'new_password');
//    dd($data);
        $user->update($data);
    

        return ApiResponse::sendResponse(200, "updated successfully", $user);
        // return $user;
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
        public function getUserType()
    {
    //    return ApiResponse::sendResponse(200, 'Data found',  \request()->header());
        $user = Auth::user();
        // dd($user);
        if (isset($user->company_name)) {
            return ApiResponse::sendResponse(200, 'Data found',  ['type' => 'company']);
        } else {
            return ApiResponse::sendResponse(200, 'Data found',  ['type' => 'employee']);
        }
    }

}
