<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DocumentController;

use Illuminate\Support\Facades\Route;



Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
 
Route::resource('categories', CategorieController::class);
Route::resource('documents', DocumentController::class);
