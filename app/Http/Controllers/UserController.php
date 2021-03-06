<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserRequest\CreateUserRequest;
use App\Http\Requests\UserRequest\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Enlista todos los usuarios que no esten borrados.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!is_null($user)) {
            return response()->json([
                'data' => $user,
                'message' => 'usuario obtenido con éxito'
            ], 200);
        }

        return response()->json([
            'message' => 'no se encontraron usuarios'
        ], 404);
    }

    /**
     * Crea un usuario.
     *
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request): JsonResponse
    {
        $data = $request->all();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'] = Hash::make($request->password);

        $user->save();

        $userCreted = User::where('email', $request->email)->where('deleted', false)->first();
        $token = $userCreted->createToken('user-token');

        return response()->json([
            'message' => 'usuario creado con éxito',
            'token' => $token->plainTextToken,
        ], 201);
    }

    /**
     * Login de un usuario
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->where('deleted', false)->first();

        if (!is_null($user) && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('user-token'); //sanctum libreria para generar los tokens

            $user->save();

            return response()->json([
                'token' => $token->plainTextToken,
                'message' => 'usuario logueado con éxito',
            ], 200);
        }

        return response()->json([
            'message' => 'credenciales incorrectas'
        ], 205);

    }

    /**
     * Logout de un usuario.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'usuario des-logueado con éxito',
        ], 200);

    }

    /**
     * Visualizacion de un suario por nombre.
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'data' => null,
            'message' => 'no data'
        ], 200);
    }

    /**
     * Actualizacion de los datos del usuario logeado.
     *
     * @param UpdateUserRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $data = $request->json()->all();

        $user->name = $data['name'];
        $user->email = $data['email'];

        if ($user->password != null) {
            $user->password = $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->save();

        return response()->json([
            'message' => 'usuario editado con éxito'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $user = User::where('id', $id)->first();

        if (!is_null($user)) {
            $user->deleted = true;
            $user->save();

            return response()->json([
                'message' => 'usuario eliminado con éxito'
            ], 204);
        }

        return response()->json([
            'message' => 'error al eliminar el usuario',
        ], 200);
    }

}

