<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectProposalResource\Pages;
use App\Models\Project;
use App\Models\ProjectProposal;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ProjectProposalResource extends Resource
{
    protected static ?string $model = ProjectProposal::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Төслийн саналууд';
    protected static ?string $modelLabel = 'Төслийн санал';
    protected static ?string $pluralModelLabel = 'Төслийн саналууд';
    protected static ?string $navigationGroup = 'Харилцаа';

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('is_reviewed', false)->count();

        return $count ? (string) $count : null;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Мэдээлэл')->schema([
                TextEntry::make('project.title')->label('Төсөл'),
                TextEntry::make('created_at')->label('Огноо')->dateTime('Y-m-d H:i'),
                TextEntry::make('name')->label('Нэр'),
                TextEntry::make('organization')->label('Байгууллага')->placeholder('—'),
                TextEntry::make('phone')->label('Утас')->placeholder('—'),
                TextEntry::make('email')->label('Имэйл')->placeholder('—'),
                TextEntry::make('note')->label('Нэмэлт тайлбар')->placeholder('—')->columnSpanFull(),
            ])->columns(3),

            Section::make('Хавсаргасан материал')->schema([
                RepeatableEntry::make('files')->hiddenLabel()->schema([
                    TextEntry::make('material.name')->label('Материал')->placeholder('Ерөнхий'),
                    TextEntry::make('original_name')->label('Файл')
                        ->url(fn ($record) => Storage::url($record->file_path))
                        ->openUrlInNewTab()
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('primary'),
                ])->columns(2),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_reviewed')->label('')->boolean()
                    ->trueIcon('heroicon-o-envelope-open')->falseIcon('heroicon-s-envelope'),
                Tables\Columns\TextColumn::make('project.title')->label('Төсөл')->limit(40)->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Нэр')->searchable(),
                Tables\Columns\TextColumn::make('organization')->label('Байгууллага')->placeholder('—')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Утас')->placeholder('—'),
                Tables\Columns\TextColumn::make('files_count')->label('Файл')->counts('files'),
                Tables\Columns\TextColumn::make('created_at')->label('Огноо')->dateTime('Y-m-d H:i')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('project_id')->label('Төсөл')
                    ->options(fn () => Project::query()->get()->mapWithKeys(fn (Project $p) => [$p->id => $p->title])),
                Tables\Filters\TernaryFilter::make('is_reviewed')->label('Хянасан эсэх'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('toggleReviewed')
                    ->label(fn (ProjectProposal $record) => $record->is_reviewed ? 'Хянаагүй болгох' : 'Хянасан болгох')
                    ->icon('heroicon-o-check-circle')
                    ->action(fn (ProjectProposal $record) => $record->update(['is_reviewed' => ! $record->is_reviewed])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjectProposals::route('/'),
            'view'  => Pages\ViewProjectProposal::route('/{record}'),
        ];
    }
}
