<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $notifications = Notification::with('user')->get();

        return view('notifications.index', compact('notifications', 'profile_image', 'username'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
        $users = User::all()->pluck('name', 'id');

        return view('notifications.create', compact('profile_image', 'username', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['user_id', 'text', 'date', 'is_read']);
        Notification::create($data);
        
        return redirect()->route('notifications.index');
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        $username = Auth::user()->name;
        $notification = Notification::findOrFail($id);
        $users = User::all()->pluck('name', 'id');

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('notifications.edit', compact('notification', 'users', 'username', 'profile_image'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->only(['user_id', 'text', 'date', 'is_read']);
        Notification::findOrFail($id)->update($data);

        return redirect()->route('notifications.index');
    }

    public function destroy(string $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return redirect()->route('notifications.index');
    }
}
