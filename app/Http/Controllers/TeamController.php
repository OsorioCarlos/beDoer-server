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
        $teams = Team::all();

        return response()->json([
            'teams' => $teams
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $team = new Team();
        $team-> name = $data['name'];
        $team->description = $data['description'];

        $team->save();

        return response()->json([
            'teams' => $team
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);
        $teams = $user->teams()->get();

        return response()->json([
            'teams' => $teams
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,  $id)
    {
        $data = $request->json()->all();
        $team = Team::find($id);

        $team-> name = $data['name'];
        $team->description = $data['description'];

        $team->save();

        return response()->json([
            'teams' => null
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        $team->deleted = true;
        $team->save();

        return response()->json([
            'teams' => null
        ]);
    }

}
