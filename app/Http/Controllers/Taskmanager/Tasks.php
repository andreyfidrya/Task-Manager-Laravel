<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Client;
use App\Models\Spending;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Tasks\Save as SaveRequest;
use App\Enums\Task\Status as TaskStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Tasks extends Controller
{
    public function index()
    {
        $statusesArr = TaskStatus::cases();
        $taskstatuses = ['In Progress', 'Submitted', 'Approved', 'Paid'];
        $username = Auth::user()->name;        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;                   
        $tasks = Task::all();
        $clients = Client::all();
        $users = User::all();

        return view('tasks.index', compact('tasks', 'clients', 'users', 'profile_image', 'statusesArr', 'taskstatuses', 'username'));
    }
    
    public function create()
    {
        $statusesArr = TaskStatus::cases();        
        $statuses = array_column($statusesArr, 'name');
        $username = Auth::user()->name; 
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
        $users = User::orderBy('name')->pluck('name', 'id');
        $clients = Client::orderBy('name')->pluck('name', 'id');
        $taskstatuses = ['In Progress', 'Submitted', 'Approved', 'Paid'];

        return view('tasks.create', compact('clients', 'users', 'profile_image', 'statuses', 'taskstatuses', 'username', 'profile_image'));        
    }

    public function store(SaveRequest $request)
    {
        $vat = $request->budget / (100 - $request->feepercentage) * $request->feepercentage * $request->vatpercentage / 100;       
        $data = $request->only(['client_id', 'task', 'wordcount', 'budget', 'feepercentage', 'vatpercentage', 'performance', 'duedate', 'user_id', 'taskstatus', 'status']);
        $data['vat'] = $vat;
        
        Task::create($data);
        toastr()->success('A task has been added successfully!');

        return redirect()->route('tasks.index');        
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $username = Auth::user()->name;

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('tasks.show', compact('task', 'profile_image', 'username'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $statusesArr = TaskStatus::cases();
        $username = Auth::user()->name; 
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;               
        $collection  = collect($statusesArr);
        $statuses = $collection->pluck('name', 'value');        
        $clients = Client::orderBy('name')->pluck('name', 'id');
        $users = User::orderBy('name')->pluck('name', 'id');
        $taskstatuses = ['In Progress', 'Submitted', 'Approved', 'Paid'];  

        return view('tasks.edit', compact('task', 'clients', 'users', 'profile_image', 'taskstatuses', 'username'));        
    }

    public function update(SaveRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $request->only(['task', 'wordcount', 'budget', 'feepercentage', 'vatpercentage', 'performance', 'duedate', 'user_id', 'taskstatus']);
        $vat = $request->budget / (100 - $request->feepercentage) * $request->feepercentage * $request->vatpercentage / 100;
        $data['vat'] = $vat;
        $task->update($data);

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        toastr()->success('A task has been removed successfully!');

        return redirect()->route('tasks.index');
    }

    public function trash()
    {
        $performedtasks = Task::onlyTrashed()->get();
        $username = Auth::user()->name;
        $sum = Task::onlyTrashed()
        ->sum('budget');
        $sumspent = Spending::all()
        ->sum('amount');
        $sumvat = Task::onlyTrashed()
        ->sum('vat');
        $taskstatuses = ['In Progress', 'Submitted', 'Approved', 'Paid'];
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('tasks.trash', compact('performedtasks', 'profile_image', 'sum', 'sumspent', 'taskstatuses', 'username','sumvat'));        
    }

    public function updateStatus(Request $request)
    {
        $ids = $request->ids;                    
        Task::whereIn('id',explode(",",$ids))->update(['taskstatus' => 3]); 

        return redirect()->route('tasks.index'); 
    }

    public function removeMulti(Request $request)
    {
        $today = date("Y-m-d");

        DB::table('spendings')->insert([
            'spending' => 'Withdrawal',
            'amount' => 1,
            'date' => $today           
        ]);        
        
        $ids = $request->ids;
        Task::whereIn('id',explode(",",$ids))->delete();

        return response()->json(['status'=>true,'message'=>"Tasks have been successfully removed."]);       
    }

    public function removeMultiSpendings(Request $request)
    {
        $ids = $request->ids;
        Spending::whereIn('id',explode(",",$ids))->delete();

        return response()->json(['status'=>true,'message'=>"Spendings have been successfully removed."]);         
    }

    public function removeMultiForever(Request $request)
    {
        $ids = $request->ids;
        Task::whereIn('id',explode(",",$ids))->forceDelete();

        return response()->json(['status'=>true,'message'=>"Tasks have been successfully removed forever."]);         
    }

    public function earningsbyclients()
    {
        $performedtasks = Task::onlyTrashed()->get();
        $username = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
        $totalsum = Task::onlyTrashed()->sum('budget');
        $clients = Client::orderBy('name', 'ASC')->get();

        $earningsofclients = [];

        foreach ($clients as $client) {
            $sum = $client->tasks()->onlyTrashed()->sum('budget');
            if ($sum > 0) {
                $earningsofclients[] = [
                    'name' => $client->name,
                    'sum' => $sum
                ];
            }
        }
                
        return view('earnings.earningsbyclients', compact('clients', 'totalsum', 'username', 'profile_image', 'earningsofclients'));        
    }

    public function earningsbyusers()
    {        
        $users = User::orderBy('name', 'ASC')->get();
        $username = Auth::user()->name;
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('earnings.earningsbyusers', compact('users', 'profile_image', 'username'));
    }

    public function totalworkload()
    {
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
        
        $totalwordcount = Task::onlyTrashed()
        ->whereBetween('deleted_at', [$weekStartDate, $weekEndDate])
        ->sum('wordcount');
        
        $username = Auth::user()->name;

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('workload.totalworkload', compact('totalwordcount', 'profile_image', 'username'));
    }

    public function workloadperuser()
    {
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
        $username = Auth::user()->name;

        $users = User::orderBy('name', 'ASC')->get();

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        return view('workload.workloadperuser', compact('users', 'profile_image', 'weekStartDate', 'weekEndDate', 'username'));
    }

    public function restoretask($id){
        $restoredproducts = Task::onlyTrashed()->findOrFail($id);
        $restoredproducts->restore();
        return redirect()->route('performedtasks');
    }

    public function destroytaskForever($id){
        Task::onlyTrashed()->findOrFail($id)->forceDelete(); 
        return redirect()->route('performedtasks');       
    }

    public function addtasksbyajax(Request $request){
        $today = date("Y-m-d");
        
        $data = new Task;        

        $data->client_id = $request->client_id;
        $data->task = $request->task;
        $data->budget = $request->budget;
        $data->duedate = $request->duedate;
        $data->user_id = $request->user_id;
        $data->taskstatus = '3';
        $data->wordcount = NULL;
        $data->performance = NULL;
        $data->feepercentage = 0;
        $data->vatpercentage = 0;
        $data->vat = 0;
        $data->deleted_at = $today;

        $data->save();

        return response()->json([]);       
    }
}
