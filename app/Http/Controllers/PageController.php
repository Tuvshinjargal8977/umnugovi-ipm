<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    /** Хажуугийн цэсэнд харуулах хуудсын бүлгүүд */
    protected const GROUPS = [
        ['about-us', 'greeting', 'vision-mission', 'mandate', 'structure'],
        ['laws', 'rules', 'faq', 'hr-transparency'],
    ];

    public function show(Page $page)
    {
        abort_unless($page->is_published, 404);

        $siblings = collect();
        foreach (self::GROUPS as $group) {
            if (in_array($page->slug, $group, true)) {
                $siblings = Page::published()
                    ->whereIn('slug', $group)
                    ->orderBy('sort')->get()
                    ->map(fn (Page $p) => [
                        'title' => $p->title,
                        'slug' => $p->slug,
                        'active' => $p->slug === $page->slug,
                    ]);
                break;
            }
        }

        return Inertia::render('Pages/Show', [
            'page' => [
                'title' => $page->title,
                'body' => $page->body,
                'cover' => $page->cover_image ? \Illuminate\Support\Facades\Storage::url($page->cover_image) : null,
            ],
            'siblings' => $siblings->values(),
        ]);
    }

    public function contact()
    {
        return Inertia::render('Contact');
    }

    public function submitContact(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::create($data);

        return back()->with('contact_sent', true);
    }
}
