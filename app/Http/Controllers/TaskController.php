<?php

namespace App\Http\Controllers;


use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->json()->all();

        // Devuelve todas las tareas de un usuario
        if ($data['team_id'] == null && $data['user_id'] != null) {
            $tasks = Task::where('created_by', $data['user_id'])
                ->where('deleted', false)
                // ->join('tag_tasks', 'tasks.id', '=', 'tag_tasks.task_id')
                // ->join('tags', 'tags.id', '=', 'tag_tasks.tag_id')
                // ->select('tasks.id', 'tasks.title', 'tasks.description', 'tasks.expiration_date', 'tags.name as tag_name', 'tasks.state_id')
                ->with('tag_tasks')
                ->get();
        }

        // Devuelve todas las tareas de un equipo
        if ($data['team_id'] != null && $data['user_id'] == null) {
            $tasks = Task::where('teamspace', $data['team_id'])
            ->where('deleted', false)
            ->select('id', 'title', 'description', 'expiration_date', 'state_id')
            ->get();
        }
        
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

        $task->save();

        return response()->json([
            'data' => [
                'task' => $task
            ]
        ], 201);
    }
   
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
                'task' => $task
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
        $task->deleted = true;
        $task->save();
        
        return response()->json([
            'task' => $task
        ]);
    }
}
