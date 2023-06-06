<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class Payments extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::orderBy("daysleft", "asc")->get();
        
// Refreshing today's date
        foreach($payments as $payment)
        {
        $id = $payment->id;
        $paymentname = $payment->payment;
        $amount = $payment->amount;        

        $today = date("Y-m-d");
        $duedate = $payment->duedate;
// Re-calculating daysleft depending on today's date        
        $daytime1 = date_create($today);
        $daytime2 = date_create($duedate);
        $daysdiff = date_diff($daytime1, $daytime2);
        $daysleft = $daysdiff->format('%a');
        
        $payment->daysleft = $daysleft;
// Updating the database
        $payment = Payment::find($id);
        $payment->payment = $paymentname;
        $payment->amount = $amount;    
        $payment->duedate = $duedate;    
        $payment->daysleft = $daysleft;
        $payment->save();    

        }
          
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
// Adding a payment if Due date is provided.  
                        
        if($request->duedate !== null)
        {
        $data = $request->only(['payment', 'amount', 'duedate']);
        
        $duedate = $request->duedate;
        $today = date("Y-m-d");
        $daytime1 = date_create($today);
        $daytime2 = date_create($duedate);
        $daysdiff = date_diff($daytime1, $daytime2); 
        $daysleft = $daysdiff->format('%a');

        $data['daysleft'] = $daysleft;        

        Payment::create($data);
        return redirect()->route('payments.index');
        
        }

// Adding a payment if Daysleft is provided.
        if($request->duedate === null)
        {

        $data = $request->only(['payment', 'amount', 'daysleft']);

        $daysleft = $request->daysleft;         
        $today = date("Y-m-d");
        $date=date_create("$today");
        $duedate = date_add($date, date_interval_create_from_date_string("$daysleft days"));

        $data['duedate'] = $duedate;
        
        Payment::create($data);
        return redirect()->route('payments.index');        
        }        
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
// Updating a payment if Due date is provided.  
    if($request->duedate !== null)
    {
    $data = $request->only(['payment', 'amount', 'duedate']);

    $duedate = $request->duedate;
    $today = date("Y-m-d");
    $daytime1 = date_create($today);
    $daytime2 = date_create($duedate);
    $daysdiff = date_diff($daytime1, $daytime2); 
    $daysleft = $daysdiff->format('%a');

    $data['daysleft'] = $daysleft;        

    Payment::findOrFail($id)->update($data);
    return redirect()->route('payments.index');

    }

// Updating a payment if Daysleft is provided.
    if($request->duedate === null)
    {

    $data = $request->only(['payment', 'amount', 'daysleft']);

    $daysleft = $request->daysleft;         
    $today = date("Y-m-d");
    $date=date_create("$today");
    $duedate = date_add($date, date_interval_create_from_date_string("$daysleft days"));

    $data['duedate'] = $duedate;

    Payment::findOrFail($id)->update($data);
    return redirect()->route('payments.index');        
    }    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('payments.index');
    }
}
