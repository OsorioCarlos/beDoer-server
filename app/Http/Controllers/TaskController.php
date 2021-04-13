<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Task;
use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function indexUserTasks($id)
    {
        $user = User::find($id);
        $tasks = $user->tasks()->where('deleted', false)->get();

        return response()->json([
            'data' => $tasks,
            'message' => 'tareas de usuario obtenidas con éxito'
        ]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function indexTeamTasks($id)
    {
        $team = Team::find($id);
        $tasks = $team->tasks()->where('deleted', false)->get();

        return response()->json([
            'data' => $tasks,
            'message' => 'tareas de equipo obtenidas con éxito'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeUserTasks(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->expiration_date = $request->input('expiration_date');
        $task->state()->associate(State::findOrFail($request->input('state_id')));

        $user->tasks()->save($task);

        return response()->json([
            'message' => 'tarea de usuario creada con éxito'
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeTeamTasks(Request $request)
    {
        $team = Team::findOrFail($request->input('team_id'));

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->expiration_date = $request->input('expiration_date');
        $task->state()->associate(State::findOrFail($request->input('state_id')));

        $team->tasks()->save($task);

        return response()->json([
            'message' => 'tarea de equipo creada con éxito'
        ], 201);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Task $task)
    {
        return response()->json([
            'data' => $task,
            'message' => 'tarea obtenida con éxito'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Task $task)
    {
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->expiration_date = $request->input('expiration_date');
        $task->state()->associate(State::findOrFail($request->input('state_id')));
        
        $task->save();

        return response()->json([
            'message' => 'tarea editada con éxito'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task)
    {
        $task->deleted = true;
        $task->save();

        return response()->json([
            'message' => 'tarea eliminada con éxito'
        ]);
    }


}
