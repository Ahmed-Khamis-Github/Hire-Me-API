<?php

namespace App\Http\Controllers\API\Dashboards\FrontDashboard;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\JobUser;
use App\Helpers\ApiResponse;
use App\Http\Resources\jobs_candidates_settings\CandidatesResource;

class CandidatesController extends Controller
{


    public function  __construct (){
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
	public function index()
    {

        //   كل اليوزرز اللي مقدمين علي شغل في الشركه بتاعتي

        $jobs = Job::where('company_id', Auth::user()->id)->get();
        $userData = [];

        foreach ($jobs as $job) {

            $users = $job->Apply()->get();


            $data = CandidatesResource::collection($users);

                if($data-> isNotEmpty()){

                    $userData[] = $data;
                }



            }
            return ApiResponse::sendResponse(200, "", $userData );
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

    //  when user apply to job

    public function store(Request $request)
    {
        // $data= $request->all();
        // // $data ->merge([
        // //     'user_id'=>5
        // // ]);
        // JobUser::create($data);
        // return 'added';
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

         $job = JobUser::where('id',$id)
        ->first();

        if (!$job) {
            return "Job not found or you don't have permission to access it.";
        }

        $job->delete();

        return "Successfully detached user with ID: $id from jobs.";
    }


}
