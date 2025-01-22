<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Categorie;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // Display a list of documents with their categories
    public function index()
    {
        $documents = Document::with('categorie')->get(); // Eager load categories
        return view('documents.index', compact('documents'));
    }

    // Show the form for creating a new document
    public function create()
    {
        $categories = Categorie::all(); // Get all categories
        return view('documents.create', compact('categories'));
    }

    // Store a newly created document in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'chemin_fichier' => 'required|string',  // Assuming 'chemin_fichier' is the file path or URL
        ]);

        // Create the document and store it
        Document::create($request->all());

        // Redirect back with success message
        return redirect()->route('documents.index')->with('success', 'Document created successfully.');
    }

    // Show the form for editing an existing document
    public function edit(Document $document)
    {
        $categories = Categorie::all(); // Get all categories for the form
        return view('documents.edit', compact('document', 'categories'));
    }

    // Update the specified document in the database
    public function update(Request $request, Document $document)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'chemin_fichier' => 'required|string', // Assuming 'chemin_fichier' is the file path or URL
        ]);

        // Update the document with the new data
        $document->update($request->all());

        // Redirect back with success message
        return redirect()->route('documents.index')->with('success', 'Document updated successfully.');
    }

    // Remove the specified document from the database
    public function destroy(Document $document)
    {
        // Delete the document
        $document->delete();

        // Redirect back with success message
        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
}
