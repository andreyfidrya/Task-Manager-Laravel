<?php

namespace App\Http\Controllers\Answertool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Script;
use App\Models\Answer;
use App\Models\User;
use App\Models\Notification;
use App\Http\Requests\Categories\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Categories extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;    

        $categories = Category::orderBy('name', 'asc')->get();       
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('answers.categories.index', compact('unread_notifications', 'unread_notifications_number', 'categories', 'username', 'profile_image'));
    }

    public function create()
    {
        $username = Auth::user()->name;

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('answers.categories.create', compact('unread_notifications', 'unread_notifications_number', 'username', 'profile_image'));
    }

    public function store(SaveRequest $request)
    {
        $username = Auth::user()->name;
        $data = $request->only(['name', 'slug', 'beforemaintext', 'priority']);
        Category::create($data);
        
        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        $username = Auth::user()->name;

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        $category = Category::findOrFail($id);

        return view('answers.categories.edit', compact('unread_notifications', 'unread_notifications_number', 'category', 'profile_image', 'username'));
    }

    public function update(SaveRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->only(['name','slug','priority']);
        
        $category->update($data);

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        //
    }
}
