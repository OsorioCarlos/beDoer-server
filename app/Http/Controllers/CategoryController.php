<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
                'data' => $categories,
                'message' => 'categorías obtenidas con éxito'
            ], 200);
        }

        return response()->json([
            'message' => 'no se encontraron categorías'
        ], 404);
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

        $category->save();

        return response()->json([
            'message' => 'categoría creada con éxito'
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
                'data' => $category,
                'message' => 'categoría obtenida con éxito'
            ], 200);
        } else {
            return response()->json([
                'message' => 'no se encontró la categoría'
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
            $category->save();

            return response()->json([
                'message' => 'categoría editada con éxito'
            ], 200);
        } else {
            return response()->json([
                'message' => 'error al editar la categoría',
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
            $category->deleted = true;
            $category->save();

            return response()->json([
                'message' => 'categoría eliminada con éxito'
            ], 204);
        } else {
            return response()->json([
                'message' => 'error al eliminar la categoría'
            ], 200);
        }
    }

}
