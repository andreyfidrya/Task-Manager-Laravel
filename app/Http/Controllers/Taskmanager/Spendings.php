<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Spending;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Requests\Spendings\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Spendings extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        $spendings = Spending::all();
        $sumspent = Spending::all()
        ->sum('amount');
        $sumvat = Task::onlyTrashed()
        ->sum('vat');
        $totalspendings = $sumspent + $sumvat; 
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
        
        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();
        
        return view('spendings.index', compact('unread_notifications', 'unread_notifications_number', 'spendings', 'sumspent', 'username', 'sumvat', 'totalspendings', 'profile_image'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('spendings.create', compact('unread_notifications', 'unread_notifications_number', 'username', 'profile_image'));
    }

    public function store(SaveRequest $request)
    {
        $data = $request->only(['spending', 'amount', 'date']);
        Spending::create($data);
        return redirect()->route('spendings.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $username = Auth::user()->name;
        $expense = Spending::findOrFail($id);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('spendings.edit', compact('unread_notifications', 'unread_notifications_number', 'expense', 'username', 'profile_image'));
    }

    public function update(SaveRequest $request, $id)
    {
        $expense = Spending::findOrFail($id);
        $data = $request->only(['spending', 'amount', 'date']);
        $expense->update($data);
        return redirect()->route('spendings.index');
    }

    public function destroy($id)
    {
        $expense = Spending::findOrFail($id);
        $expense->delete();
        return redirect()->route('spendings.index');
    }

    public function upload(Request $request)
    {
        $data = new Spending;        

        $data->spending = $request->spending;
        $data->amount = $request->amount;
        $data->date = $request->date;

        $data->save();

        return response()->json([]);
    }
}
