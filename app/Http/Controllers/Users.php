<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Users extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        return view('users.index', [
            'users' => User::all()
        ], compact('username'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        return view('users.create', compact('username'));
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
        $username = Auth::user()->name;
        $user = User::firstOrFail($id);
        return view('users.show', compact('user', 'username'));
    }

    public function edit(string $id)
    {
        $username = Auth::user()->name;
        $user = User::findOrFail($id);
        return view('users.edit', compact('user', 'username'));
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

    public function profile()
    {
        $username = Auth::user()->name;
        return view('users.profile', compact('username'));
    }
}
