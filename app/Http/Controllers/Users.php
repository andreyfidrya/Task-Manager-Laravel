<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Carbon\Carbon;
use App\Models\Annualearning;
use App\Models\Spending;
use App\Models\Task;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Users extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;
        return view('users.index', [
            'users' => User::all()
        ], compact('username'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        return view('users.create', compact('username'));
    }

    public function store(SaveRequest $request)
    {
        $data = $request->only(['name', 'email', 'about']);
        $password = Hash::make($request->password);
        $data['password'] = $password;           

        User::create($data);
        return redirect()->route('users.index');
    }

    public function show(string $id)
    {
        $username = Auth::user()->name;
        $user = User::firstOrFail($id);
        return view('users.show', compact('user', 'username'));
    }

    public function edit(string $id)
    {
        $username = Auth::user()->name;
        $user = User::findOrFail($id);
        return view('users.edit', compact('user', 'username'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);
        
        $user = User::findOrFail($id);
        $data = $request->only(['name', 'email', 'about']);
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
            
        return view('users.profile', compact('username','user','currentmonth','lastMonth','earningsforlastMonth', 'totalspendings','earningsofclients','numberofclients', 'tasksinprogressforuser','clientsWithAnyTasks', 'numberofactiveclients'));
    }

    public function updatepersonalinfo(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        
        $user->address = $request->address;
        $user->address2 = $request->address2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip = $request->zip;

        $user->save();

        return response()->json([]);
    }
    
}
