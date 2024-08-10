<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReportController;
use App\Exports\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Concert;
use Illuminate\Support\Facades\Auth;

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
Route::get('/concert/{concert}', [ConcertController::class, 'show']);

// order controller
Route::get('/ticket/{id}', [OrderController::class, 'create']);
Route::post('/order/{ticketId}', [OrderController::class, 'store'])->name('order.store');


// Auth routes
Auth::routes();

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/concert', [AdminController::class, 'concert'])->name('admin.concert');
    Route::get('/admin/ticket', [AdminController::class, 'ticket'])->name('admin.ticket');
    Route::get('/admin/orders', [AdminController::class, 'order'])->name('admin.orders');

    // concert controller
    Route::get('/admin/concert/create', [ConcertController::class, 'create'])->name('admin.concert.create');
    Route::post('/admin/concert', [ConcertController::class, 'store'])->name('admin.concert.store');
    Route::get('/admin/concert/{id}/edit', [ConcertController::class, 'edit'])->name('admin.concert.edit');
    Route::put('/admin/concert/{id}', [ConcertController::class, 'update'])->name('admin.concert.update');
    Route::delete('/admin/concert/{id}', [ConcertController::class, 'destroy'])->name('admin.concert.destroy');

    // ticket controller
    Route::resource('tickets', TicketController::class);
    Route::get('/admin/ticket/{id}/edit', [TicketController::class, 'edit'])->name('admin.ticket.edit');
    Route::put('/admin/ticket/{id}', [TicketController::class, 'update'])->name('admin.ticket.update');
    Route::delete('/admin/ticket/{id}', [TicketController::class, 'destroy'])->name('admin.ticket.destroy');

    // order controller
    Route::get('/admin/order/show{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/admin/order/update{id}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/admin/order/destroy', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
    Route::post('/api/midtrans-notification', [OrderController::class, 'handleMidtransNotification']);


    // report controller
    Route::get('/admin/report', [ReportController::class, 'index'])->name('admin.report');
    Route::get('/admin/report/detail{id}', [ReportController::class, 'show'])->name('admin.report.detail');
    Route::get('/admin/report/detail/{id}/export', [ReportController::class, 'export'])->name('admin.report.export');
    Route::get('/export-sales-report', function () {
        $concerts = Concert::all(); // Ambil data konser dari database
        return Excel::download(new SalesReportExport($concerts), 'sales_report.xlsx');
    })->name('export.sales.report');
});

// This line was causing the conflict. It can be removed or renamed.
Route::get('/home', [HomeController::class, 'index'])->name('homepage');
