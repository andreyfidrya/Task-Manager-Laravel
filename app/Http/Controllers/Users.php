<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\Save as SaveRequest;

class Users extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(SaveRequest $request)
    {
        $data = $request->only(['name', 'email']);
        $password = Hash::make($request->password);
        $data['password'] = $password;           

        User::create($data);
        return redirect()->route('users.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);
        
        $user = User::findOrFail($id);
        $data = $request->only(['name', 'email']);
        $user->update($data);
        return redirect()->route('users.index');
    }

    public function destroy(string $id)
    {
        //
    }
}
