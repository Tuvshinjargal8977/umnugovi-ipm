<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostController extends Controller
{
    public static function cardData(Post $p): array
    {
        return [
            'slug' => $p->slug,
            'title' => $p->title,
            'excerpt' => $p->excerpt ? strip_tags($p->excerpt) : null,
            'cover' => $p->cover_image ? Storage::url($p->cover_image) : null,
            'published_at' => $p->published_at?->format('Y-m-d'),
            'author' => $p->author,
            'category' => $p->relationLoaded('category') && $p->category
                ? ['name' => $p->category->name, 'slug' => $p->category->slug]
                : null,
        ];
    }

    protected function categories()
    {
        return PostCategory::withCount(['posts' => fn ($q) => $q->published()])
            ->orderBy('sort')->orderBy('id')->get()
            ->map(fn (PostCategory $c) => [
                'name' => $c->name,
                'slug' => $c->slug,
                'posts_count' => $c->posts_count,
            ]);
    }

    public function index(Request $request)
    {
        $active = $request->query('category');

        $posts = Post::query()
            ->published()->with('category')
            ->when($active, fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $active)))
            ->latest('published_at')
            ->paginate(8)->withQueryString()
            ->through(fn (Post $p) => self::cardData($p));

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'categories' => $this->categories(),
            'active' => $active,
        ]);
    }

    public function show(Post $post)
    {
        abort_if($post->published_at === null || $post->published_at->isFuture(), 404);
        $post->loadMissing('category');

        $recent = Post::published()->with('category')
            ->where('id', '!=', $post->id)
            ->latest('published_at')->limit(5)->get()
            ->map(fn (Post $p) => self::cardData($p));

        return Inertia::render('Posts/Show', [
            'post' => [
                ...self::cardData($post),
                'body' => $post->body,
                'published_at_full' => $post->published_at?->format('Y-m-d, H:i'),
            ],
            'recent' => $recent,
            'categories' => $this->categories(),
        ]);
    }
}
