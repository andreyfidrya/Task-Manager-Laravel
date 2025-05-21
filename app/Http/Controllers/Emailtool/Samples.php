<?php

namespace App\Http\Controllers\Emailtool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Samples\Save as SaveRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Sample;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class Samples extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        $samples = Sample::paginate(10);
        return view('emails.samples.index', compact('samples', 'username'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        $size = DB::table('topics')->count();        

        return view('emails.samples.create', [
            'topics' => Topic::orderBy('name')->pluck('name', 'id'),                                               
        ], compact('size', 'username'));
        
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
        $username = Auth::user()->name;
        $size = DB::table('topics')->count();
        $sample = Sample::findOrFail($id);
        $topics = Topic::orderBy('name')->pluck('name', 'id');
        return view('emails.samples.edit', compact('sample', 'topics', 'size', 'username'));        
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
        $sample = Sample::findOrFail($id);
        $sample->topics()->detach();
        $sample->delete();
        return redirect()->route('samples.index');
    }
}
