<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

// ----------------------
// Home Page
// ----------------------
Route::get('/', [DashboardController::class, 'home'])->name('home');

// API endpoint for dashboard stats
Route::get('/api/dashboard-stats', [DashboardController::class, 'stats']);

// ----------------------
// Dashboard (auth & verified)
// ----------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ----------------------
// Profile (auth only)
// ----------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ----------------------
// Appointment routes (auth only)
// ----------------------
Route::middleware('auth')->group(function() {
    Route::get('/appointments/create', [AppointmentController::class, 'createForm'])->name('appointments.create');
    Route::post('/appointments/create', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
});

// ----------------------
// Admin routes (prefix + gate)
// ----------------------
Route::prefix('admin')->middleware(['auth','can:admin-only'])->group(function() {
    Route::get('/', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::post('/residents', [AdminController::class,'storeResident'])->name('admin.residents.store');
    Route::post('/documents', [AdminController::class,'uploadDocument'])->name('admin.documents.upload');
    Route::post('/inventory/{inventory}', [AdminController::class,'updateStock'])->name('admin.inventory.update');
});

require __DIR__.'/auth.php';
