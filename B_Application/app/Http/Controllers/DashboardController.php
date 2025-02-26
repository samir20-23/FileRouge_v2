<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Categorie;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDocuments = Document::count();
        $totalCategories = Categorie::count();
        $totalUsers = User::count();
    
        return view('dashboard', compact('totalDocuments', 'totalCategories', 'totalUsers'));
    }
    
}
