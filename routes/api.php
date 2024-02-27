<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerifyRegistrationController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::group(['prefix' => 'dashboard', 'middleware' => 'admin'], function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'create']);
        Route::put('/users/{user}/update', [UserController::class, 'update']);
    });

    Route::withoutMiddleware('verified')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/verify-code', [VerifyRegistrationController::class, 'verify']);
        Route::post('/resend-code', [VerifyRegistrationController::class, 'resend']);
    });

    Route::get('/test', function () {
        return 'Test';
    });
});


Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', RegisterController::class);
