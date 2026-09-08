<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\Post;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverviewStats extends BaseWidget
{
    protected static ?int $sort = -2;

    protected function getStats(): array
    {
        $publishedProjects = Project::published()->count();
        $openForProposals = Project::published()->where('status', 'open_for_proposals')->count();
        $publishedPosts = Post::published()->count();
        $unread = ContactMessage::where('is_read', false)->count();

        return [
            Stat::make('Нийтлэгдсэн төсөл', $publishedProjects)
                ->description(Project::count().' нийт төсөл')
                ->descriptionIcon('heroicon-m-folder-open')
                ->color('primary'),

            Stat::make('Санал авч буй', $openForProposals)
                ->description('Идэвхтэй сонгон шалгаруулалт')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('success'),

            Stat::make('Нийтлэгдсэн мэдээ', $publishedPosts)
                ->description(Post::count().' нийт мэдээ')
                ->descriptionIcon('heroicon-m-newspaper'),

            Stat::make('Уншаагүй санал хүсэлт', $unread)
                ->description(ContactMessage::count().' нийт')
                ->descriptionIcon('heroicon-m-inbox-arrow-down')
                ->color($unread > 0 ? 'warning' : 'gray'),
        ];
    }
}
