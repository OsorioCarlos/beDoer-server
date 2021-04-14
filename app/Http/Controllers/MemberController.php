<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $team = Team::find($id);
        $users = $team->users()->where('team_user.deleted', false)->get();

        return response()->json([
            'data' => $users,
            'message' => 'miembros obtenidos con éxito'
        ], 200);
    }

     /**
     * Add members to team.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $team = Team::findOrFail($request->input('team_id'));
        $team->users()->attach($request->input('user_id'));

        return response()->json([
            'message' => 'miembro agregado con éxito'
        ], 201);
    }
    
    /**
     * Remove members to team.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $team->users()->detach($request->input('user_id'));

        return response()->json([
            'message' => 'miembro removido con éxito'
        ], 201);
    }
}
