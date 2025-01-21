<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CategorieController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
});
// In routes/web.php
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
