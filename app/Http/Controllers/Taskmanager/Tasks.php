<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Client;
use App\Models\Spending;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\Tasks\Save as SaveRequest;
use App\Enums\Task\Status as TaskStatus;

class Tasks extends Controller
{
    public function index()
    {
        $statusesArr = TaskStatus::cases();
        $taskstatuses = ['In Progress', 'Submitted', 'Approved', 'Paid'];
        //$statuses = array_column($statusesArr, 'name');
        //dd($taskstatuses);         
        $tasks = Task::all();                        
        return view('tasks.index', compact('tasks', 'statusesArr', 'taskstatuses'));
    }
    
    public function create()
    {
        $statusesArr = TaskStatus::cases();        
        $statuses = array_column($statusesArr, 'name'); 
        //dd($statuses[1]); 
        $users = User::orderBy('name')->pluck('name', 'id');
        $clients = Client::orderBy('name')->pluck('name', 'id');
        $taskstatuses = ['In Progress', 'Submitted', 'Approved', 'Paid'];
        //dd($taskstatuses[1]);
        return view('tasks.create', compact('clients', 'users', 'statuses', 'taskstatuses'));        
    }

    public function store(SaveRequest $request)
    {
        // $status = TaskStatus::INPROGRESS;        
        
        $data = $request->only(['client_id', 'task', 'wordcount', 'budget', 'performance', 'duedate', 'user_id', 'taskstatus', 'status']);
        // $data['status'] = $status;
        Task::create($data);
        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        //dd($task->status);        
        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $statusesArr = TaskStatus::cases();                
        $collection  = collect($statusesArr);
        //dd($collection);
        //$statuses = array_column($statusesArr, 'name');  
        $statuses = $collection->pluck('name', 'value');        
        $clients = Client::orderBy('name')->pluck('name', 'id');
        $users = User::orderBy('name')->pluck('name', 'id');
        $taskstatuses = ['In Progress', 'Submitted', 'Approved', 'Paid'];
        //dd($taskstatuses);              
        return view('tasks.edit', compact('task', 'clients', 'users', /*'statuses',*/ 'taskstatuses'));        
    }

    public function update(SaveRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $request->only(['task', 'wordcount', 'budget', 'performance', 'duedate', 'user_id', /*'status',*/ 'taskstatus']);
        $task->update($data);
        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function trash()
    {
        $performedtasks = Task::onlyTrashed()->get();
        $sum = Task::onlyTrashed()
        ->sum('budget');
        $sumspent = Spending::all()
        ->sum('amount');
        $taskstatuses = ['In Progress', 'Submitted', 'Approved', 'Paid'];
        //dd($taskstatuses[0]);
        return view('tasks.trash', compact('performedtasks', 'sum', 'sumspent', 'taskstatuses'));        
    }

    public function earningsbyclients()
    {
        $performedtasks = Task::onlyTrashed()->get();
        $totalsum = Task::onlyTrashed()
        ->sum('budget');

        $clients = Client::orderBy('name', 'ASC')->get();
        return view('earnings.earningsbyclients', compact('clients', 'totalsum'));        
    }

    public function earningsbyusers()
    {        
        $users = User::orderBy('name', 'ASC')->get();
        return view('earnings.earningsbyusers', compact('users'));
    }

    public function totalworkload()
    {
       
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
        
        $totalwordcount = Task::onlyTrashed()
        ->whereBetween('deleted_at', [$weekStartDate, $weekEndDate])
        ->sum('wordcount');
        

        return view('workload.totalworkload', compact('totalwordcount'));
    }

    public function workloadperuser()
    {

        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');

        /*$wordcountandrey = Task::onlyTrashed()
        ->where('author', 'Andrey')
        ->whereBetween('deleted_at', [$weekStartDate, $weekEndDate])
        ->sum('wordcount');

        $wordcountelena = Task::onlyTrashed()
        ->where('author', 'Elena')
        ->whereBetween('deleted_at', [$weekStartDate, $weekEndDate])
        ->sum('wordcount');*/

        $users = User::orderBy('name', 'ASC')->get();
        return view('workload.workloadperuser', compact('users', 'weekStartDate', 'weekEndDate'));
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
}
