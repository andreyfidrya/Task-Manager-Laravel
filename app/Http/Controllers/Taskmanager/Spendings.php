<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use App\Models\Spending;
use Illuminate\Http\Request;
use App\Http\Requests\Spendings\Save as SaveRequest;

class Spendings extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spendings = Spending::all();
        return view('spendings.index', compact('spendings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spendings.create');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
