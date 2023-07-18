<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tasks as TaskController;
use App\Http\Controllers\Clients as ClientController;
use App\Http\Controllers\Payments as PaymentController;
use App\Http\Controllers\Emails as EmailController;
use App\Http\Controllers\Topics as TopicController;
use App\Http\Controllers\Samples as SampleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', TaskController::class);
Route::resource('clients', ClientController::class);
Route::resource('payments', PaymentController::class);

Route::get('/clients/{slug}', [ ClientController::class, 'show' ])->name('client');

Route::get('/emails/', [ EmailController::class, 'index' ])->name('emails.index');
Route::get('/emails/edit/', [ EmailController::class, 'edit' ]);

Route::resource('topics', TopicController::class);
Route::resource('samples', SampleController::class);

Route::get('/layouts-dark-header', function () {
    return view('layouts-dark-header');
});
