<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use App\Models\Spending;
use Illuminate\Http\Request;
use App\Http\Requests\Spendings\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Spendings extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = Auth::user()->name;
        $spendings = Spending::all();
        $sumspent = Spending::all()
        ->sum('amount');
        return view('spendings.index', compact('spendings', 'sumspent', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Auth::user()->name;
        return view('spendings.create', compact('username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveRequest $request)
    {
        $data = $request->only(['spending', 'amount', 'date']);
        Spending::create($data);
        return redirect()->route('spendings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $username = Auth::user()->name;
        $expense = Spending::findOrFail($id);
        return view('spendings.edit', compact('expense', 'username'));
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
}
