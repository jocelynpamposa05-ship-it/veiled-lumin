<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Poem;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'poems'     => Poem::count(),
            'published' => Poem::where('status', 'published')->count(),
            'drafts'    => Poem::where('status', 'draft')->count(),
            'genres'    => Genre::count(),
        ];

        $recentPoems = Poem::with('genre')
            ->latest()
            ->take(5)
            ->get();

        $draftPoems = Poem::with('genre')
            ->where('status', 'draft')
            ->latest()
            ->take(5)
            ->get();

        $genres = Genre::withCount('poems')
            ->orderBy('name')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPoems', 'draftPoems', 'genres'));
    }
}
