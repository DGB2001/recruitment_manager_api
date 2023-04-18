<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\V1;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\UserController;
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
