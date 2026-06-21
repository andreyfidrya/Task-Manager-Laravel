<?php

namespace App\Http\Controllers\Answertool;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Responses extends Controller
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

        return view('answers.responses.index', compact('unread_notifications', 'unread_notifications_number', 'username', 'profile_image'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
   
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
