<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::where('deleted', false)->get();

        if ($users) {
            return response()->json([
                'message' => 'successful',
                'data' => $users
            ], 200);
        } else {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
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
            'message' => 'user created'
        ], 201);
    }

    /**
     * Display the specified resource.
     * @return JsonResponse
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
                'message' => 'not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }
}
