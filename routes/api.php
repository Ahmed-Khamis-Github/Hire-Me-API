<?php

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
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Authentication\StripeController ;
use App\Http\Controllers\API\Front\JobsController;
use App\Http\Controllers\API\Dashboards\FrontDashboard\JobController;
use App\Http\Controllers\API\Dashboards\FrontDashboard\CandidatesController;
use App\Http\Controllers\API\Dashboards\FrontDashboard\UserSettingsController;
use App\Http\Controllers\API\Dashboards\FrontDashboard\CompanySettingsController;


use App\Http\Controllers\API\Front\HomeController;
use App\Http\Controllers\API\Front\EmployeeProfileController;

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

// jobs & candidates (amany)

Route::resource('jobs', JobController::class);
Route::resource('candidates', CandidatesController::class);

//settings (amany)

Route::resource('userSettings', UserSettingsController::class);

Route::resource('companySettings', CompanySettingsController::class);
Route::put('companySettings', [CompanySettingsController::class , 'update']);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//route of Home

Route::get('Home/categories',[HomeController::class,'categories']);
Route::get('Home/jobs',[HomeController::class,'jobs']);
Route::get('Home/cities',[HomeController::class,'listCities']);
Route::get('Home/listJob',[HomeController::class,'listJob']) ;
Route::get('Home/search',[HomeController::class,'search']);

//////////////////////////////////////////////
//route of profile user
Route::get('/profile/{id}',[EmployeeProfileController::class,'show']);
