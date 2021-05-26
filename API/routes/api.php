<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD

=======
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoItemController;
use App\Http\Controllers\SocialAuthController;
>>>>>>> develop
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
<<<<<<< HEAD

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
=======
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
        Route::get ('day', [TodoItemController::class, 'getDayItems']);
        Route::get ('week', [TodoItemController::class, 'getWeekItems']);
        Route::post ('store', [TodoItemController::class, 'store']);
        Route::post ('delete', [TodoItemController::class, 'destroy']);
        Route::post ('add-memo', [TodoItemController::class, 'addMemo']);
        Route::post ('complete', [TodoItemController::class, 'completeItem']);
        Route::post ('pin', [TodoItemController::class, 'pinItem']);
    });
>>>>>>> develop
});
