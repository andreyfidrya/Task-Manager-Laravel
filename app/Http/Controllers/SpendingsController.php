<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Spending;
use Illuminate\Http\Request;

class SpendingsController extends Controller
{
    public function index()
    {
        return view('spendings.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}