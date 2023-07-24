<?php

namespace App\Http\Controllers\Emailtool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Email;
use App\Http\Requests\Topics\Save as SaveRequest;

class Topics extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        return view('emails.topics.index', compact('topics'));
    }

    public function create()
    {
        return view('emails.topics.create');
    }

    public function store(SaveRequest $request)
    {
        $data = $request->only(['slug', 'name']);
        Topic::create($data);
        return redirect()->route('topics.index');
    }

    public function show($slug)
    {
        $topic = Topic::where('slug', $slug)->firstOrFail();
        $email = Email::first();
        return view('emails.topics.show', compact('topic', 'email'));
    }

    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        return view('emails.topics.edit', compact('topic'));
    }

    public function update(SaveRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $data = $request->only(['slug', 'name']);
        $topic->update($data);
        return redirect()->route('topics.index');
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return redirect()->route('topics.index');
    }
}
