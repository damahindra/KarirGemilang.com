<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
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
    return view('home');
});

// user
Route::post('/user/create-account', [UserController::class, 'create']);

// jobs
Route::get('/jobs', [JobController::class, 'getAllJobs']);
Route::get('/job/{id}', [JobController::class, 'getJob']);

// Route::get('/', function () {
//     return view('welcome');
//     Route::resource('applications', ApplicationController::class);
//     Route::resource('companies', CompanyController::class);
//     Route::resource('employers', EmployerController::class);
//     Route::resource('jobs', JobController::class);
//     Route::resource('users', UserController::class);
// });
