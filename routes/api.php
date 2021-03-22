<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use Brick\Math\Exception\RoundingNecessaryException;
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

/* Route::apiResource('team', TeamController::class); */
/* Rutas Task */
Route::get("/tasks", [TaskController::class, 'index']);

/* Rutas Team */
Route::get("/teams", [TeamController::class, 'index']);

/* Rutas Role */

Route::get("/roles", [RoleController::class, 'index']);
