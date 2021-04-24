<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Task;
use App\Models\Team;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $state
     * @return JsonResponse
     */

    public function indexUserTasks(Request $request, $state): JsonResponse
    {
        $user = $request->user();
        $tasks = $user->tasks()
            ->where('deleted', false)
            ->where('state_id', $state)
            ->get();

        $tasksNotState = $user->tasks()->where('state_id', 1)->count();
        $tasksToDo = $user->tasks()->where('state_id', 2)->count();
        $tasksDoing = $user->tasks()->where('state_id', 3)->count();
        $tasksDone = $user->tasks()->where('state_id', 4)->count();

        return response()->json([
            'data' => $tasks,
            'totalStates' => [
                'tasksNotState' =>$tasksNotState,
                'tasksToDo' => $tasksToDo,
                'tasksDoing' => $tasksDoing,
                'tasksDone' => $tasksDone
            ],
            'message' => 'Tareas de usuario obtenidas con éxito'
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */

    public function indexTeamTasks($id)
    {
        $team = Team::find($id);
        $tasks = $team->tasks()->where('deleted', false)->get();

        return response()->json([
            'data' => $tasks,
            'message' => 'tareas de equipo obtenidas con éxito'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeUserTasks(storeUserTasks $request): JsonResponse
    {
        $user = $request->user();

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
     * @param Request $request
     * @return JsonResponse
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
     * @param \App\Models\Task $task
     * @return JsonResponse
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
     * @param Request $request
     * @param \App\Models\Task $task
     * @return JsonResponse
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
     * @param \App\Models\Task $task
     * @return JsonResponse
     */
    public function destroy(Task $task)
    {
        $task->deleted = true;
        $task->save();

        return response()->json([
            'message' => 'tarea eliminada con éxito'
        ], 200);
    }
}
