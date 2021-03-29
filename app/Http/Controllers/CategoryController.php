<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
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
     * @param $id
     * @return JsonResponse
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
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
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
     * @param $id
     * @return JsonResponse
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
