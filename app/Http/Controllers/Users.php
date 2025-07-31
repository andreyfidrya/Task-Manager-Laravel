<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Carbon\Carbon;
use App\Models\Annualearning;
use App\Models\Spending;
use App\Models\Task;
use App\Models\Client;
use App\Models\Chat;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class Users extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('users.index', [
            'users' => User::all()
        ], compact('unread_notifications', 'unread_notifications_number', 'username', 'profile_image'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('users.create', compact('unread_notifications', 'unread_notifications_number', 'username', 'profile_image'));
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
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('users.show', compact('unread_notifications', 'unread_notifications_number', 'user', 'username', 'profile_image'));
    }

    public function edit(string $id)
    {
        $username = Auth::user()->name;
        $user = User::findOrFail($id);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('users.edit', compact('unread_notifications', 'unread_notifications_number', 'user', 'username', 'profile_image'));
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
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }

    public function profile(Request $request)
    {
        $now = Carbon::now();
        $currentmonth = \Carbon\Carbon::now()->format('F'); 
        $lastMonth = Carbon::now()->subMonth()->format('F');               
        
        $username = Auth::user()->name;
        $userID = Auth::user()->id;
        $user = User::findOrFail($userID);
        $profile_image = $user->profile_image;
        
        $earningsforlastMonth = DB::table('annualearnings')
        ->where('month',$lastMonth)
        ->where('earnings_source',Auth::user()->name)
        ->first();        
        
        $sumspent = Spending::all()
        ->sum('amount');
        $sumvat = Task::onlyTrashed()
        ->sum('vat');
        $totalspendings = $sumspent + $sumvat;
        
        $clients = Client::orderBy('name', 'ASC')->get();

        $earningsofclients = [];

        $numberofclients = 0;

        foreach ($clients as $client) {
            $sum = $client->tasks()->onlyTrashed()->where('user_id',$userID)->sum('budget');
            if ($sum > 0) {                
                $earningsofclients[] = [
                    'name' => $client->name,
                    'sum' => $sum
                ];
            $numberofclients++;    
            }
        }
        
        $tasksinprogressforuser = Task::where('user_id',$userID)->where('taskstatus',0)->get();
         
        $clientsWithAnyTasks = $request->ajax() ? Client::whereHas('tasks', function ($query) use ($userID) {
        $query->withTrashed()->where('user_id', $userID);
        })->get() : Client::whereHas('tasks', function ($query) use ($userID) {
        $query->withTrashed()->where('user_id', $userID);
        })->limit(3)->get(); 
        
        $numberofactiveclients = Client::whereHas('tasks', function ($query) use ($userID) {
        $query->withTrashed()->where('user_id', $userID);
        })->count();

        if ($request->ajax()) {
        return response()->json($clientsWithAnyTasks);
        }     
              
        $profilecompletion = 0;

        if ($user->profile_image) {
            $profilecompletion += 25;
        }

        if ($user->about && $user->phone && $user->address && $user->address2 && $user->city && $user->state && $user->zip) {
            $profilecompletion += 25;
        }

        if ($user->facebook || $user->twitter || $user->linkedin) {
            $profilecompletion += 25;
        }

        if ($numberofactiveclients > 0) {
            $profilecompletion += 25;
        } 
        
        $chats = Chat::where('user_id', $userID)->orderBy('created_at', 'desc')->get();   
        
        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();
            
        return view('users.profile', compact('unread_notifications', 'unread_notifications_number', 'username','user','currentmonth','lastMonth','earningsforlastMonth', 'totalspendings','earningsofclients','numberofclients', 'tasksinprogressforuser','clientsWithAnyTasks', 'numberofactiveclients', 'profilecompletion', 'chats', 'profile_image'));
    }

    public function updatepersonalinfo(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        
        $user->about = $request->about;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->address2 = $request->address2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip = $request->zip;

        $user->save();

        return response()->json([]);
    }

    public function updatesocialmedia(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->linkedin = $request->linkedin;        

        $user->save();

        return response()->json([]);
    }

    public function account_security_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => ['required','confirmed', Rules\Password::defaults()],
            'new_password_confirmation' => 'required'           
        ]);

        $request->user()->forceFill([
            'password' => Hash::make($request->new_password)            
        ])->save();

        return redirect()->route('users.profile')->with('status', 'Password has been changed!');
    }

    public function updateProfileImage(Request $request)
    {
    $request->validate([
        'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = auth()->user();

    $imageName = time() . '.' . $request->profile_image->extension();
    $request->profile_image->move(public_path('images/profiles'), $imageName);

    // Optional: delete old image
    if ($user->profile_image && file_exists(public_path('images/profiles/' . $user->profile_image))) {
        unlink(public_path('images/profiles/' . $user->profile_image));
    }

    $user->profile_image = $imageName;
    $user->save();

    return back()->with('status', 'Profile image updated successfully!');
    }

    public function updateProfileStatus(Request $request)
    {
        $userId = Auth::user()->id;

        $data = new Chat;

        $data->user_id = $userId;
        $data->message = $request->message; 

        $data->save();

        return response()->json([]);
    }

    public function UserProfileMessages()
    {
        $username = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
        $chats = Chat::with('user')->get();

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();
        
        return view('users.messages', compact('unread_notifications', 'unread_notifications_number', 'username','chats','profile_image'));
    }

    public function MessagesDelete($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->delete();
        return redirect()->route('user.profile.messages');
    }
}
