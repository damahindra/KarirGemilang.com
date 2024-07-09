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
    return response()->json(['message' => 'this is homepage'], 200);
});

// User
Route::get('/user/{id}', [UserController::class, 'getUser']);
Route::post('/user/signup', [UserController::class, 'create']);
Route::post('/user/login', [UserController::class, 'login']);
Route::post('/user/logout', [UserController::class, 'logout']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

// Jobs
Route::get('/jobs', [JobController::class, 'getAllJobs']);
Route::get('/job/{id}', [JobController::class, 'getJob']);
Route::post('/job', [JobController::class, 'create']);
Route::put('/job/{id}', [JobController::class, 'update']);
Route::delete('/job/{id}', [JobController::class, 'destroy']);

// Employer
Route::get('/employer/{id}', [EmployerController::class, 'getEmployer']);
Route::post('/employer/signup', [EmployerController::class, 'create']);
Route::post('/employer/login', [EmployerController::class, 'login']);
Route::post('/employer/logout', [EmployerController::class, 'logout']);
Route::put('/employer/{id}', [EmployerController::class, 'update']);
Route::delete('/employer/{id}', [EmployerController::class, 'destroy']);

// Application
Route::get('/job/{job_id}/application/{application_id}', [ApplicationController::class, 'getApplication']);
Route::get('/job/{job_id}/applications', [ApplicationController::class, 'getApplicationsByJobId']);
Route::post('/job/{job_id}/application', [ApplicationController::class, 'create']);

// Company
Route::get('/company/{company_id}', [CompanyController::class, 'getCompany']);