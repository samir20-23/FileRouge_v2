<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;

// Default Auth routes (login, register, etc.)
Auth::routes();

// Public Home Route
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Protected Routes
Route::middleware('auth')->group(function () {

    // Home routes for all authenticated users
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [HomeController::class, 'search'])->name('search');

    // Public document viewing routes (for all authenticated users)
    Route::get('/document/{document}', [HomeController::class, 'show'])->name('document.show');
    Route::get('/document/{document}/download', [HomeController::class, 'download'])->name('document.download');
    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');

    // Public category viewing routes (for all authenticated users)
    Route::get('/category/{categorie}', [HomeController::class, 'category'])->name('category.show');

    // Dashboard accessible to admin & formateur only
    Route::middleware([CheckRole::class . ':admin,formateur'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | Category Routes (admin & formateur)
    |--------------------------------------------------------------------------
    */
    Route::middleware([CheckRole::class . ':admin,formateur'])->group(function () {
        Route::get('categories', [CategorieController::class, 'index'])->name('categories.index');
        Route::get('categories/create', [CategorieController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategorieController::class, 'store'])->name('categories.store');
        Route::get('categories/{category}', [CategorieController::class, 'show'])->name('categories.show');
        Route::get('categories/{category}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [CategorieController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [CategorieController::class, 'destroy'])->name('categories.destroy');
        Route::post('categories/bulk-action', [CategorieController::class, 'bulkAction'])->name('categories.bulk-action');
        Route::get('categories-api/search', [CategorieController::class, 'getCategories'])->name('categories.api.search');
        Route::get('categories-api/stats', [CategorieController::class, 'getStats'])->name('categories.api.stats');
        Route::get('categories/export/csv', [CategorieController::class, 'export'])->name('categories.export');
    });

    /*
    |--------------------------------------------------------------------------
    | Document Routes
    |--------------------------------------------------------------------------
    */
    // Create/edit/delete etc. only for admin & formateur
    Route::middleware([CheckRole::class . ':admin,formateur'])->group(function () {
        Route::resource('documents', DocumentController::class);
        Route::get('my-documents', [DocumentController::class, 'myDocuments'])->name('documents.my-documents');
        Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
        Route::get('documents/{document}/view', [DocumentController::class, 'view'])->name('documents.view');
        Route::post('documents/bulk-action', [DocumentController::class, 'bulkAction'])->name('documents.bulk-action');
    });
    // If you want normal users to upload as well, handle below separately.

    /*
    |--------------------------------------------------------------------------
    | Validation Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware([CheckRole::class . ':admin,formateur'])->group(function () {
        Route::resource('validations', ValidationController::class);
        Route::get('validations-pending', [ValidationController::class, 'pending'])->name('validations.pending');
        Route::post('validations/{validation}/approve', [ValidationController::class, 'approve'])->name('validations.approve');
        Route::post('validations/{validation}/reject', [ValidationController::class, 'reject'])->name('validations.reject');
        Route::post('validations/bulk-action', [ValidationController::class, 'bulkAction'])->name('validations.bulk-action');
        Route::get('validations/document/{document}/download', [ValidationController::class, 'downloadDocument'])->name('validations.download-document');
        Route::get('validations/document/{document}/view', [ValidationController::class, 'viewDocument'])->name('validations.view-document');
        Route::get('documents/{document}/validations/create', [ValidationController::class, 'create'])->name('validations.create');
        Route::post('documents/{document}/validations', [ValidationController::class, 'store'])->name('validations.store');
        Route::get('documents/{document}/validation-exists', function ($document) {
            $doc = \App\Models\Document::findOrFail($document);
            $validation = $doc->validation;
            return response()->json([
                'exists' => $validation !== null,
                'validation_id' => $validation?->id,
            ]);
        });
        // Optional inline viewDocument route
        Route::get('/validations/document/{document}/view', [ValidationController::class, 'viewDocument'])->name('validations.view-document');
        // Quick approve/reject duplicates are covered above
    });

    /*
    |--------------------------------------------------------------------------
    | User Management Routes (admin only)
    |--------------------------------------------------------------------------
    */
    Route::middleware([CheckRole::class . ':admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::post('users/bulk-action', [UserController::class, 'bulkAction'])->name('users.bulk-action');
        Route::get('users/export/csv', [UserController::class, 'export'])->name('users.export');
    });

    /*
    |--------------------------------------------------------------------------
    | Routes for all authenticated users
    |--------------------------------------------------------------------------
    */
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/document/{document}', [HomeController::class, 'show'])->name('document.show');
    Route::get('/document/{document}/download', [HomeController::class, 'download'])->name('document.download');
    Route::get('/category/{categorie}', [HomeController::class, 'category'])->name('category.show');
    Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
    Route::put('profile', [UserController::class, 'updateProfile'])->name('users.profile.update');

    /*
    |--------------------------------------------------------------------------
    | Upload for normal users only
    |--------------------------------------------------------------------------
    */
    Route::middleware([CheckRole::class . ':user'])->group(function () {
        Route::get('documents/upload', [DocumentController::class, 'create'])->name('documents.upload.form');
        Route::post('documents/upload', [DocumentController::class, 'store'])->name('documents.upload.store');
    });
});
