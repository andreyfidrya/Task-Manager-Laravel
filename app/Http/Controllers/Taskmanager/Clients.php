<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\Clients\Save as SaveRequest;

class Clients extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(SaveRequest $request)
    {
        $data = $request->only(['name', 'slug', 'info']);
        Client::create($data);
        return redirect()->route('clients.index');
    }

    public function show($slug)
    {
        $client = Client::where('slug', $slug)->firstOrFail();
        return view('clients.show', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client')); 
    }

    public function update(SaveRequest $request, string $id)
    {
        $client = Client::findOrFail($id);
        $data = $request->only(['name', 'slug', 'info']);
        $client->update($data);
        return redirect()->route('clients.index');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index');
    }
}
