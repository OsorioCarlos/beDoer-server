<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $members = Member::all();

        if ($members) {
            return response()->json([
                'members' => $members,
                'message' => 'successful'
            ], 200);
        } else {
            return response()->json([
                'message' => 'source not found'
            ], 404);
        }
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

        $category = new Category();
        $category->name = $data['name'];
        $category->deleted = false;

        $category->save();

        return response()->json([
            'message' => 'categoria creada'
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
        $category = Category::find($id);

        if ($category) {
            return response()->json([
                'response' => $category,
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
//        $validations = $request->validate([
//            'name' => 'required',
//        ]);
        $category = Category::find($id);

        if ($category && $request->name != null) {

            $category->name = $request->name;
            $category->deleted = false;
            $category->save();

            return response()->json([
                'message' => 'categoria editada',
                'categoria' => $category
            ], 200);
        } else {
            return response()->json([
                'message' => 'categoria no encontrada',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();

            return response()->json([
                'message' => 'categoria eliminada',
                'categoria' => $category
            ], 200);
        } else {
            return response()->json([
                'message' => 'categoria no encontrada',
            ], 200);
        }

    }
}
