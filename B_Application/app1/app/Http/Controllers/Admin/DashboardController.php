<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Totals
        $totalDocuments = Document::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        // Growth over the last 6 months
        $months = collect();
        $documentCounts = collect();
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months->push($month->format('F'));
            $documentCounts->push(
                Document::whereBetween('created_at', [
                    $month->copy()->startOfMonth(),
                    $month->copy()->endOfMonth()
                ])->count()
            );
        }

        // Distribution by type (if you have a `type` column)
        $distribution = Document::selectRaw('type, count(*) as total')
            ->groupBy('type')
            ->pluck('total', 'type')->toArray();

        // Category breakdown
        $categoryBreakdown = Category::withCount('documents')
            ->pluck('documents_count', 'name')->toArray();

        return view('admin.dashboard', compact(
            'totalDocuments',
            'totalCategories',
            'totalUsers',
            'months',
            'documentCounts',
            'distribution',
            'categoryBreakdown'
        ));
    }
}
