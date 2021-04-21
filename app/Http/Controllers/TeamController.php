<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {   
        // $request->user();

        $teams = Team::all();

        return response()->json([
            'data' => $teams,
            'message' => 'equipos obtenidos con éxito'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $team = new Team();
        $team->name = $request->input('name');
        $team->description = $request->input('description');

        $team->save();

        $team->users()->attach($request->input('user_id'), ['team_id' => $team->id, 'is_member' => false]);

        return response()->json([
            'message' => 'equipo creado con éxito'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::findOrfail($id);

        // Mis equipos
        $my_teams = $user->teams()->where('is_member', false)->where('deleted', false)->get();
        // Equipos a los que pertenezco
        $other_teams = $user->teams()->where('is_member', true)->get();

        return response()->json([
            'data' => ['my_teams' => $my_teams, 'other_teams'=> $other_teams],
            'message' => 'equipos obtenidos con éxito'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Team $team)
    {
        $team->name = $request->input('name');
        $team->description = $request->input('description');

        $team->save();

        return response()->json([
            'message' => 'equipo editado con éxito'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Team $team)
    {
        $team->deleted = true;
        $team->save();

        return response()->json([
            'message' => 'equipo eliminado con éxito'
        ], 200);
    }
}
