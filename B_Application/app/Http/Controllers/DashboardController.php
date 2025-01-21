<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Categorie;

class DashboardController extends Controller
{
    public function index()
    {
        $documentsCount = Document::count();  // Get the total number of documents
        $categoriesCount = Categorie::count();  // Get the total number of categories
        
        return view('dashboard', compact('documentsCount', 'categoriesCount'));
    }
}
