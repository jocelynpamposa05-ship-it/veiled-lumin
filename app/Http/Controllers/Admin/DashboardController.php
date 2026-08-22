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
            'poems' => Poem::count(),
            'published' => Poem::where('status', 'published')->count(),
            'drafts' => Poem::where('status', 'draft')->count(),
            'genres' => Genre::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
