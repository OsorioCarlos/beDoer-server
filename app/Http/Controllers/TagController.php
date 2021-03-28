<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $tags = Tag::all();
        return response()->json([
            'tags' => $tags
        ]);

        // $tags = Tag::get();
        // return response()->json([
        //     'data' => [
        //         'tags' => $tags
        //     ],
        //     'message' => [
        //         'summary' => 'success',
        //         'detail' => '',
        //         'code' => '200'
        //     ]
        // ]);
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

        $tag = new Tag();
        $tag->name = $data['name'];
        $tag->color = $data['color'];
        $tag->is_deleted = false;

        $tag->save();

        return response()->json([
            'tags' => $tag
        ]);

        // $data = $request->json()->all();

        // $tag = new Tag();
        // $tag->name = $data['name'];
        // $tag->color = $data['color'];
        // $tag->is_deleted = false;

        // $tag->save();

        // return response()->json([
        //     'data' => [
        //         'tag' => $tag
        //     ]
        // ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return response()->json([
            'tags' => $tag
        ]);

        // return response()->json([
        //     'data' => [
        //         'tags' => $tag
        //     ]], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $tag = Tag::find($id);

        $tag->name = $data['name'];
        $tag->color = $data['color'];

        $tag->save();

        return response()->json([
            'tags' => $tag
        ]);

        // $data = $request->json()->all();

        // $tag->name = $data['name'];
        // $tag->color = $data['color'];

        // $tag->save();
        // return response()->json([
        //     'data' => [
        //         'tag' => $tag
        //     ]
        // ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->is_deleted = true;
        $tag->delete();

        return response()->json([
            'tags' => $tag
        ]);

        // $tag->is_deleted = true;
        // $tag->save();

        // return response()->json([
        //     'data' => [
        //         'tag' => $tag
        //     ]
        // ], 201);
    }
}
