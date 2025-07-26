<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\Clients\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Clients extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        $clients = Client::orderBy('name', 'ASC')->get();
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
        return view('clients.index', compact('clients', 'username','profile_image'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
        return view('clients.create', compact('username','profile_image'));
    }

    public function store(SaveRequest $request)
    {
        $current_timestamp = Carbon::now()->timestamp;
        $data = $request->only(['name', 'slug', 'info', 'price']);
        
        if($request->hasFile('image'))
        {  
            $image = $request->file('image');                                               
            $imageName = $current_timestamp . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);  
            $data['image'] = $imageName;    
        }
           
        Client::create($data);
        return redirect()->route('clients.index');
    }

    public function show($slug)
    {
        $username = Auth::user()->name;
        $client = Client::where('slug', $slug)->firstOrFail();
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
        return view('clients.show', compact('client', 'username','profile_image'));
    }

    public function edit($id)
    {
        $username = Auth::user()->name;
        $client = Client::findOrFail($id);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
        return view('clients.edit', compact('client', 'username','profile_image')); 
    }

    public function update(SaveRequest $request, string $id)
    {
        $client = Client::findOrFail($id);
        $current_timestamp = Carbon::now()->timestamp;
        $data = $request->only(['name', 'slug', 'info', 'price']);

        if($request->hasFile('image'))
        {  
            $image = $request->file('image');                                               
            $imageName = $current_timestamp . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);  
            $data['image'] = $imageName;    
        }
        
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
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
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
