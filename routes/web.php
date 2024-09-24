<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanDetailsController;


// Main route to show the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();



// EMI routes

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/emi', [EmiController::class, 'show'])->name('emi.show');
  
  Route::post('/emi/process', [EmiController::class, 'processEmi'])->name('emi.process'); // Chan
  Route::get('/loan', [LoanDetailsController::class, 'index'])->name('loan.index');
});

// Custom Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route to home after login
Route::get('/home', 'HomeController@index')->name('home');
