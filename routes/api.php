<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\TarifaController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\gposcontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\PrecioController;
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
    Route::post('/resendverificationcode', [AuthController::class, 'resendVerificationCode']);
    Route::post('/verify', [AuthController::class, 'verify']);
});

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
    Route::get('/{centro}', [FamiliaController::class, 'show']);
    Route::put('/{familia}/edit', [FamiliaController::class, 'update']);
    Route::post('/create', [FamiliaController::class, 'store']);
    Route::delete('/{familia}', [FamiliaController::class, 'destroy']);
});

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'tarifas'
], function ($router) {
    Route::get('/{centro}/list', [TarifaController::class, 'index']);
    Route::get('/{centro}', [TarifaController::class, 'show']);
    Route::get('/{tarifa}/articulos', [TarifaController::class, 'getArticulos']);
    Route::get('/{tarifa}/notArticulos', [TarifaController::class, 'getNotArticulos']);
    Route::put('/{tarifa}/edit', [TarifaController::class, 'update']);
    Route::post('/create', [TarifaController::class, 'store']);
    Route::post('/{tarifa}/articulos', [TarifaController::class, 'addArticulo']);
    Route::delete('/{tarifa}', [TarifaController::class, 'destroy']);
    Route::put('/{tarifa}/default', [TarifaController::class, 'tarifaPorDefecto']);
});

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'impuestos'
], function ($router) {
    Route::get('/list', [ImpuestoController::class, 'index']);
});

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'precios'
], function ($router) {
    Route::put('/{precio}/edit', [PrecioController::class, 'update']);
    Route::delete('/{precio}', [PrecioController::class, 'destroy']);
});

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'perfiles'
], function ($router) {
    Route::get('/{centro}/list', [TrabajadorController::class, 'index']);
    Route::put('/{trabajador}/edit', [TrabajadorController::class, 'update']);
    Route::put('/{trabajador}/status', [TrabajadorController::class, 'chgStatus']);
    Route::post('/create', [TrabajadorController::class, 'store']);
    Route::delete('/{trabajador}', [TrabajadorController::class, 'destroy']);
});

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'clientes'
], function ($router) {
    Route::get('/{centro}/list', [ClienteController::class, 'index']);
    Route::get('/{cliente}', [ClienteController::class, 'show']);
    Route::put('/{cliente}/edit', [ClienteController::class, 'update']);
    Route::post('/create', [ClienteController::class, 'store']);
    Route::delete('/{cliente}', [ClienteController::class, 'destroy']);
    Route::put('/{cliente}/mailstatus', [ClienteController::class, 'updateStatusCorreo']);
});

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'puntosVenta'
], function ($router) {
    Route::get('/{centro}/list', [PosController::class, 'index']);
    Route::put('/{pos}/edit', [PosController::class, 'update']);
    Route::post('/create', [PosController::class, 'store']);
    Route::put('/{pos}/status', [PosController::class, 'chgStatus']);
    Route::put('/{pos}/regenerarToken', [PosController::class, 'regenerarToken']);
});

Route::group([
    'middleware' => ['posToken'],
    'prefix' => 'pos'
], function ($router) {
    Route::get('/centro', [gposcontroller::class, 'index']);
    Route::get('/familias', [gposcontroller::class, 'familias']);
    Route::get('/articulos', [gposcontroller::class, 'articulos']);
    Route::get('/clientes', [gposcontroller::class, 'clientes']);
    Route::get('/perfiles', [gposcontroller::class, 'perfiles']);
    Route::post('/perfil/auth', [gposcontroller::class, 'authTrabajador']);
});