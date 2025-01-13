<?php

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Accountcontroller;

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
    return view('welcome');
});

Route::get('/email', function () {

    Mail::to('satheesh@gmail.com')->send(new WelcomeMail());
    
    return new WelcomeMail();
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/home/deposit', [Usercontroller::class, 'deposit'])->name('deposit');

Route::get('/home/withdraw', [Usercontroller::class, 'withdraw'])->name('withdraw');

Route::get('/home/transfer', [Usercontroller::class, 'transfer'])->name('transfer');

Route::get('/home/statement', [Usercontroller::class, 'statement'])->name('statement');

Route::post('user/account/deposit', [Accountcontroller::class, 'deposit'])->name('user.account.deposit');

Route::post('user/account/withdraw', [Accountcontroller::class, 'withdraw'])->name('user.account.withdraw');

Route::post('user/account/transfer', [Accountcontroller::class, 'transfer'])->name('user.account.transfer');
