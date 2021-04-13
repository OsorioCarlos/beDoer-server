<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function getStates()
    {
        $states = State::get();

        return response()->json([
            'data' => $states,
            'message' => 'estados obtenidos con éxito'
        ]);
    }
}
