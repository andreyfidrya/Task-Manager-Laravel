<?php

namespace App\Http\Controllers\Emailtool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;

class Topics extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        return view('emails.topics.index', compact('topics'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
