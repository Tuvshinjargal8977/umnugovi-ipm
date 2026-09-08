<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Project::published()->with('category')->where('is_featured', true)
            ->latest('published_at')->limit(5)->get();
        if ($slides->isEmpty()) {
            $slides = Project::published()->with('category')->latest('published_at')->limit(5)->get();
        }

        $featured = Project::published()->with('category')
            ->where('status', 'open_for_proposals')
            ->latest('published_at')->first();

        $news = Post::published()->with('category')->latest('published_at')->limit(4)->get()
            ->map(fn (Post $p) => PostController::cardData($p));

        $section = fn (string $status) => Project::published()->with('category')->where('status', $status)
            ->when($featured, fn ($q) => $q->where('id', '!=', $featured->id))
            ->latest('published_at')->limit(8)->get()
            ->map(fn (Project $p) => ProjectController::cardData($p));

        return Inertia::render('Home', [
            'slides' => $slides->map(fn (Project $p) => [
                ...ProjectController::cardData($p),
                'bg' => $p->cover_image
                    ? Storage::url($p->cover_image)
                    : 'https://cdn.greensoft.mn/uploads/users/45/images/1_26.jpg',
            ]),
            'featured' => $featured ? [
                ...ProjectController::cardData($featured),
                'summary' => $featured->summary,
                'info_meeting_at' => $featured->info_meeting_at?->format('Y-m-d H:i'),
            ] : null,
            'news' => $news,
            'sections' => [
                'pre_assessment' => $section('pre_assessment'),
                'under_study' => $section('under_study'),
                'ongoing' => $section('ongoing'),
            ],
            'stats' => [
                'projects' => Project::published()->count(),
                'preAssessed' => Project::published()->where('status', 'pre_assessment')->count(),
                'categories' => ProjectCategory::whereHas('projects', fn ($q) => $q->published())->count(),
            ],
        ]);
    }
}
