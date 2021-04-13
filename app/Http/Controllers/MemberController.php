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
    public function getMembers($id)
    {
        $team = Team::find($id);
        $users = $team->users()->where('team_user.deleted', false)->get();

        return response()->json([
            'data' => $users,
            'message' => 'miembros obtenidos con éxito'
        ]);
    }
}
