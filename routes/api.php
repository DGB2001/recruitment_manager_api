<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\V1;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\RecruitmentNewsController;
use App\Http\Controllers\API\V1\ApplicationController;
use App\Http\Controllers\API\V1\CandidateController;
use App\Http\Controllers\API\V1\EmployerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::post('/login', [V1\AuthController::class, 'login'])->name('API-LG-010');
// Route::get('/health-check', [V1\HealthCheckController::class, 'index'])->name('health_check');
// Route::resource('/user', UserController::class);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::delete('/logout', [V1\AuthController::class, 'logout'])->name('api-logout');
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('auth.login');
});

Route::controller(RecruitmentNewsController::class)->group(function () {
    Route::get('/recruitment-news', 'getListRecruitmentNews')->name('get-recruitment-news-list');
    Route::get('/recruitment-news/{id}', 'getRecruitmentNewsDetail')->name('get-recruitment-news-detail');
    Route::post('/recruitment-news', 'createRecruitmentNews')->name('create-recruitment-news');
    Route::put('/recruitment-news/{id}', 'updateRecruitmentNews')->name('update-recruitment-news');
    Route::patch('/recruitment-news/{recruitmentId}/applications/{applicationId}', 'updateApplicationResult')
        ->name('update-application-result');
    Route::get('/recruitment-news/{id}/applications', 'getRecruitmentApplicationList')
        ->name('get-application-list-of-recruitment-news');
});

Route::controller(ApplicationController::class)->group(function () {
    Route::post('/applications', 'createApplication')->name('create-application');
});

Route::controller(CandidateController::class)->group(function () {
    Route::post('/candidates', 'createCandidate')->name('create-candidate');
    Route::get('/candidates/{id}', 'getCandidateDetail')->name('get-candidate-detail');
    Route::put('/candidates/{id}', 'updateCandidate')->name('update-candidate');
    Route::get('/candidates/{id}/applications', 'getCandidateApplicationList')->name('get-candidate-application-list');
    Route::delete('/candidates/{id}', 'deleteCandidate')->name('delete-candidate');
});

Route::controller(EmployerController::class)->group(function () {
    Route::post('/employers', 'createEmployer')->name('create-employer');
    Route::get('/employers/{id}', 'getEmployerDetail')->name('get-employer-detail');
    Route::put('/employers/{id}', 'updateEmployer')->name('update-employer');
    Route::get('/employers', 'getEmployerList')->name('get-employer-list');
    Route::delete('/employers/{id}', 'deleteEmployer')->name('delete-employer');
});
