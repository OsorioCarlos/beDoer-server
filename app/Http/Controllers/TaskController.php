<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Task::get();
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $task = new Task();
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->expiration_date = $data['expiration_date'];
        $task->state_id = $data['state_id'];
        $task->created_by = $data['created_by'];
        $task->teamspace = $data['teamspace'];
        $task->is_deleted = false;

        $task->save();

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
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    
    public function show(Task $task)
    {
        return response()->json([
            'data' => [
                'tasks' => $task
            ]], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->json()->all();

        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->expiration_date = $data['expiration_date'];
        $task->state_id = $data['state_id'];
        $task->created_by = $data['created_by'];
        $task->teamspace = $data['teamspace'];

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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->is_deleted = true;
        $task->save();

        return response()->json([
            'data' => [
                'task' => $task
            ]
        ], 201);
    }
}
