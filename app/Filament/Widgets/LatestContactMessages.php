<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestContactMessages extends BaseWidget
{
    protected static ?int $sort = -1;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Сүүлийн санал хүсэлт';

    public function table(Table $table): Table
    {
        return $table
            ->query(ContactMessage::query()->latest())
            ->paginated([5, 10])
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->label('')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-s-envelope')
                    ->falseColor('warning'),
                Tables\Columns\TextColumn::make('name')->label('Нэр'),
                Tables\Columns\TextColumn::make('subject')->label('Гарчиг')->limit(45)->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')->label('Огноо')->since()->sortable(),
            ])
            ->recordUrl(fn (ContactMessage $record): string => ContactMessageResource::getUrl('edit', ['record' => $record]))
            ->emptyStateHeading('Санал хүсэлт алга байна')
            ->emptyStateIcon('heroicon-o-inbox');
    }
}
