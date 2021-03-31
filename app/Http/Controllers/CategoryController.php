<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Muestra categorias que no esten borradas.
     *
     * @return JsonResponse
     */
    public function index()
    {

        $categories = Category::where('deleted', false)->get();

        if ($categories) {
            return response()->json([
                'message' => 'successful',
                'data' => $categories
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
            'message' => 'category create'
        ], 201);
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
                'message' => 'successful',
                'data' => $category
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
                'message' => 'category edited',
                'data' => $category
            ], 200);
        } else {
            return response()->json([
                'message' => 'not found',
            ], 404);
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
                'message' => 'category deleted'
            ], 204);
        } else {
            return response()->json([
                'message' => 'not found',
            ], 200);
        }
    }

}
