<?php

namespace App\Http\Controllers;

use App\Http\Requests\task\storeUserTasks;
use App\Models\State;
use App\Models\Task;
use App\Models\Team;

use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * retorna las tareas del usuario segun el estado de la tarea
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

        $tasksNotState = $user->tasks()->where('state_id', 1)->where('deleted', false)->count();
        $tasksToDo = $user->tasks()->where('state_id', 2)->where('deleted', false)->count();
        $tasksDoing = $user->tasks()->where('state_id', 3)->where('deleted', false)->count();
        $tasksDone = $user->tasks()->where('state_id', 4)->where('deleted', false)->count();

        return response()->json([
            'data' => $tasks,
            'totalStates' => [
                'tasksNotState' => $tasksNotState,
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
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */

    public function indexTeamTasks(Request $request, $id, $state)
    {
        $team = Team::find($id);
        $members = $team->users()->get();

        if ($members->contains($request->user())) {
            $tasks = $team->tasks()
            ->where('deleted', false)
            ->where('state_id', $state)
            ->get();

            $NotState = $team->tasks()->where('state_id', 1)->where('deleted', false)->count();
            $ToDo = $team->tasks()->where('state_id', 2)->where('deleted', false)->count();
            $Doing = $team->tasks()->where('state_id', 3)->where('deleted', false)->count();
            $Done = $team->tasks()->where('state_id', 4)->where('deleted', false)->count();

            return response()->json([
                'data' => $tasks,
                'totalStates' => [
                    'tasksNotState' => $NotState,
                    'tasksToDo' => $ToDo,
                    'tasksDoing' => $Doing,
                    'tasksDone' => $Done
                ],
                'message' => 'tareas de equipo obtenidas con éxito'
            ], 200);
        }

        return response()->json([
            'data' => null,
            'message' => 'no tienes acceso a esta información'
        ], 403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param storeUserTasks $request
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
     * @param Task $task
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
     * @param Task $task
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
     * @param Task $task
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

    public function changeState(Request $request){

        $task = Task::find($request->input('id'));
        $state = State::findOrFail($request->input('state_id'));
        $task->state_id = $state->id;
//        $state = State::findOrFail($request->input('state_id'));

        $task->save();

        return response()->json([
            'data' => $state,
            'dataA' => $task,
            'message' => 'tarea editada con éxito',
        ], 201);
    }
}
