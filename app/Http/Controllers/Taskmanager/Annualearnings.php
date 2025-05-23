<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annualearning;
use Illuminate\Support\Facades\Auth;

class Annualearnings extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;        
        
        $annualearnings = Annualearning::all();  
        $annualearningsT = Annualearning::all()->pluck('amount', 'month');
        $annualearningsA = Annualearning::all()->pluck('andrey', 'month');
        $annualearningsE = Annualearning::all()->pluck('elena', 'month');
                
        return view('annualearnings.index', compact('username', 'annualearnings', 'annualearningsT', 'annualearningsA','annualearningsE'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        return view('annualearnings.create', compact('username'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['month', 'andrey', 'elena', 'amount']);
        Annualearning::create($data);
        return redirect()->route('annualearnings.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $username = Auth::user()->name;
        $annualearning = Annualearning::findOrFail($id);
        return view('annualearnings.edit', compact('annualearning', 'username'));
    }

    public function update(Request $request, string $id)
    {
        $annualearning = Annualearning::findOrFail($id);
        $data = $request->only(['month', 'andrey', 'elena', 'amount']);
        $annualearning->update($data);
        return redirect()->route('annualearnings.index');
    }

    public function destroy(string $id)
    {
        $annualearning = Annualearning::findOrFail($id);
        $annualearning->delete();
        return redirect()->route('annualearnings.index');
    }
}
