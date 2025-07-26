<?php

namespace App\Http\Controllers\Emailtool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Sample;
use App\Models\Email;
use App\Models\User;
use App\Http\Requests\Topics\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Topics extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        $topics = Topic::orderBy('name')->paginate(10);
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('emails.topics.index', compact('topics', 'username', 'profile_image'));
    }

    public function create()
    {
        $username = Auth::user()->name;

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('emails.topics.create', compact('username', 'profile_image'));
    }

    public function store(SaveRequest $request)
    {
        $username = Auth::user()->name;
        $data = $request->only(['slug', 'name']);
        Topic::create($data);
        return redirect()->route('topics.index');
    }

    public function show($slug)
    {
        $username = Auth::user()->name;
        $topic = Topic::where('slug', $slug)->firstOrFail();
        $email = Email::first();

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('emails.topics.show', compact('topic', 'email', 'username', 'profile_image'));
    }

    public function edit($id)
    {
        $username = Auth::user()->name;
        $topic = Topic::findOrFail($id);

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('emails.topics.edit', compact('topic', 'username', 'profile_image'));
    }

    public function update(SaveRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $data = $request->only(['slug', 'name']);
        $topic->update($data);
        return redirect()->route('topics.index');
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return redirect()->route('topics.index');
    }

    public function search(Request $request){
        $username = Auth::user()->name;
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $topics = Topic::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();

        $samples = Sample::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('url', 'LIKE', "%{$search}%")
            ->get();
        
        // Return the search view with the resluts compacted
        return view('emails.search', compact('topics', 'samples', 'username'));
    }
    
}
