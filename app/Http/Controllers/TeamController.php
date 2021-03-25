<?php

namespace App\Http\Controllers;


use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    
    public function index()
    {
        //
        $teams = Team::all();
        return response()->json([
            'teams' => $teams
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data = $request->json()->all();

        $team = new Team();
        $team-> name = $data['name'];
        $team->description = $data['description'];
        $team->is_deleted = false;

        $team->save();

        return response()->json([
            'teams' => $team
        ]);
    }


    public function show($id)
    {
        
        $team = Team::find($id);
        return response()->json([
            'teams' => $team
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $team = Team::find($id);

        $team-> name = $data['name'];
        $team->description = $data['description'];
        $team->is_deleted = false;

        $team->save();

        return response()->json([
            'teams' => $team
        ]);
    }

    
    public function destroy($id)
    {
        $team = Team::find($id);
        $team->is_deleted = true;
        $team->delete();

        return response()->json([
            'teams' => $team
        ]);
    }
}
