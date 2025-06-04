<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Categorie;
use App\Models\Validation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application home page.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get search and filter parameters
        $search = $request->get('search');
        $categoryId = $request->get('category');
        $type = $request->get('type');
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        // Base query for published and public documents with approved validations
        $documentsQuery = Document::with(['categorie', 'validations', 'user'])
            ->where('status', 'published')
            ->where('is_public', true)
            ->whereHas('validations', function($query) {
                $query->where('status', 'Approved');
            });

        // Apply search filter
        if ($search) {
            $documentsQuery->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('type', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Apply category filter
        if ($categoryId) {
            $documentsQuery->where('categorie_id', $categoryId);
        }

        // Apply type filter
        if ($type) {
            $documentsQuery->where('type', $type);
        }

        // Apply sorting
        $documentsQuery->orderBy($sortBy, $sortOrder);

        // Paginate results
        $documents = $documentsQuery->paginate(12)->withQueryString();

        // Get all categories for filter dropdown
        $categories = Categorie::orderBy('name')->get();

        // Get document types for filter
        $documentTypes = Document::select('type')
            ->distinct()
            ->whereNotNull('type')
            ->where('status', 'published')
            ->where('is_public', true)
            ->orderBy('type')
            ->pluck('type');

        // Get recent documents for sidebar
        $recentDocuments = Document::with(['categorie', 'validations', 'user'])
            ->where('status', 'published')
            ->where('is_public', true)
            ->whereHas('validations', function($query) {
                $query->where('status', 'Approved');
            })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get popular categories (categories with most approved documents)
        $popularCategories = Categorie::withCount(['documents' => function($query) {
                $query->where('status', 'published')
                      ->where('is_public', true)
                      ->whereHas('validations', function($subQuery) {
                          $subQuery->where('status', 'Approved');
                      });
            }])
            ->orderBy('documents_count', 'desc')
            ->limit(6)
            ->get();

        // Statistics for user dashboard
        $stats = [
            'total_documents' => Document::where('status', 'published')
                ->where('is_public', true)
                ->whereHas('validations', function($query) {
                    $query->where('status', 'Approved');
                })->count(),
            'total_categories' => Categorie::count(),
            'user_uploads' => Document::where('user_id', $user->id)->count(),
            'recent_uploads' => Document::where('status', 'published')
                ->where('is_public', true)
                ->whereHas('validations', function($query) {
                    $query->where('status', 'Approved');
                })
                ->where('created_at', '>=', now()->subDays(7))
                ->count()
        ];

        return view('home', compact(
            'documents',
            'categories', 
            'documentTypes',
            'recentDocuments',
            'popularCategories',
            'stats',
            'search',
            'categoryId',
            'type',
            'sortBy',
            'sortOrder'
        ));
    }

    /**
     * Download a document
     */
    public function download(Document $document)
    {
        // Check if document is published and public
        if ($document->status !== 'published' || !$document->is_public) {
            abort(403, 'This document is not available for download.');
        }

        // Check if document is approved
        $isApproved = $document->validations()
            ->where('status', 'Approved')
            ->exists();

        if (!$isApproved) {
            abort(403, 'This document is not available for download.');
        }

        // Check if file exists
        if (!Storage::exists($document->chemin_fichier)) {
            abort(404, 'File not found.');
        }

        // Increment download count
        $document->increment('download_count');

        // Use original name if available, otherwise use title
        $filename = $document->original_name ?: $document->title . '.' . $document->type;
        
        return Storage::download($document->chemin_fichier, $filename);
    }

    /**
     * Show document details
     */
    public function show(Document $document)
    {
        // Check if document is published and public
        if ($document->status !== 'published' || !$document->is_public) {
            abort(403, 'This document is not available.');
        }

        // Check if document is approved
        $isApproved = $document->validations()
            ->where('status', 'Approved')
            ->exists();

        if (!$isApproved) {
            abort(403, 'This document is not available.');
        }

        $document->load(['categorie', 'validations.user', 'user']);

        // Get related documents from same category
        $relatedDocuments = Document::with(['categorie', 'validations', 'user'])
            ->where('categorie_id', $document->categorie_id)
            ->where('id', '!=', $document->id)
            ->where('status', 'published')
            ->where('is_public', true)
            ->whereHas('validations', function($query) {
                $query->where('status', 'Approved');
            })
            ->limit(4)
            ->get();

        return view('documents.public-show', compact('document', 'relatedDocuments'));
    }

    /**
     * Browse documents by category
     */
    public function category(Categorie $categorie, Request $request)
    {
        $search = $request->get('search');
        $type = $request->get('type');
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $documentsQuery = $categorie->documents()
            ->with(['validations', 'user'])
            ->where('status', 'published')
            ->where('is_public', true)
            ->whereHas('validations', function($query) {
                $query->where('status', 'Approved');
            });

        // Apply search filter
        if ($search) {
            $documentsQuery->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('type', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Apply type filter
        if ($type) {
            $documentsQuery->where('type', $type);
        }

        // Apply sorting
        $documentsQuery->orderBy($sortBy, $sortOrder);

        $documents = $documentsQuery->paginate(12)->withQueryString();

        // Get document types in this category
        $documentTypes = $categorie->documents()
            ->select('type')
            ->distinct()
            ->whereNotNull('type')
            ->where('status', 'published')
            ->where('is_public', true)
            ->orderBy('type')
            ->pluck('type');

        return view('categories.public-show', compact(
            'categorie', 
            'documents', 
            'documentTypes',
            'search',
            'type',
            'sortBy',
            'sortOrder'
        ));
    }

    /**
     * Search documents
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query) {
            return redirect()->route('home');
        }

        $documents = Document::with(['categorie', 'validations', 'user'])
            ->where('status', 'published')
            ->where('is_public', true)
            ->whereHas('validations', function($validationQuery) {
                $validationQuery->where('status', 'Approved');
            })
            ->where(function($searchQuery) use ($query) {
                $searchQuery->where('title', 'like', "%{$query}%")
                           ->orWhere('type', 'like', "%{$query}%")
                           ->orWhere('description', 'like', "%{$query}%")
                           ->orWhereHas('categorie', function($catQuery) use ($query) {
                               $catQuery->where('name', 'like', "%{$query}%");
                           });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('search-results', compact('documents', 'query'));
    }
}
