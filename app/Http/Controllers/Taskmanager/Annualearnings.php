<?php

namespace App\Http\Controllers\Taskmanager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annualearning;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Annualearnings extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;        
        
        $annualearnings = Annualearning::all();  
        $annualearningsT = Annualearning::where('earnings_source','Total')->pluck('amount', 'month');
        $annualearningsA = Annualearning::where('earnings_source','Andrey')->pluck('amount', 'month');
        $annualearningsE = Annualearning::where('earnings_source','Elena')->pluck('amount', 'month');
                       
        return view('annualearnings.index', compact('username', 'annualearnings', 'annualearningsT', 'annualearningsA','annualearningsE'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];        
        $months = array_combine($months, $months);

        return view('annualearnings.create', compact('username', 'months'));
    }

    public function store(Request $request)
    {
        $current_timestamp = Carbon::now()->timestamp;        
        $data = $request->only(['month', 'earnings_source', 'amount']);

        if($request->hasFile('image'))
        {  
            $image = $request->file('image');                                               
            $imageName = $current_timestamp . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);  
            $data['image'] = $imageName;    
        }        
        
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
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $months = array_combine($months, $months);
        
        return view('annualearnings.edit', compact('annualearning', 'username', 'months'));
    }

    public function update(Request $request, string $id)
    {
        $annualearning = Annualearning::findOrFail($id);
        $data = $request->only(['month', 'earnings_source', 'amount']);
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
