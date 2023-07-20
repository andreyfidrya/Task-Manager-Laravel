<?php

namespace App\Http\Controllers\Emailtool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Samples\Save as SaveRequest;
use App\Models\Sample;
use App\Models\Topic;

class Samples extends Controller
{
    public function index()
    {
        $samples = Sample::all();
        return view('emails.samples.index', compact('samples'));
    }

    public function create()
    {
        return view('emails.samples.create', [
            'topics' => Topic::orderByDesc('name')->pluck('name', 'id')
        ]);
    }

    public function store(SaveRequest $request)
    {
        $data = $request->validated();
        $sample = Sample::create($data);
        $sample->topics()->sync($data['topics']);
        return redirect()->route('samples.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $sample = Sample::findOrFail($id);
        $topics = Topic::orderByDesc('name')->pluck('name', 'id');
        return view('emails.samples.edit', compact('sample', 'topics'));
    }

    public function update(SaveRequest $request, $id)
    {
        $data = $request->validated();
        $sample = Sample::findOrFail($id);
        $sample->update($data);
        $sample->topics()->sync($data['topics']);
        return redirect()->route('samples.index');
    }

    public function destroy($id)
    {
        
    }
}
