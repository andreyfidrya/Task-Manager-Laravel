<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Client;
use App\Models\Spending;
use App\Models\User;
use App\Http\Requests\Tasks\Save as SaveRequest;

class Tasks extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->pluck('name', 'id');
        return view('tasks.create', compact('clients'));        
    }

    public function store(SaveRequest $request)
    {
        $data = $request->only(['client_id', 'task', 'wordcount', 'budget', 'performance', 'duedate', 'author']);
        Task::create($data);
        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $clients = Client::orderBy('name')->pluck('name', 'id');
        return view('tasks.edit', compact('task', 'clients'));        
    }

    public function update(SaveRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $request->only(['task', 'wordcount', 'budget', 'performance', 'duedate', 'author']);
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
        return view('tasks.trash', compact('performedtasks', 'sum', 'sumspent'));        
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
        $earningsbyandrey = Task::onlyTrashed()
        ->where('author', 'Andrey')
        ->sum('budget');

        $earningsbyelena = Task::onlyTrashed()
        ->where('author', 'Elena')
        ->sum('budget');

        return view('earnings.earningsbyusers', compact('earningsbyandrey', 'earningsbyelena'));
    }

    public function totalworkload()
    {
        return view('workload.totalworkload');
    }

    public function workloadperuser()
    {
        return view('workload.workloadperuser');
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
