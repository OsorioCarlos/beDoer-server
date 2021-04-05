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
| Rutas de la REst Api de Be-Doer
|
*/

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'store']);
//Route::apiResource('users', UserController::class)->except('store');

Route::middleware(['auth:api', function(){
    Route::apiResource('users', UserController::class)->except('store');
}]);


/* Rutas Categories */
//esta en group fix, en el caso de que se requiera mas funcionalidad en el controlador.
Route::group(['prefix' => 'categories'], function () {
    Route::get('', [CategoryController::class, 'index']);
});

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

/* ruta para estados */
Route::get('states', [StateController::class, 'getStates']);

/* ruta para miembros de un equipo */
Route::get('members', [MemberController::class, 'getMembers']);

/* Rutas Teams */
Route::apiResource('teams', TeamController::class);

