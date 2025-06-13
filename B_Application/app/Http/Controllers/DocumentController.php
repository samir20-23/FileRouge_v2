<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of documents
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');
        $status = $request->get('status');
        $user = $request->get('user');
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        $query = Document::with(['categorie', 'user', 'validation']);

        // Apply filters
        if ($search) {
            $query->search($search);
        }

        if ($category) {
            $query->byCategory($category);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($user) {
            $query->byUser($user);
        }

        // Apply sorting
        $query->orderBy($sort, $direction);

        $documents = $query->paginate(12);

        // Get filter options
        $categories = Categorie::orderBy('name')->get();
        $users = \App\Models\User::orderBy('name')->get();

        // Get statistics
        $stats = [
            'total' => Document::count(),
            'published' => Document::where('status', 'published')->count(),
            'draft' => Document::where('status', 'draft')->count(),
            'archived' => Document::where('status', 'archived')->count(),
            'needs_validation' => Document::whereDoesntHave('validation')
                                        ->orWhereHas('validation', function($q) {
                                            $q->where('status', 'Pending');
                                        })->count(),
        ];

        return view('documents.index', compact(
            'documents', 'categories', 'users', 'stats',
            'search', 'category', 'status', 'user', 'sort', 'direction'
        ));
    }

    /**
     * Show the form for creating a new document
     */
    public function create()
    {
        $categories = Categorie::orderBy('name')->get();
        return view('documents.create', compact('categories'));
    }

    /**
     * Store a newly created document
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'categorie_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'is_public' => 'boolean',
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        
        // Generate unique filename
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('documents', $filename, 'public');

        $document = Document::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $file->getClientOriginalExtension(),
            'chemin_fichier' => $path,
            'original_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'status' => $request->status,
            'is_public' => $request->boolean('is_public'),
            'categorie_id' => $request->categorie_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('documents.show', $document)
                        ->with('success', 'Document uploaded successfully!');
    }

    /**
     * Display the specified document
     */
    public function show(Document $document)
    {
        $document->load(['categorie', 'user', 'validation.validator']);
        
        // Check if user can view this document
        if (!$document->is_public && $document->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'You do not have permission to view this document.');
        }

        // Get related documents
        $relatedDocuments = Document::where('categorie_id', $document->categorie_id)
                                  ->where('id', '!=', $document->id)
                                  ->where('status', 'published')
                                  ->limit(5)
                                  ->get();

        return view('documents.show', compact('document', 'relatedDocuments'));
    }

    /**
     * Show the form for editing the specified document
     */
    public function edit(Document $document)
    {
        // Check if user can edit this document
        if ($document->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'You do not have permission to edit this document.');
        }

        $categories = Categorie::orderBy('name')->get();
        return view('documents.edit', compact('document', 'categories'));
    }

    /**
     * Update the specified document
     */
    public function update(Request $request, Document $document)
    {
        // Check if user can edit this document
        if ($document->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'You do not have permission to edit this document.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'categorie_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'is_public' => 'boolean',
            'file' => 'nullable|file|max:10240', // 10MB max
        ]);

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
            'status' => $request->status,
            'is_public' => $request->boolean('is_public'),
        ];

        // Handle file replacement
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Delete old file
            if ($document->fileExists()) {
                Storage::delete($document->chemin_fichier);
            }
            
            // Store new file
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('documents', $filename, 'public');

            $updateData = array_merge($updateData, [
                'type' => $file->getClientOriginalExtension(),
                'chemin_fichier' => $path,
                'original_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);
        }

        $document->update($updateData);

        return redirect()->route('documents.show', $document)
                        ->with('success', 'Document updated successfully!');
    }

    /**
     * Remove the specified document
     */
    public function destroy(Document $document)
    {
        // Check if user can delete this document
        if ($document->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'You do not have permission to delete this document.');
        }

        $document->delete(); // File deletion handled in model boot method

        return redirect()->route('documents.index')
                        ->with('success', 'Document deleted successfully!');
    }

    /**
     * Download document
     */
    public function download(Document $document)
{
    $user = Auth::user();

    // Permission check: public OR owner OR admin OR formateur (if needed)
    if (
        ! $document->is_public 
        && $document->user_id !== $user->id 
        && ! $user->isAdmin() 
        && ! $user->isFormateur()  // include Formateur if they should also download private docs
    ) {
        abort(403, 'You do not have permission to download this document.');
    }

    // Check existence on 'public' disk
    if (! Storage::disk('public')->exists($document->chemin_fichier)) {
        return redirect()->back()->with('error', 'File not found.');
    }

    // Increment download count (ensure this method exists and saves appropriately)
    if (method_exists($document, 'incrementDownloadCount')) {
        $document->incrementDownloadCount();
    }

    // Return download from the 'public' disk
    return Storage::disk('public')->download(
        $document->chemin_fichier,
        $document->original_name ?? $document->title
    );
}

    /**
     * View document in browser
     */
    public function view(Document $document)
    {
        // Check if user can view this document
        if (!$document->is_public && $document->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'You do not have permission to view this document.');
        }

        if (!$document->fileExists()) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $filePath = Storage::path($document->chemin_fichier);
        $mimeType = $document->mime_type ?? Storage::mimeType($document->chemin_fichier);

        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . ($document->original_name ?? $document->title) . '"'
        ]);
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,publish,archive,draft',
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:documents,id',
        ]);

        $documents = Document::whereIn('id', $request->document_ids)->get();
        
        // Check permissions for each document
        foreach ($documents as $document) {
            if ($document->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
                return redirect()->back()->with('error', 'You do not have permission to perform this action on some documents.');
            }
        }

        $count = 0;
        foreach ($documents as $document) {
            switch ($request->action) {
                case 'delete':
                    $document->delete();
                    $count++;
                    break;
                case 'publish':
                    $document->update(['status' => 'published']);
                    $count++;
                    break;
                case 'archive':
                    $document->update(['status' => 'archived']);
                    $count++;
                    break;
                case 'draft':
                    $document->update(['status' => 'draft']);
                    $count++;
                    break;
            }
        }

        $actionText = match($request->action) {
            'delete' => 'deleted',
            'publish' => 'published',
            'archive' => 'archived',
            'draft' => 'set as draft',
        };

        return redirect()->back()->with('success', "Successfully {$actionText} {$count} document(s).");
    }

    /**
     * My documents
     */
    public function myDocuments(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');
        $status = $request->get('status');

        $query = Document::with(['categorie', 'validation'])
                        ->where('user_id', Auth::id());

        if ($search) {
            $query->search($search);
        }

        if ($category) {
            $query->byCategory($category);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $documents = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = Categorie::orderBy('name')->get();

        $stats = [
            'total' => Document::where('user_id', Auth::id())->count(),
            'published' => Document::where('user_id', Auth::id())->where('status', 'published')->count(),
            'draft' => Document::where('user_id', Auth::id())->where('status', 'draft')->count(),
            'archived' => Document::where('user_id', Auth::id())->where('status', 'archived')->count(),
        ];

        return view('documents.my-documents', compact('documents', 'categories', 'stats', 'search', 'category', 'status'));
    }
}