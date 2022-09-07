<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Crud\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API don't need authentication
Route::post('logout', [AuthController::class, 'logout']);
Route::post('login', [AuthController::class, 'login']);
Route::post('create', [UserController::class, 'store']);

// API need token authentication
Route::middleware('auth:api')->group( function () {
        Route::middleware('restrict')->group( function () {
            Route::get('show', [UserController::class, 'index']);
            Route::get('show/{id}', [UserController::class, 'show']);
            Route::post('update/{id}', [UserController::class, 'update']);
            Route::post('delete/{id}', [UserController::class, 'destroy']);
    });
    
});
