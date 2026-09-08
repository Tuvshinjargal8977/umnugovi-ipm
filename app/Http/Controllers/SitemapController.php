<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function sitemap(): Response
    {
        $urls = [];

        $add = function (string $path, ?string $lastmod = null, string $changefreq = 'weekly', string $priority = '0.6') use (&$urls) {
            $urls[] = [
                'loc' => url($path),
                'lastmod' => $lastmod,
                'changefreq' => $changefreq,
                'priority' => $priority,
            ];
        };

        $add('/', null, 'daily', '1.0');
        $add('/projects', null, 'daily', '0.9');
        $add('/posts', null, 'daily', '0.8');
        $add('/contact-us', null, 'yearly', '0.3');

        Page::published()->get(['slug', 'updated_at'])->each(
            fn (Page $p) => $add('/'.$p->slug, $p->updated_at?->toAtomString(), 'monthly', '0.5')
        );

        Project::published()->get(['slug', 'updated_at'])->each(
            fn (Project $p) => $add('/projects/'.$p->slug, $p->updated_at?->toAtomString(), 'weekly', '0.7')
        );

        Post::published()->get(['slug', 'updated_at'])->each(
            fn (Post $p) => $add('/posts/'.$p->slug, $p->updated_at?->toAtomString(), 'monthly', '0.6')
        );

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            'Disallow: /admin',
            'Disallow: /livewire',
            'Disallow: /search',
            '',
            'Sitemap: '.url('/sitemap.xml'),
            '',
        ];

        return response(implode("\n", $lines), 200, ['Content-Type' => 'text/plain']);
    }
}
