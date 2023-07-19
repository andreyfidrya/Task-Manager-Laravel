<?php

namespace App\Http\Controllers\Emailtool;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;

class Emails extends Controller
{
    public function index()
    {
        $emails = Email::all();
        return view('emails.index', compact('emails'));
    }

    public function edit()
    {
        return view('emails.edit');
    }
    
}
