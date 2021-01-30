<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\UserController;
use App\Http\Controllers\HabitacionController;

Route::post('login', [UserController::class, 'login']);
Route::post('users', [UserController::class, 'store']);

Route::middleware(['auth:api'])->group(function () {
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::apiResource('habitaciones', HabitacionController::class);
});
