<?php

namespace App\Http\Controllers\Emailtool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class Answers extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        $answer = Answer::first();  
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('answers.index', compact('unread_notifications', 'unread_notifications_number', 'answer', 'username', 'profile_image'));
    }
}
