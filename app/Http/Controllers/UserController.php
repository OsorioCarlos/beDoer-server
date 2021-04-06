<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::where('deleted', false)->get();

        if (!is_null($users)) {
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
    public function store(CreateUserRequest $request): JsonResponse
    {
        $data = $request->all();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'] = Hash::make($request->password);

//        User::create($user);
        $user->save();

        return response()->json([
            'message' => 'user created'
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->where('deleted', false)->first();

        if (!is_null($user) && Hash::check($request->password, $user->password)) {
            $user->api_token = Str::random(100);
            $user->save();

            return response()->json([
                'message' => 'logging successful',
                'token' => $user->api_token
            ], 200);
        } else {
            return response()->json([
                'message' => 'wrong credentials'
            ], 205);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $user = auth()->user();
        $user->api_token = null;

        return response()->json([
            'message' => 'logout successful',
        ], 200);

    }

    /**
     * Display the specified resource.
     * @param $name
     * @return JsonResponse
     */
    public function show($name): JsonResponse
    {
        $user = User::where('name', $name)->where('deleted', false)->first();

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
     * @param User $name
     * @return JsonResponse
     */
    public function destroy(User $name): JsonResponse
    {
        $user = User::where('name', $name)->first();

        if (!is_null($user)) {
            $user->deleted = true;
            $user->save();

            return response()->json([
                'message' => 'category deleted'
            ], 204);
        } else {
            return response()->json([
                'message' => 'not found',
            ], 200);
        }
    }
    
}
