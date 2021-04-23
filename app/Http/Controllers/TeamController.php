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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {   
        $user = $request->user();

        // Mis equipos
        $my_teams = $user->teams()->where('leader_id', $user->id)->where('deleted', false)->get();
        // Equipos a los que pertenezco
        $other_teams = $user->teams()->where('leader_id', '<>', $user->id)->where('deleted', false)->get();

        return response()->json([
            'data' => ['my_teams' => $my_teams, 'other_teams'=> $other_teams],
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
        $team->leader()->associate($request->user());
        
        $team->save();

        $team->users()->attach($request->user());

        return response()->json([
            'message' => 'equipo creado con éxito'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     *  @param  Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($team)
    {
        return response()->json([
            'data' => null,
            'message' => 'no data'
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
