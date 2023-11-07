<?php

namespace App\Http\Controllers\API\Dashboards\FrontDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use App\Models\Social;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use App\Helpers\ApiResponse;
use App\Http\Resources\jobs_candidates_settings\JobsResource;



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
        return $user;

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

        //skills handling
        if ($request->has('skills')) {
            $skillIds = $request->input('skills');
            $user->skills()->syncWithOutDetaching($skillIds); // Use 'sync' to update the user's skills
        }
        //end skills

        //social
        // $this->saveSocials($request);

        //password handling
       $storedPassword = $user->password;

        $userProvidedPassword = $request->input('password'); //current
        $new_password = $request->input('new_password');   //new


        if(!empty($new_password)  && !empty($userProvidedPassword)){

            if (Hash::check($userProvidedPassword, $storedPassword)) {

                $user->password = Hash::make($request->new_password);
                $user->save();


            } else{
                return ApiResponse::sendResponse(404, "invalid password", []);

                }
            }
            //end password 
            


        $data = $request->except('password' , 'new_password', 'skills');

       if( $request->hasFile('cv') )
       {
        $path = public_path('images/cv');
        !is_dir($path) &&
            mkdir($path, 7777, true);

            


        $imageName = time() . '.' . $request->file('cv')->extension();
        $request->file('cv')->move($path, $imageName);

         $data['cv'] = $imageName;
       }

       
       if( $request->hasFile('avatar') )
       {
        $path = public_path('images/avatars');
        !is_dir($path) &&
            mkdir($path, 7777, true);

            


        $imageName = time() . '.' . $request->file('avatar')->extension();
        $request->file('avatar')->move($path, $imageName);

         $data['avatar'] = $imageName;
       }


       
       
         

        $user->update($data);


        return ApiResponse::sendResponse(200, "updated successfully", $user , $user->skills , $user->socials);


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

    public function getUserSkills(){
        $user = Auth::user();

        return $user->skills;
    }


    //skills
    public function getAllSkills(){
        $skills = Skill::all();

        return $skills;
    }

    public function saveUserSkills(Request $request) {

            $user = Auth::user();
            $skillIds = $request->skill_id;
        // dd($user);
            // dd($skillIds);
            $user->skills()->syncWithoutDetaching($request->skill_id);

            return $user->skills;

    }
    public function destroySkill($skillId) {
        $user = Auth::user();

        // Use the detach method to remove the specified skill from the user's skills
        $user->skills()->detach($skillId);

        return $user->skills;
    }

    //socials
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


    // كل الشغلانات اللي قدم عليها اليوزر الفلاني

    public function  userAppliedJobs(){
        $user = Auth::user();

        // dd($user);

        $jobs = $user->Apply()->get();

        $data = JobsResource::collection($jobs);
        return ApiResponse::sendResponse(200, "", $data);


        return $data;

    }





}
