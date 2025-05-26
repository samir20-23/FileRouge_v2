<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ValidationController;

Auth::routes();

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Categories
    Route::resource('categories', CategorieController::class);

    // Documents
    Route::resource('documents', DocumentController::class);
    Route::get('my-documents', [DocumentController::class, 'myDocuments'])->name('documents.my-documents');
    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('documents/{document}/view', [DocumentController::class, 'view'])->name('documents.view');
    Route::post('documents/bulk-action', [DocumentController::class, 'bulkAction'])->name('documents.bulk-action');

    // Validations
    Route::resource('validations', ValidationController::class);
    Route::get('validations-pending', [ValidationController::class, 'pending'])->name('validations.pending');
    Route::post('validations/{validation}/approve', [ValidationController::class, 'approve'])->name('validations.approve');
    Route::post('validations/{validation}/reject', [ValidationController::class, 'reject'])->name('validations.reject');
    Route::post('validations/bulk-action', [ValidationController::class, 'bulkAction'])->name('validations.bulk-action');

    // Validation & Document relationship
    Route::get('validations/document/{document}/download', [ValidationController::class, 'downloadDocument'])->name('validations.download-document');
    Route::get('validations/document/{document}/view', [ValidationController::class, 'viewDocument'])->name('validations.view-document');
    Route::get('documents/{document}/validations/create', [ValidationController::class, 'create'])->name('validations.create');
    Route::post('documents/{document}/validations', [ValidationController::class, 'store'])->name('validations.store');

    // Check if validation exists (AJAX)
    Route::get('documents/{document}/validation-exists', function ($document) {
        $doc = \App\Models\Document::findOrFail($document);
        $validation = $doc->validation;

        return response()->json([
            'exists' => $validation !== null,
            'validation_id' => $validation?->id,
        ]);
    });
});
