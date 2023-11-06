<?php

namespace App\Http\Controllers\API\Dashboards\FrontDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Personal_access_token;
use App\Http\Resources\ReviewResource;
use Nette\Utils\Paginator;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        $id = $user->id;
        $pagination =
            [
                2,
                ['*'],
                'page'
        ];
        if (isset($user->company_name)) {
            $paginatedReviews = Review::where('company_id', $id)->paginate(...$pagination);
            $reviews = ReviewResource::collection($paginatedReviews);
            $response = [
                'data' => $reviews,
                'current_page' => $paginatedReviews->currentPage(),
                'last_page' => $paginatedReviews->lastPage()
            ];

        } else {
            $paginatedReviews = Review::where('user_id', $id)->paginate(...$pagination);
            $reviews = ReviewResource::collection($paginatedReviews);

            $response = [
                'data' => $reviews,
                'current_page' => $paginatedReviews->currentPage(),
                'last_page' => $paginatedReviews->lastPage()
            ];
        }

        if ($reviews) {
            return ApiResponse::sendResponse(200, 'Data found', $response);
        } else {
            return ApiResponse::sendResponse(404, 'Data not found',  null);
        }
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
    }
    private function userType()
    {
    }
    /**
     * @param bool $id is the company id
     */
    public function show(string $id)
    {
        // sleep(3);
        $review=Review::findorfail($id);
        $review = new ReviewResource($review);
        if ($review) {
            return ApiResponse::sendResponse(200, 'Data found', $review);
        } else {
            return ApiResponse::sendResponse(404, 'Data not found',  null);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $review = Review::find($id);
        $review->update($request->all());
        return ApiResponse::sendResponse(200, 'Review is updated', $review);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $state=Review::find($id)->delete();
        if( $state){
        return ApiResponse::sendResponse(200, 'The bookmark is deleted successfully',[]);
        }else{
        return ApiResponse::sendResponse(400, 'Failed to delete the bookmark',[]);
        }
    }
}
