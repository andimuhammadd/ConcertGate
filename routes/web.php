<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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
    return view('home');
});

Route::get('/events', function () {
    return view('events');
});

Route::get('/tickets', function () {
    return view('tickets');
});
// Route::get('/', [OrderController::class, 'index'])->name('home');