<?php

namespace App\Http\Controllers\Answertool;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\User;
use App\Models\Notification;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Http\Requests\Responses\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Responses extends Controller
{
    public function index()
    {
        $username = Auth::user()->name; 
        $answer = Answer::first();
        $responses = Response::orderBy('title')->paginate(10);          
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();        

        return view('answers.responses.index', compact('unread_notifications', 'unread_notifications_number', 'username', 'profile_image', 'responses'));
    }

    public function create()
    {
        $username = Auth::user()->name;

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('answers.responses.create', compact('unread_notifications', 'unread_notifications_number', 'username', 'profile_image'));
    }

    public function store(SaveRequest $request)
    {
        $username = Auth::user()->name;
        $data = $request->only(['title', 'description']);
        Response::create($data);
        
        return redirect()->route('responses.index');
    }
   
    public function show(string $id)
    {
        $username = Auth::user()->name;
        $response = Response::findOrFail($id);
        $answer = Answer::first();

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('answers.responses.show', compact('unread_notifications', 'unread_notifications_number', 'response', 'answer', 'username', 'profile_image'));
    }

    public function edit(string $id)
    {
        $username = Auth::user()->name;
        $response = Response::findOrFail($id);

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('answers.responses.edit', compact('unread_notifications', 'unread_notifications_number', 'response', 'username', 'profile_image'));
    }

    public function update(Request $request, string $id)
    {
        $response = Response::findOrFail($id);
        $data = $request->only(['title', 'description']);
        $response->update($data);
        return redirect()->route('responses.index');
    }

    public function destroy(string $id)
    {
        $response = Response::findOrFail($id);
        $response->delete();
        return redirect()->route('responses.index');
    }

    public function searchresponses(Request $request){      
        $username = Auth::user()->name;
        // Get the search value from the request
        $search = $request->input('search-responses');        

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
        
        // Search in the title and body columns from the posts table
        $responses = Response::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();        

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('answers.search-responses', compact('unread_notifications', 'unread_notifications_number', 'username', 'profile_image', 'responses'));        
    }
}
