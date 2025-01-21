<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;  // Correct import for Laravel's Request class

class DocumentController extends Controller
{
    // Display all documents
    public function index()
    {
        $documents = Document::all();  // Get all documents
        return view('document.index', compact('documents'));
    }

    // Show form to create a new document
    public function create()
    {
        return view('document.create');
    }

    // Show form to edit an existing document
    public function edit($id)
    {
        $document = Document::find($id);  // Find document by ID
        return view('document.edit', compact('document'));
    }

    // Store a new document in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'chemin_fichier' => 'required|file|mimes:pdf,docx|max:10240', // Max file size 10MB
        ]);

        // Handle file upload
        if ($request->hasFile('chemin_fichier')) {
            $filePath = $request->file('chemin_fichier')->store('documents', 'public'); // Save file to storage/app/public/documents
            $validatedData['chemin_fichier'] = $filePath;  // Store file path in DB
        }

        // Create the document
        Document::create($validatedData);

        return redirect()->route('documents.index');
    }


    // Update an existing document
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'chemin_fichier' => 'nullable|file|mimes:pdf,docx',  // File is optional for update
        ]);

        $document = Document::find($id);

        // Handle file upload (if provided)
        if ($request->hasFile('chemin_fichier')) {
            $file = $request->file('chemin_fichier');
            $filePath = $file->store('documents', 'public');  // Save file to storage/app/public/documents
            $validatedData['chemin_fichier'] = $filePath;  // Update file path in the database
        }

        // Update the document with validated data
        $document->update($validatedData);

        return redirect()->route('documents.index');  // Redirect to document index
    }
}
