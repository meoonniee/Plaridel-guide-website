<?php

use App\Http\Controllers\PlaridelGuideController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PlaridelGuideController::class, 'index'])->name('home');

Route::post('/appointments', [PlaridelGuideController::class, 'storeBooking'])->name('appointments.store');
Route::get('/appointments/lookup', [PlaridelGuideController::class, 'lookupBooking'])->name('appointments.lookup');

Route::get('/admin/login', [PlaridelGuideController::class, 'showAdminLogin'])->name('admin.login.form');
Route::post('/admin/login', [PlaridelGuideController::class, 'loginAdmin'])->name('admin.login.submit');
Route::post('/admin/logout', [PlaridelGuideController::class, 'logoutAdmin'])->name('admin.logout');

Route::middleware('admin.auth')->prefix('admin')->group(function () {
    Route::patch('/appointments/{refCode}/status', [PlaridelGuideController::class, 'updateBookingStatus'])
        ->name('admin.appointments.status');
    Route::delete('/appointments/{refCode}', [PlaridelGuideController::class, 'deleteBooking'])
        ->name('admin.appointments.delete');
    Route::put('/schedules', [PlaridelGuideController::class, 'updateSchedules'])
        ->name('admin.schedules.update');
});