<?php

namespace App\Http\Controllers;

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
            'data' => [
                'tasks' => $tasks
            ],
            'msg' => [
                'summary' => 'success',
                'detail' => '',
                'code' => '200'
            ]
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
            'data' => [
                'tasks' => $tasks
            ],
            'msg' => [
                'summary' => 'success',
                'detail' => '',
                'code' => '200'
            ]
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
        $data = $request->json()->all();

        $user = User::find($data['user_id']);

        $task = new Task();
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->expiration_date = $data['expiration_date'];
        $task->state_id = $data['state_id'];

        $user->tasks()->save($task);

        return response()->json([
            'data' => [
                'task' => $task
            ]
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
        $data = $request->json()->all();

        $team = Team::find($data['team_id']);

        $task = new Task();
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->expiration_date = $data['expiration_date'];
        $task->state_id = $data['state_id'];

        $team->tasks()->save($task);

        return response()->json([
            'data' => [
                'task' => $task
            ]
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
            'data' => [
                'task' => $task,
            ]], 200);
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
        $data = $request->json()->all();

        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->expiration_date = $data['expiration_date'];
        $task->state_id = $data['state_id'];

        $task->save();
        return response()->json([
            'data' => [
                'task' => $task
            ]
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
            'task' => $task
        ]);
    }
}
