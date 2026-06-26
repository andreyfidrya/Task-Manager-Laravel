<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Response;

class SearchResponseController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Response::select("title as value", "id")
                    ->where('title', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
        return response()->json($data);
    }
}
