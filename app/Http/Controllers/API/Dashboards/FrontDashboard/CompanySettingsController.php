<?php

namespace App\Http\Controllers\API\Dashboards\FrontDashboard;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Social;
use App\helpers\ApiResponse;

use Illuminate\Support\Facades\Auth;



class CompanySettingsController extends Controller
{

    public function  __construct (){
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $company = Company::findOrFail($id);

        return $company;
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
    public function show()
    {
        $id = Auth::user()->id;
        $company = Company::findOrFail($id);

        return $company;
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
        //socials

        $this->saveSocials($request);
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
        
        
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getSocials(){
        $user = Auth::user();
        $socials = $user->socials;
        return $socials ; 
    }
    public function saveSocials(Request $request){

        $user = Auth::user();
    
        $socialData = $request->only(['linkedin_account', 'github_account' , 'twitter_account']);
        
        $social = Social::updateOrInsert(
            ['user_id' => $user->id],
            $socialData
        );
        return $user->socials;   
    }
}