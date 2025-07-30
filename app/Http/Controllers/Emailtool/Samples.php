<?php

namespace App\Http\Controllers\Emailtool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Samples\Save as SaveRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Sample;
use App\Models\Topic;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class Samples extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        $samples = Sample::paginate(10);

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('emails.samples.index', compact('unread_notifications', 'unread_notifications_number', 'samples', 'username', 'profile_image'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        $size = DB::table('topics')->count();
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('emails.samples.create', [
            'topics' => Topic::orderBy('name')->pluck('name', 'id'),                                               
        ], compact( 'unread_notifications', 'unread_notifications_number', 'size', 'username', 'profile_image'));
        
    }

    public function store(SaveRequest $request)
    {
        $data = $request->validated();            
        $sample = Sample::create($data);
        $sample->topics()->sync($data['topics']);

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return redirect()->route('samples.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $username = Auth::user()->name;
        $size = DB::table('topics')->count();
        $sample = Sample::findOrFail($id);
        $topics = Topic::orderBy('name')->pluck('name', 'id');

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('emails.samples.edit', compact('unread_notifications', 'unread_notifications_number', 'sample', 'topics', 'size', 'username', 'profile_image'));        
    }

    public function update(SaveRequest $request, $id)
    {
        $data = $request->validated();
        $sample = Sample::findOrFail($id);
        $sample->update($data);
        $sample->topics()->sync($data['topics']);
        return redirect()->route('samples.index');
    }

    public function destroy($id)
    {
        $sample = Sample::findOrFail($id);
        $sample->topics()->detach();
        $sample->delete();
        return redirect()->route('samples.index');
    }
}
