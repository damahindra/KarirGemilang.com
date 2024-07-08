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
Route::post('/user/signup', [UserController::class, 'create']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

// Jobs
Route::get('/jobs', [JobController::class, 'getAllJobs']);
Route::get('/job/{id}', [JobController::class, 'getJob']);
Route::put('/job/{id}', [UserController::class, 'update']);
Route::delete('/job/{id}', [JobController::class, 'destroy']);

// Employer
Route::get('/employer/{id}', [JobController::class, 'getJob']);
Route::post('/employer/signup', [EmployerController::class, 'create']);
Route::put('/employer/{id}', [EmployerController::class, 'update']);
Route::delete('/employer/{id}', [EmployerController::class, 'destroy']);

// Application
Route::get('/job/{job_id}/application/{application_id}', [ApplicationController::class, 'getApplication']);
Route::get('/job/{job_id}/applications', [ApplicationController::class, 'getApplicationsByJobId']);
Route::post('/job/{job_id}/application', [ApplicationController::class, 'create']);