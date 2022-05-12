<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    // Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::any('/noAuth', [AuthController::class, 'notValidToken'])->name('login');
});

Route::post('/mail', [AuthController::class, 'sendmail']);

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'users'
], function ($router) {
    Route::get('/list', [UserController::class, 'getUsers']);
    Route::get('/{user}', [UserController::class, 'getUser']);
    Route::post('/{user}/alternate', [UserController::class, 'alternateUser']);
    Route::post('/{user}/edit', [UserController::class, 'editUser']);
    Route::post('/{user}/logout', [UserController::class, 'logAllOut']);
});