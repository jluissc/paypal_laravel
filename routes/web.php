<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


// Route::post('paypal_pago', [PaymentPaypal::class, 'pay'])->name('pay_paypal');
Route::post('paypal_pago', [PaymentController::class, 'pay'])->name('pay_paypal');
Route::get('successpaypal', [PaymentController::class, 'success']);
Route::get('cancelpaypal', [PaymentController::class, 'cancel']);
Route::view('after_pay', 'afterpay');