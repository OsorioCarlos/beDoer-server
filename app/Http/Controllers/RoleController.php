<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json([
            'data' => $roles,
            'message' => 'roles obtenidos con éxito'
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

        $role = new Role();
        $role->name = $data['name'];

        $role->save();

        return response()->json([
            'message' => 'rol creado con éxito'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $role = Role::find($id);
        return response()->json([
            'data' => $role,
            'message' => 'rol obtenido con éxito'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        $data = $request->json()->all();
        $role = Role::find($id);

        $role->name = $data['name'];

        $role->save();

        return response()->json([
            'message' => 'rol editado con éxito'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        $role = Role::find($id);
        $role->deleted = true;
        $role->save();

        return response()->json([
            'message' => 'rol eliminado con éxito'
        ]);
    }
}
