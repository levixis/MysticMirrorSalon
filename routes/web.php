<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services/men', [HomeController::class, 'menServices'])->name('services.men');
Route::get('/services/women', [HomeController::class, 'womenServices'])->name('services.women');

// Appointment Routes
Route::get('/book', [AppointmentController::class, 'create'])->name('appointment.create');
Route::post('/book', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/booking-confirmed', [AppointmentController::class, 'success'])->name('appointment.success');

// Admin Routes
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/appointments/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/appointments/{id}/cancel', [AdminController::class, 'cancel'])->name('admin.cancel');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Receipt / PDF
    Route::get('/receipt/create', [AdminController::class, 'createReceipt'])->name('admin.receipt.create');
    Route::post('/receipt', [AdminController::class, 'storeReceipt'])->name('admin.receipt.store');
    Route::get('/receipt/{id}/pdf', [AdminController::class, 'downloadReceipt'])->name('admin.receipt.pdf');

    // Revenue Export
    Route::get('/revenue/export/{period}', [AdminController::class, 'exportRevenue'])->name('admin.revenue.export');

    // Service CRUD
    Route::post('/services', [AdminController::class, 'storeService'])->name('admin.services.store');
    Route::put('/services/{id}', [AdminController::class, 'updateService'])->name('admin.services.update');
    Route::delete('/services/{id}', [AdminController::class, 'deleteService'])->name('admin.services.destroy');

    // Instagram Posts
    Route::post('/instagram', [AdminController::class, 'storeInstagramPost'])->name('admin.instagram.store');
    Route::post('/instagram/{id}/toggle', [AdminController::class, 'toggleInstagramPost'])->name('admin.instagram.toggle');
    Route::delete('/instagram/{id}', [AdminController::class, 'deleteInstagramPost'])->name('admin.instagram.destroy');
});
