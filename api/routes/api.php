<?php

use App\Http\Controllers\LevelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'store']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::group(['as' => 'users', 'prefix' => 'users'], function() {
        Route::get('logout', [UserController::class, 'logout']);
        Route::post('me', [UserController::class, 'getUser']);
        Route::delete('{user}', [UserController::class, 'delete']);
        Route::put('{user}', [UserController::class, 'edit']);
    });

    Route::apiResource('cours', 'App\Http\Controllers\CoursController');
    Route::apiResource('levels', 'App\Http\Controllers\LevelController');
    Route::apiResource('lessons', 'App\Http\Controllers\LessonController');
    Route::apiResource('specialities', 'App\Http\Controllers\SpecialityController');
});