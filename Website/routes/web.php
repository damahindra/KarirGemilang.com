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

// User
Route::get('/user/{id}', [UserController::class, 'getUser']);
Route::post('/user/create-account', [UserController::class, 'create']);

// Jobs
Route::get('/jobs', [JobController::class, 'getAllJobs']);
Route::get('/job/{id}', [JobController::class, 'getJob']);

// Employer
Route::get('/employer/{id}', [JobController::class, 'getJob']);
Route::post('/employer/create-account', [EmployerController::class, 'create']);

// Application
Route::get('/job/{job_id}/application/{application_id}', [ApplicationController::class, 'getApplication']);
Route::get('/job/{job_id}/applications', [ApplicationController::class, 'getAllApplications']);
Route::post('/job/{job_id}/create-application', [ApplicationController::class, 'create']);