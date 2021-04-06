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
    public function index(Request $request)
    {
        $data = $request->json()->all();
        /*         
        $roles = Role::all();
        return response()->json([
            'roles' => $roles
        ]); 
        */
        // Obtener todas los roles creados por un equipo

        if ($data['team_id'] != null && $data['user_id'] == null) {
            $roles = Role::where('teamspace', $data['team_id'])
                ->where('deleted', false)
                ->select('id', 'title')
                ->get();
        }

        return response()->json([
            'roles' => $roles
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
            'roles' => $role
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
            'roles' => $role
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
            'roles' => $role
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
            'roles' => $role
        ]);
    }
}
