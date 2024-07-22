<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\TicketController;
use PhpParser\Node\Stmt\Return_;

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
// home controller
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// concert
Route::get('/concerts', [ConcertController::class, 'index'])->name('concerts');
Route::get('/concert/{concert}', [ConcertController::class, 'show'])->name('tickets.show');

// order controller
Route::get('/ticket/{id}', [OrderController::class, 'create']);
Route::post('/order/{ticketId}', [OrderController::class, 'store'])->name('order.store');

Route::get('/invoice', function () {
    return view('invoice');
});

Route::get('/admin', function () {
    return view('layouts.auth');
});