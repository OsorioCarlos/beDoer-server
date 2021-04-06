<?php

namespace App\Http\Controllers;

use App\Models\TeamUser;
use App\Models\Team;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMembers($id)
    {
        $team = Team::find($id);
        $users = $team->users()->where('team_user.deleted', false)->get();

        return response()->json([
            'data' => [
                'users' => $users
            ],
            'msg' => [
                'summary' => 'success',
                'detail' => '',
                'code' => '200'
             ]
            ],);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $member = new TeamUser();
        $member->user_id = $data['user_id'];
        $member->team_id = $data['team_id'];
        $member->rol_id = $data['rol'];

        $member->save();

        return response()->json([
            'message' => 'miembro creado'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $member = TeamUser::find($id);

        if ($member) {
            return response()->json([
                'response' => $member,
                'message' => 'successful'
            ], 200);
        } else {
            return response()->json([
                'message' => 'source not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $member = TeamUser::find($id);
        $member->user_id = $data['user_id'];
        $member->team_id = $data['team_id'];
        $member->rol_id = $data['rol'];

        $member->save();

        return response()->json([
            'message' =>'miembro editado',
            'members' => $member
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $member = TeamUser::find($id);
        $member->is_deleted = true;

        return response()->json([
            'message' => 'Miembro eliminado',
            'members' => $member
        ],200);

    }
}
