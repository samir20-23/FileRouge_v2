<?php

namespace App\Http\Controllers;

use App\Services\DocumentService;
use App\Services\CategorieService;
use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    protected $documents;
    protected $categories;

    public function __construct(DocumentService $documents, CategorieService $categories)
    {
        $this->middleware('auth');
        $this->documents  = $documents;
        $this->categories = $categories;
    }

    public function index()
    {
        $docs = $this->documents->getAll();
        return view('documents.index', compact('docs'));
    }

    public function create()
    {
        $cats = $this->categories->getAll();
        return view('documents.create', compact('cats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'file_path'    => 'required|file',
            'type'         => 'required|in:document,resource',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $path = $request->file('file_path')->store('uploads');
        $data['file_path']    = $path;
        $data['utilisateur_id'] = auth()->id();

        $this->documents->create($data);
        return redirect()->route('documents.index');
    }

    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        $cats = $this->categories->getAll();
        return view('documents.edit', compact('document','cats'));
    }

    public function update(Request $request, Document $document)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'type'         => 'required|in:document,resource',
            'categorie_id' => 'required|exists:categories,id',
        ]);
        if($request->hasFile('file_path')){
            $data['file_path'] = $request->file('file_path')->store('uploads');
        }
        $this->documents->delete($document);
        $this->documents->create(array_merge($data, ['utilisateur_id'=> $document->utilisateur_id]));
        return redirect()->route('documents.index');
    }

    public function destroy(Document $document)
    {
        $this->documents->delete($document);
        return redirect()->route('documents.index');
    }
}
