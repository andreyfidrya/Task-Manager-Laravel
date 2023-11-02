<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Taskmanager\Tasks as TaskController;
use App\Http\Controllers\Taskmanager\Clients as ClientController;
use App\Http\Controllers\Regularpayments\Payments as PaymentController;
use App\Http\Controllers\Emailtool\Emails as EmailController;
use App\Http\Controllers\Emailtool\Topics as TopicController;
use App\Http\Controllers\Emailtool\Samples as SampleController;
use App\Http\Controllers\Users as UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SpendingsController;
use App\Http\Controllers\Auth\Session;

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

Route::middleware('auth')->group(function(){

    Route::group(['prefix' => 'tm'], function () {
        Route::resource('tasks', TaskController::class);
        Route::resource('clients', ClientController::class);
        Route::get('/clients/{slug}', [ ClientController::class, 'show' ])->name('client');
        
        Route::get('/inactive-clients', [ClientController::class, 'trash'])->name('inactiveclients');
        Route::delete('/{id}/destroyclientforever', [ClientController::class, 'destroyclientForever'])->name('removeclientforever');
        Route::put('/{id}/restoreclient', [ClientController::class, 'restoreclient'])->name('restoreclient');
        
        Route::get('/total-earnings-per-month', [TaskController::class, 'trash'])->name('performedtasks');
        Route::get('/earnings-by-clients-per-month', [TaskController::class, 'earningsbyclients'])->name('earningsbyclients');
        Route::delete('/{id}/destroytaskforever', [TaskController::class, 'destroytaskForever'])->name('removetaskforever');
        Route::put('/{id}/restoretask', [TaskController::class, 'restoretask'])->name('restoretask');
        Route::resource('spendings', SpendingsController::class);
    });
    
    Route::resource('payments', PaymentController::class);
    
    Route::group(['prefix' => 'ect'], function () {
        Route::get('/emails/', [ EmailController::class, 'index' ])->name('emails.index');
        Route::get('/emails/edit/{id}', [ EmailController::class, 'edit' ])->name('emails.edit');
        Route::put('/emails/{id}', [ EmailController::class, 'update' ])->name('emails.update');
        Route::resource('topics', TopicController::class);
        Route::resource('samples', SampleController::class);
    });
    
    Route::resource('users', UserController::class);
    
    Route::get('/search/', [ TopicController::class, 'search' ])->name('search');
    
    Route::controller(SearchController::class)->group(function(){
        Route::get('autocomplete', 'autocomplete')->name('autocomplete');
    });
    

});


Route::controller(Session::class)->group(function(){
        Route::middleware('guest')->group(function(){
            Route::get('/auth/login', 'create')->name('login');
            Route::post('/auth/login', 'store')->name('login.store');
        });

        Route::middleware('auth')->group(function(){
            Route::get('/auth/logout', 'exit')->name('login.exit');
            Route::delete('/auth/logout', 'destroy')->name('login.destroy'); 
        });          
});