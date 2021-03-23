<?php

// Laravel
use Brick\Math\Exception\RoundingNecessaryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

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

Route::apiResource('teams', TeamController::class);

Route::apiResource('categories', CategoryController::class);

/* Rutas Task */
Route::get("/tasks", [TaskController::class, 'index']);

/* Rutas Role */
Route::get("/roles", [RoleController::class, 'index']);

// ruta para etiquetas
Route::apiResource('tags', TagController::class);
