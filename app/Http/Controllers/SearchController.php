<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Sample;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        //$data = Topic::select("name as value", "id")
        //            ->where('name', 'LIKE', '%'. $request->get('search'). '%')
        //            ->get();
        $data = Sample::select("title as value", "id")
                    ->where('title', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
        return response()->json($data);
    }
}
