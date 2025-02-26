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
        $tasks = Task::all(); 
        // dd($tasks);                       
        return view('tasks.index', compact('tasks', 'statusesArr', 'taskstatuses', 'username'));
    }
    
    public function create()
    {
        $statusesArr = TaskStatus::cases();        
        $statuses = array_column($statusesArr, 'name');
        $username = Auth::user()->name; 
        $users = User::orderBy('name')->pluck('name', 'id');
        $clients = Client::orderBy('name')->pluck('name', 'id');
        $taskstatuses = ['In Progress', 'Submitted', 'Approved', 'Paid'];
        //dd($taskstatuses[1]);
        return view('tasks.create', compact('clients', 'users', 'statuses', 'taskstatuses', 'username'));        
    }

    public function store(SaveRequest $request)
    {
        $vat = $request->budget / 90 * 10 * $request->vatpercentage / 100;       
        $data = $request->only(['client_id', 'task', 'wordcount', 'budget', 'vatpercentage', 'performance', 'duedate', 'user_id', 'taskstatus', 'status']);
        $data['vat'] = $vat;
        Task::create($data);
        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $username = Auth::user()->name;
        return view('tasks.show', compact('task', 'username'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $statusesArr = TaskStatus::cases();
        $username = Auth::user()->name;                
        $collection  = collect($statusesArr);
        $statuses = $collection->pluck('name', 'value');        
        $clients = Client::orderBy('name')->pluck('name', 'id');
        $users = User::orderBy('name')->pluck('name', 'id');
        $taskstatuses = ['In Progress', 'Submitted', 'Approved', 'Paid'];                   
        return view('tasks.edit', compact('task', 'clients', 'users', 'taskstatuses', 'username'));        
    }

    public function update(SaveRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $request->only(['task', 'wordcount', 'budget', 'vatpercentage', 'performance', 'duedate', 'user_id', 'taskstatus']);
        $vat = $request->budget / 90 * 10 * $request->vatpercentage / 100;
        $data['vat'] = $vat;
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
        $username = Auth::user()->name;
        $sum = Task::onlyTrashed()
        ->sum('budget');
        $sumspent = Spending::all()
        ->sum('amount');
        $sumvat = Task::onlyTrashed()
        ->sum('vat');
        $taskstatuses = ['In Progress', 'Submitted', 'Approved', 'Paid'];
        return view('tasks.trash', compact('performedtasks', 'sum', 'sumspent', 'taskstatuses', 'username','sumvat'));        
    }

    public function updateStatus(Request $request)
    {
        $ids = $request->ids;
        // $newStatus = $request->dataStatus;               
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
        $totalsum = Task::onlyTrashed()
        ->sum('budget');

        $clients = Client::orderBy('name', 'ASC')->get();
        return view('earnings.earningsbyclients', compact('clients', 'totalsum', 'username'));        
    }

    public function earningsbyusers()
    {        
        $users = User::orderBy('name', 'ASC')->get();
        $username = Auth::user()->name;
        return view('earnings.earningsbyusers', compact('users', 'username'));
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

        return view('workload.totalworkload', compact('totalwordcount', 'username'));
    }

    public function workloadperuser()
    {

        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
        $username = Auth::user()->name;

        /*$wordcountandrey = Task::onlyTrashed()
        ->where('author', 'Andrey')
        ->whereBetween('deleted_at', [$weekStartDate, $weekEndDate])
        ->sum('wordcount');

        $wordcountelena = Task::onlyTrashed()
        ->where('author', 'Elena')
        ->whereBetween('deleted_at', [$weekStartDate, $weekEndDate])
        ->sum('wordcount');*/

        $users = User::orderBy('name', 'ASC')->get();
        return view('workload.workloadperuser', compact('users', 'weekStartDate', 'weekEndDate', 'username'));
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
