<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware(['auth:sanctum','isAdmin'])->group(function() {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth:sanctum','isRegularUser'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/upload_file', [DashboardController::class, 'upload_file'])->name('upload_file');
    Route::get('/delano', [DashboardController::class, 'delano'])->name('delano');
});

