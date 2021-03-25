<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {

        $roles = Role::all();
        return response()->json([
            'roles' => $roles
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

        $role = new Role();
        $role->name = $data['name'];
        $role->is_deleted = false;

        $role->save();

        return response()->json([
            'roles' => $role
        ]);
    }


    public function show($id)
    {

        $role = Role::find($id);
        return response()->json([
            'roles' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }


    public function update(Request $request, $id)
    {

        $data = $request->json()->all();
        $role = new Role($id);

        $role->name = $data['name'];
        $role->is_deleted = false;

        $role->save();

        return response()->json([
            'roles' => $role
        ]);
    }


    public function destroy($id)
    {

        $role = Role::find($id);
        $role->is_deleted = true;
        $role->delete();

        return response()->json([
            'roles' => $role
        ]);
    }
}
