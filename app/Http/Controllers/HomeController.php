<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    /** Нүүр хуудсын өгөгдлийг кэшлэх хугацаа (секунд) */
    public const CACHE_TTL = 600;

    public function index()
    {
        $data = Cache::remember(
            'home:'.App::getLocale(),
            self::CACHE_TTL,
            fn () => $this->buildPayload(),
        );

        return Inertia::render('Home', $data);
    }

    /** Кэш хоослох — Project / Post өөрчлөгдөх бүрт дуудагдана */
    public static function flushCache(): void
    {
        foreach (['mn', 'en'] as $locale) {
            Cache::forget('home:'.$locale);
        }
    }

    protected function buildPayload(): array
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

        return [
            'slides' => $slides->map(fn (Project $p) => [
                ...ProjectController::cardData($p),
                'bg' => $p->cover_image
                    ? Storage::url($p->cover_image)
                    : '/images/hero-bg.svg',
            ])->all(),
            'featured' => $featured ? [
                ...ProjectController::cardData($featured),
                'summary' => $featured->summary,
                'info_meeting_at' => $featured->info_meeting_at?->format('Y-m-d H:i'),
            ] : null,
            'news' => $news->all(),
            'sections' => [
                'pre_assessment' => $section('pre_assessment')->values()->all(),
                'under_study' => $section('under_study')->values()->all(),
                'ongoing' => $section('ongoing')->values()->all(),
            ],
            'stats' => [
                'projects' => Project::published()->count(),
                'preAssessed' => Project::published()->where('status', 'pre_assessment')->count(),
                'categories' => ProjectCategory::whereHas('projects', fn ($q) => $q->published())->count(),
            ],
        ];
    }
}
