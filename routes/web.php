<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Taskmanager\Tasks as TaskController;
use App\Http\Controllers\Taskmanager\Clients as ClientController;
use App\Http\Controllers\Regularpayments\Payments as PaymentController;
use App\Http\Controllers\Emailtool\Emails as EmailController;
use App\Http\Controllers\Emailtool\Topics as TopicController;
use App\Http\Controllers\Emailtool\Samples as SampleController;
use App\Http\Controllers\SearchController;

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

Route::group(['prefix' => 'tm'], function () {
    Route::resource('tasks', TaskController::class);
    Route::resource('clients', ClientController::class);
    Route::get('/clients/{slug}', [ ClientController::class, 'show' ])->name('client');
});

Route::resource('payments', PaymentController::class);

Route::group(['prefix' => 'ect'], function () {
    Route::get('/emails/', [ EmailController::class, 'index' ])->name('emails.index');
    Route::get('/emails/edit/{id}', [ EmailController::class, 'edit' ])->name('emails.edit');
    Route::put('/emails/{id}', [ EmailController::class, 'update' ])->name('emails.update');
    Route::resource('topics', TopicController::class);
    Route::resource('samples', SampleController::class);
});

Route::get('/layouts-dark-header', function () {
    return view('layouts-dark-header');
});

Route::get('/search/', [ TopicController::class, 'search' ])->name('search');

Route::controller(SearchController::class)->group(function(){
    Route::get('autocomplete', 'autocomplete')->name('autocomplete');
});