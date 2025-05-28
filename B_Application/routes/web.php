<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\UserController;

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');;

    // Categories
    // Route::resource('categories', CategorieController::class);
    // Main category routes
    Route::get('categories', [CategorieController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategorieController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}', [CategorieController::class, 'show'])->name('categories.show');
    Route::get('categories/{category}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    // Additional category routes
    Route::post('categories/bulk-action', [CategorieController::class, 'bulkAction'])->name('categories.bulk-action');
    Route::get('categories-api/search', [CategorieController::class, 'getCategories'])->name('categories.api.search');
    Route::get('categories-api/stats', [CategorieController::class, 'getStats'])->name('categories.api.stats');
    Route::get('categories/export/csv', [CategorieController::class, 'export'])->name('categories.export');

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
    // users 
      // Resource routes for users (generates all CRUD routes automatically)
    Route::resource('users', UserController::class);
    
    // Additional user management routes
    Route::post('users/bulk-action', [UserController::class, 'bulkAction'])->name('users.bulk-action');
    Route::get('users/export/csv', [UserController::class, 'export'])->name('users.export');
    
    // Profile routes (for current user)
    Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
    Route::put('profile', [UserController::class, 'updateProfile'])->name('users.profile.update');
    
});
// Add these routes to your existing web.php file
 