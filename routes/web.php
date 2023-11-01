<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboard\CategoryController;
use App\Http\Controllers\AdminDashboard\JobController;
use App\Http\Controllers\AdminDashboard\UserController;
use App\Http\Controllers\AdminDashboard\CompanyController;
use App\Http\Controllers\AdminDashboard\QuestionController;
use App\Http\Controllers\AdminDashboard\SkillController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['prefix' => 'dashboard' ,'middleware'=>'user.type'], function () {

    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('jobs', JobController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('skills', SkillController::class);

});


require __DIR__ . '/auth.php';
