<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoItemController;
use App\Http\Controllers\SocialAuthController;
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
Route::group(['prefix' => 'auth'], function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['prefix' => '{service}'], function () {
        Route::get ('login', [SocialAuthController::class, 'redirect']);
        Route::get ('callback', [SocialAuthController::class, 'findOrCreate']);
        Route::post ('validate', [SocialAuthController::class, 'validateToken']);
    });

});


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('auth/user', [AuthController::class, 'current']);

    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'todo-items'], function () {
        Route::post ('store', [TodoItemController::class, 'store']);
        Route::post ('delete', [TodoItemController::class, 'delete']);
        Route::post ('validate', [TodoItemController::class, 'validateToken']);
    });
});
