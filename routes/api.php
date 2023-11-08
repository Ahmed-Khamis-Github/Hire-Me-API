<?php

use Illuminate\Http\Request ;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Authentication\CompanyLogin;
use App\Http\Controllers\API\Authentication\CompanyRegister;
use App\Http\Controllers\API\Authentication\EmailVerification;
use App\Http\Controllers\API\Authentication\RegisterController;
use App\Http\Controllers\API\Authentication\SocialLoginController;
use App\Http\Controllers\API\Authentication\UserForgetPass;
use App\Http\Controllers\API\Authentication\UserLogin;
use App\Http\Controllers\API\Authentication\UserLogout;
use App\Http\Controllers\API\Authentication\UserRegister;
use App\Http\Controllers\API\Authentication\UserSendResetEmail;
use App\Http\Controllers\API\Authentication\StripeController ;
use App\Http\Controllers\API\Authentication\UserController;
use App\Http\Controllers\API\Front\CompanyProfileController;
use App\Http\Controllers\API\Front\CompaniesController;
use App\Http\Controllers\API\Front\JobProfileController;
use App\Http\Controllers\API\Front\JobsController;
use App\Http\Controllers\API\Dashboards\FrontDashboard\JobController;
use App\Http\Controllers\API\Dashboards\FrontDashboard\CandidatesController;
use App\Http\Controllers\API\Dashboards\FrontDashboard\UserSettingsController;
use App\Http\Controllers\API\Dashboards\FrontDashboard\CompanySettingsController;


use App\Http\Controllers\API\Front\HomeController;
use App\Http\Controllers\API\Front\EmployeeProfileController;

//front-dashboard interfaces
use  App\Http\Controllers\API\Dashboards\FrontDashboard\DashboardHomeController;
use App\Http\Controllers\API\Dashboards\FrontDashboard\ReviewsController;
use App\Http\Controllers\API\Dashboards\FrontDashboard\BookmarksController;
use App\Http\Controllers\API\Front\ContactController;
use App\Http\Controllers\API\Front\NotificationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//                   <!-- Public -->

// authentication routes
Route::post('employee-register', [UserRegister::class, 'register']);
Route::post('company-register', [CompanyRegister::class, 'register']);
Route::post('employee-login', [UserLogin::class, 'login']);
Route::post('company-login', [CompanyLogin::class, 'login']);
Route::post('logout', [UserLogout::class, 'destroy']);
Route::post('user/forget-password', [UserSendResetEmail::class, 'forgetPassword']);
Route::post('company/forget-password', [UserSendResetEmail::class, 'forgetPassword']);
Route::post('user/reset-password', [UserForgetPass::class, 'passwordReset']);
Route::post('company/reset-password', [UserForgetPass::class, 'passwordReset']);
Route::post('user/email-verification', [EmailVerification::class, 'emailVerify']);
Route::post('company/email-verification', [EmailVerification::class, 'emailVerify']) ;

Route::get('user/email-verification', [EmailVerification::class, 'resendEmailVerify'])
    ->middleware(['auth:sanctum']);

Route::get('company/email-verification', [EmailVerification::class, 'resendEmailVerify'])
->middleware(['auth:sanctum', 'ability:company']);

Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect']) ;
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback']) ;
Route::post('/stripe',[StripeController::class,'paymentStripe']);





/////////////////////////////////End Of routes /////////////////////////////////////////////////
//front-dashboard routes
//only middleware is left for the routes
//home
Route::resource('dashboard-home', DashboardHomeController::class);
//reviews
Route::resource('dashboard-reviews', ReviewsController::class);
Route::resource('dashboard-bookmarks', BookmarksController::class);
Route::post('get-user-type', [UserSettingsController::class,'getUserType']);


// jobs & candidates (amany)

Route::resource('getAllJobs', JobController::class);
Route::resource('candidates', CandidatesController::class);

//settings (amany)
Route::post('companySettings', [CompanySettingsController::class , 'update']);
Route::get('companySettings', [CompanySettingsController::class , 'index']);
Route::get('userSettings', [UserSettingsController::class , 'index']);
Route::post('userSettings', [UserSettingsController::class , 'update']);

//Skills (amany)
Route::get('getAllSkills', [UserSettingsController::class , 'getAllSkills']);
Route::get('getUserSkills', [UserSettingsController::class , 'getUserSkills']);
Route::post('saveUserSkills', [UserSettingsController::class , 'saveUserSkills']);
Route::delete('destroySkill/{id}', [UserSettingsController::class , 'destroySkill']);

//socials (amany)
Route::get('socials', [UserSettingsController::class , 'getSocials']);
Route::put('socials', [UserSettingsController::class , 'saveSocials']);

Route::get('cmpSocials', [CompanySettingsController::class , 'getSocials']);
Route::put('cmpSocials', [CompanySettingsController::class , 'saveSocials']);
Route::get('userAppliedJobs', [UserSettingsController::class , 'userAppliedJobs']);



/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//route of Home

Route::get('Home/categories',[HomeController::class,'categories']);
Route::get('Home/jobs',[HomeController::class,'jobs']);
Route::get('Home/cities',[HomeController::class,'listCities']);
Route::get('Home/listJob',[HomeController::class,'listJob']) ;
Route::get('Home/search',[HomeController::class,'search']);

////////////////////////////////////////////////////////////////////////////////////
//route of profile user
Route::get('/profile/{id}',[EmployeeProfileController::class,'show']);

//  <!-- browse companies routes / Start -->
Route::get('/companies', [CompaniesController::class, 'index']);
Route::get('/companies/apply', [CompaniesController::class, 'applyFilters']);
//  <!-- browse companies routes / End -->

//  <!-- browse companies routes / Start -->
Route::get('/jobs', [JobsController::class, 'index']);
Route::get('/jobs/apply', [JobsController::class, 'applyFilters']);
//  <!-- browse companies routes / End -->

//  <!-- company profile routes / Start -->
Route::get('/companies/{id}', [CompanyProfileController::class, 'show']);
Route::post('/companies/{id}/review', [CompanyProfileController::class, 'addReview']);
Route::post('/companies/{id}/bookmark/{jobId}', [CompanyProfileController::class, 'bookmarkJob']);
//  <!-- company profile routes / End -->

//  <!-- job profile routes / Start -->
Route::get('/job-profile/{id}', [JobProfileController::class, 'show']);
Route::post('/job-profile/{id}/apply', [JobProfileController::class, 'apply']);
Route::post('/job-profile/{id}/bookmark', [JobProfileController::class, 'bookmark']);
//  <!-- job profile routes / End -->


Route::get('notifications',[NotificationsController::class,'notifications']) ;

Route::post('/contact-us', [ContactController::class, 'contact']);

//admin details page contact us
Route::get('/admin-info', [ContactController::class,'getAdmin']);


