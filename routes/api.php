<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rutas de la Rest Api de Be-Doer
|
*/
Route::post('login', [UserController::class, 'login'])->withoutMiddleware('auth:api');
Route::post('register', [UserController::class, 'store'])->withoutMiddleware('auth:api');
Route::get('logout', [UserController::class, 'logout']);
Route::post('test', [UserController::class, 'test']);


Route::apiResource('users', UserController::class)->except('store');

/* Rutas Task */
Route::apiResource('tasks', TaskController::class);

Route::group(['prefix' => 'team-tasks'], function () {
    Route::get('{id}/{state}', [TaskController::class, 'indexTeamTasks']);
    Route::post('', [TaskController::class, 'storeTeamTasks']);
});
Route::group(['prefix' => 'user-tasks'], function () {
    Route::get('index/{state}', [TaskController::class, 'indexUserTasks']);
    Route::post('', [TaskController::class, 'storeUserTasks']);
});

/* Rutas Teams */
Route::apiResource('teams', TeamController::class);

/* ruta para miembros de un equipo */
Route::apiResource('members', MemberController::class);

/* Rutas Role  */
Route::apiResource('roles', RoleController::class);

/* ruta para etiquetas */
Route::apiResource('tags', TagController::class);

/* ruta para estados */
Route::get('states', [StateController::class, 'getStates']);

/* ruta para categorías */
Route::get('categories', [CategoryController::class, 'index']);
