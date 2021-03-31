<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
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

/* Rutas Teams */
Route::apiResource('teams', TeamController::class);

/* Rutas Categories */
Route::apiResource('categories', CategoryController::class);

/* Rutas Task */
Route::apiResource('tasks', TaskController::class);
Route::group(['prefix' => 'team-tasks'], function () {
    Route::get('{id}', [TaskController::class, 'indexTeamTasks']);
    Route::post('', [TaskController::class, 'storeTeamTasks']);
});
Route::group(['prefix' => 'user-tasks'], function () {
    Route::get('{id}', [TaskController::class, 'indexUserTasks']);
    Route::post('', [TaskController::class, 'storeUserTasks']);
});

/* Rutas Role  */
Route::apiResource("roles", RoleController::class);

/* ruta para etiquetas */
Route::apiResource('tags', TagController::class);

/* ruta para usuarios */
Route::apiResource('users', UserController::class);

/* ruta para estados */
Route::get('states', [StateController::class, 'getStates']);

/* ruta para miembros de un equipo */
Route::apiResource('members', MemberController::class);

