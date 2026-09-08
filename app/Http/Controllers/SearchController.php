<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $projects = collect();
        $posts = collect();

        if (mb_strlen($q) >= 2) {
            $like = '%' . $q . '%';

            $projects = Project::query()->published()
                ->where(fn ($w) => $w->where('title', 'like', $like)
                    ->orWhere('summary', 'like', $like)->orWhere('body', 'like', $like))
                ->latest('published_at')->limit(30)->get()
                ->map(fn (Project $p) => ProjectController::cardData($p));

            $posts = Post::query()->published()->with('category')
                ->where(fn ($w) => $w->where('title', 'like', $like)
                    ->orWhere('excerpt', 'like', $like)->orWhere('body', 'like', $like))
                ->latest('published_at')->limit(30)->get()
                ->map(fn (Post $p) => PostController::cardData($p));
        }

        return Inertia::render('Search', [
            'q' => $q,
            'projects' => $projects->values(),
            'posts' => $posts->values(),
            'total' => $projects->count() + $posts->count(),
        ]);
    }
}
