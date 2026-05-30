<?php

namespace App\Http\Controllers\Answertool;

use App\Http\Controllers\Controller;
use App\Models\Script;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Notification;
use App\Http\Requests\Scripts\Save as SaveRequest;

class Scripts extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;          
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        $categories = Category::orderBy('priority')->get();

        return view(
            'answers.scripts.index', 
            compact(
                'unread_notifications', 
                'unread_notifications_number', 
                'username', 
                'profile_image', 
                'categories'
                )
            );
    }

    public function create()
    {
        $username = Auth::user()->name;

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        $categories = Category::orderBy('priority')->get();

        return view('answers.scripts.create', compact(
            'unread_notifications', 
            'unread_notifications_number', 
            'username', 
            'profile_image',
            'categories'
        ));
    }

    public function store(SaveRequest $request)
    {
        $data = $request->only(['name', 'category_id']);
        Script::create($data);
        
        return redirect()->route('scripts.index');
    }

    public function show(Script $script)
    {
        //
    }

    public function edit(Script $script)
    {
        //
    }

    public function update(Request $request, Script $script)
    {
        //
    }

    public function destroy(Script $script)
    {
        //
    }
}
