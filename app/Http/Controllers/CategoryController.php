<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dotenv\Validator;
use http\Env\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::all();

        if ($categories) {
            return response()->json([
                'categories' => $categories,
                'message' => 'successful'
            ], 200);
        } else {
            return response()->json([
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
     * @param \App\Models\Category $category
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
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
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
     * @param \App\Models\Category $category
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
