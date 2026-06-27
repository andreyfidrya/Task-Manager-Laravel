<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Response;

class SearchResponseController extends Controller
{
    public function autocomplete(Request $request)
    {
        $search = $request->get('search');

        $data = Response::select('title as value', 'id')
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();

        return response()->json($data);
    }
}
