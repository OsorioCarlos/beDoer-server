<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();

        if ($users) {
            return response()->json([
                'users' => $users,
                'message' => 'successful'
            ], 200);
        } else {
            return response()->json([
                'users' => $users,
                'message' => 'source not found'
            ], 404);
        }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->deleted = false;

        $user->save();

        return response()->json([
            'message' => 'usuario creado'
        ], 200);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'response' => $user,
                'message' => 'successful'
            ], 200);
        } else {
            return response()->json([
                'response' => $user,
                'message' => 'source not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    
}
