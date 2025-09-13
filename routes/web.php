<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Doctors\DoctorsController;
use App\Http\Controllers\Admin\Patients\PatientsController;


//Frontend Routes
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/admin', [AuthController::class, 'index'])->name('admin.index.login');



//Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/patients', [PatientsController::class, 'index'])->name('admin.patients');

    // Doctors Controller Routes
    Route::get('/doctors', [DoctorsController::class, 'index'])->name('admin.doctors');
    Route::get('/doctors/form/{id?}', [DoctorsController::class, 'form'])->name('admin.doctors.form');
    Route::post('/doctors/store', [DoctorsController::class, 'store'])->name('admin.doctors.store');
    Route::put('/doctors/update/{doctor}', [DoctorsController::class, 'update'])->name('admin.doctors.update');
    Route::post('/doctors/status/{doctor}', [DoctorsController::class, 'status'])->name('admin.doctors.status');
});
