<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\UserController;
use App\Models\Familia;
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
    Route::put('/{user}/alternate', [UserController::class, 'alternateUser']);
    Route::put('/{user}/edit', [UserController::class, 'editUser']);
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
    Route::put('/{centro}/status', [CentroController::class, 'chgStatusCentro']);
    Route::put('/{centro}/edit', [CentroController::class, 'editCentro']);
    Route::post('/create', [CentroController::class, 'store']);
});

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'articulos'
], function ($router) {
    Route::get('/{centro}/list', [ArticuloController::class, 'index']);
    Route::get('/{centro}', [ArticuloController::class, 'show']);
    Route::put('/{articulo}/status', [ArticuloController::class, 'chgStatusArticulo']);
    Route::put('/{articulo}/edit', [ArticuloController::class, 'update']);
    Route::put('/{articulo}/editFamilia', [ArticuloController::class, 'updateFamily']);
    Route::post('/create', [ArticuloController::class, 'store']);
});

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'familias'
], function ($router) {
    Route::get('/{centro}/list', [FamiliaController::class, 'index']);
    Route::get('/{centro}/listAll', [FamiliaController::class, 'indexAll']);
    // Route::post('/{articulo}/status', [ArticuloController::class, 'chgStatusArticulo']);
    Route::get('/{centro}', [FamiliaController::class, 'show']);
    Route::put('/{familia}/edit', [FamiliaController::class, 'update']);
    Route::post('/create', [FamiliaController::class, 'store']);
    Route::delete('/{familia}', [FamiliaController::class, 'destroy']);
});