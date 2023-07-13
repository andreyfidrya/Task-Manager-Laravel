<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class Emails extends Controller
{
    public function index()
    {
        return view('emails.index');
    }

    public function edit()
    {
        return view('emails.edit');
    }
    
}
