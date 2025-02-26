<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annualearning;
use Illuminate\Support\Facades\Auth;

class Annualearnings extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = Auth::user()->name;
        $annualearnings = Annualearning::all();  
        $annualearningsJSON = json_encode(Annualearning::all()->pluck('amount', 'month'));
        // dd($annualearningsJSON);      
                                  
        return view('annualearnings.index', compact('username', 'annualearnings', 'annualearningsJSON'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Auth::user()->name;
        return view('annualearnings.create', compact('username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['month', 'amount']);
        Annualearning::create($data);
        return redirect()->route('annualearnings.index');
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
        $username = Auth::user()->name;
        $annualearning = Annualearning::findOrFail($id);
        return view('annualearnings.edit', compact('annualearning', 'username'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $annualearning = Annualearning::findOrFail($id);
        $data = $request->only(['month', 'amount']);
        $annualearning->update($data);
        return redirect()->route('annualearnings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annualearning = Annualearning::findOrFail($id);
        $annualearning->delete();
        return redirect()->route('annualearnings.index');
    }
}
