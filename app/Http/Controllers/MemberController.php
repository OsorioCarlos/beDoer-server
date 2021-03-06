<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $team = Team::find($id);

        if ($team->leader_id == $request->user()->id) {
            $users = $team->users()->get();
            return response()->json([
                'data' => [
                    'team' => $team,
                    'members' => $users,
                ],
                'message' => 'miembros obtenidos con éxito'
            ], 200);
        }
        return response()->json([
            'data' => null,
            'message' => 'no tienes acceso a esta información'
        ], 403);
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
        $user = User::where('email', $request->input('user_email'))->get();
        
        if($user->contains('email', $request->input('user_email')))
        {
            $team->users()->attach($user);

            return response()->json([
                'message' => 'miembro agregado con éxito'
            ], 201);
        }

        return response()->json([
            'message' => 'no se pudo agregar al miembro'
        ], 400);
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

        if ($request->input('user_id') == 0) {
            $team->users()->detach($request->user());
        } else {
            $team->users()->detach($request->input('user_id'));
        }

        return response()->json([
            'message' => 'miembro removido con éxito'
        ], 201);
    }
}
