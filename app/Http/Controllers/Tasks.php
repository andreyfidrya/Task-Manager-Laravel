<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\Tasks\Save as SaveRequest;

class Tasks extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveRequest $request)
    {
        $data = $request->only(['clientname', 'task', 'budget', 'performance', 'duedate', 'author']);
        Task::create($data);
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $request->only(['clientname', 'task', 'budget', 'performance', 'duedate', 'author']);
        $task->update($data);
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }

   
}