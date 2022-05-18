<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CentroController;
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
    Route::post('/sendMail', [AuthController::class, 'sendMail']);
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

Route::group([
    'middleware' => ['api', 'auth:sanctum', 'admin'],
    'prefix' => 'centros'
], function ($router) {
    Route::get('/list', [CentroController::class, 'index']);
    Route::get('/{centro}', [CentroController::class, 'show']);
    Route::get('/{centro}/admins', [CentroController::class, 'admins']);
    Route::post('/{centro}/admins', [CentroController::class, 'addAdmins']);
    Route::delete('/{centro}/admins/{user}', [CentroController::class, 'delAdmins']);
    Route::get('/{centro}/notadmins', [CentroController::class, 'getNotAdmins']);
    Route::post('/{centro}/status', [CentroController::class, 'chgStatusCentro']);
    Route::post('/{centro}/edit', [CentroController::class, 'editCentro']);
    Route::post('/create', [CentroController::class, 'store']);
});

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'articulos'
], function ($router) {
    Route::get('/{centro}/list', [ArticuloController::class, 'index']);
});