<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::resource('invoices', 'InvoiceController');
    Route::resource('customers', 'CustomerController');
    Route::post('invoices/{invoice}/send', 'InvoiceDispatchController@store')->name('invoices.send');
});

Route::post('invoices/{invoice}/view', 'ShowInvoiceController@show')->name('invoices.view');

Route::post('rave-hook', 'ProcessInvoiceController@store');
