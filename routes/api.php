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
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StateController;

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

/* Rutas Teams */
Route::apiResource('teams', TeamController::class);

/* Rutas Categories */
Route::apiResource('categories', CategoryController::class);

/* Rutas Task */
Route::apiResource('tasks', TaskController::class);

/* Rutas Role  */
Route::apiResource("roles", RoleController::class);

/* ruta para etiquetas */
Route::apiResource('tags', TagController::class);

/* ruta para usuarios */
Route::apiResource('users', UserController::class);

/* ruta para estados */
Route::apiResource('states', StateController::class);

/* ruta para miembros de un equipo */
Route::apiResource('members', MemberController::class);
