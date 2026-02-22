<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        // Group by category
        $guidesByCategory = $guides->groupBy('category');

        return view('guides.index', compact('guidesByCategory'));
    }

    public function show(Guide $guide)
    {
        if (!$guide->is_published) {
            abort(404);
        }

        return view('guides.show', compact('guide'));
    }
}
