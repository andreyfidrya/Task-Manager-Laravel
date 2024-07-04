<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\Clients\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Clients extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        $clients = Client::orderBy('name', 'ASC')->get();
        return view('clients.index', compact('clients', 'username'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        return view('clients.create', compact('username'));
    }

    public function store(SaveRequest $request)
    {
        $data = $request->only(['name', 'slug', 'info', 'price']);
        Client::create($data);
        return redirect()->route('clients.index');
    }

    public function show($slug)
    {
        $username = Auth::user()->name;
        $client = Client::where('slug', $slug)->firstOrFail();
        return view('clients.show', compact('client', 'username'));
    }

    public function edit($id)
    {
        $username = Auth::user()->name;
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client', 'username')); 
    }

    public function update(SaveRequest $request, string $id)
    {
        $client = Client::findOrFail($id);
        $data = $request->only(['name', 'slug', 'info', 'price']);
        $client->update($data);
        return redirect()->route('clients.index');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index');
    }

    public function trash()
    {
        $username = Auth::user()->name;
        $inactiveclients = Client::orderBy('name', 'ASC')->onlyTrashed()->get();
        return view('clients.trash', compact('inactiveclients', 'username'));
    }

    public function restoreclient($id){
        $restoredproducts = Client::onlyTrashed()->findOrFail($id);
        $restoredproducts->restore();
        return redirect()->route('inactiveclients');
    }

    public function destroyclientForever($id){
        Client::onlyTrashed()->findOrFail($id)->forceDelete();  
        return redirect()->route('inactiveclients');      
    }
}
