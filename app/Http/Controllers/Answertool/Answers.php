<?php

namespace App\Http\Controllers\Answertool;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\User;
use App\Models\Notification;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Answers\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Answers extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;          
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        $categories_before_main_text = Category::where('beforemaintext', 1)->get();
        $categories_after_main_text = Category::where('beforemaintext', 0)->get();

        // dd($categories_after_main_text);

        return view('answers.index', compact('unread_notifications', 'unread_notifications_number', 'username', 'profile_image'));
    }

    public function edit()
    {
        $username = Auth::user()->name;
        $answer = Answer::first();

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('answers.edit', compact('unread_notifications', 'unread_notifications_number', 'answer', 'username', 'profile_image'));
    }

    public function update(SaveRequest $request, $id)
    {
        

        return redirect()->route('answers.index');
    }
}
