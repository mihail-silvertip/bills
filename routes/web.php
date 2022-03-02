<?php

use App\Http\Livewire\PeriodicBills;
use App\Http\Livewire\Bills;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\BankAccounts;
use App\Http\Livewire\Accounts;

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
    // redirect to bills
    return redirect()->route('bills');
});

// route middleware
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/periodic-bills', PeriodicBills::class)->name('periodic-bills');
    Route::get('/bills', Bills::class)->name('bills');
    Route::get('/accounts', Accounts::class)->name('accounts');
    Route::get('/bank-accounts', BankAccounts::class)->name('bank-accounts');
});
