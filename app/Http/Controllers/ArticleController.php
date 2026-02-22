<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');

        $query = Article::where('is_published', true)
            ->orderBy('published_at', 'desc');

        if ($category) {
            $query->where('category', $category);
        }

        $articles = $query->paginate(12);

        // Get categories for filter
        $categories = Article::where('is_published', true)
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('articles.index', compact('articles', 'categories', 'category'));
    }

    public function show(Article $article)
    {
        if (!$article->is_published) {
            abort(404);
        }

        // Get related articles (same category, exclude current)
        $relatedArticles = Article::where('is_published', true)
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
