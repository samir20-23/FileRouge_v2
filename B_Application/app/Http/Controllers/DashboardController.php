<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Categorie;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDocuments = Document::count();
        $totalCategories = Categorie::count();

        return view('dashboard', compact('totalDocuments', 'totalCategories'));
    }
}
