<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboard\CategoryController;
use App\Http\Controllers\AdminDashboard\JobController;
use App\Http\Controllers\AdminDashboard\UserController;
use App\Http\Controllers\AdminDashboard\CompanyController;
use App\Http\Controllers\AdminDashboard\QuestionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'dashboard'], function () {

    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('jobs', JobController::class);
    Route::resource('questions', QuestionController::class);
});
