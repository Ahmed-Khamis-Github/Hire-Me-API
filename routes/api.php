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

Route::get('jobs',[JobsController::class,'index']) ;
 