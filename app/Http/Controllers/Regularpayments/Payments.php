<?php

namespace App\Http\Controllers\Regularpayments;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Models\Notification;
use App\Http\Requests\Payments\Save as SaveRequest;
use Illuminate\Support\Facades\Auth;

class Payments extends Controller
{
    
    function checkPaymentsAndCreateNotifications()
    {
        $payments = Payment::all();
        $today = date("Y-m-d");
        $user_id = Auth::user()->id;

        foreach ($payments as $payment) {
            $duedate = $payment->duedate;

            $daytime1 = date_create($today);
            $daytime2 = date_create($duedate);
            $daysdiff = date_diff($daytime1, $daytime2);
            $daysleft = $daysdiff->format('%a');

            if ($daysleft <= 5) {
                $paymentname = $payment->payment;

                $exists = Notification::where('user_id', $user_id)
                    ->whereDate('date', $today)
                    ->where('text', "$paymentname will expire in $daysleft days")
                    ->exists();

                if (!$exists) {
                    Notification::create([
                        'user_id' => $user_id,
                        'text' => "$paymentname will expire in $daysleft days",
                        'date' => $today,
                        'is_read' => false,
                    ]);
                }
            }
        }
    }

    public function index()
    {
        $username = Auth::user()->name;   
        $this->checkPaymentsAndCreateNotifications();

        $payments = Payment::orderBy("daysleft", "asc")->get();
        
        // Refreshing today's date
        foreach($payments as $payment)
        {
        $id = $payment->id;
        $paymentname = $payment->payment;
        $amount = $payment->amount;        

        $today = date("Y-m-d");
        $user_id = Auth::user()->id;
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
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;
        }

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();
          
        return view('payments.index', compact('unread_notifications', 'unread_notifications_number', 'payments', 'username', 'profile_image'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Auth::user()->name;

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('payments.create', compact('unread_notifications', 'unread_notifications_number', 'username', 'profile_image'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveRequest $request)
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
        $username = Auth::user()->name;
        $payment = Payment::findOrFail($id);

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $profile_image = $user->profile_image;

        $unread_notifications_number = Notification::with('user')->where('is_read',0)->count();
        $unread_notifications = Notification::with('user')->where('is_read',0)->get();

        return view('payments.edit', compact('unread_notifications', 'unread_notifications_number', 'payment', 'username', 'profile_image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveRequest $request, $id)
    {
        $request->validate([
            'payment' => 'required|min:3',
            'amount' => 'required|int'            
        ]);    
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
