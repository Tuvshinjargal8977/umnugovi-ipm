<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Статик хуудас';
    protected static ?string $modelLabel = 'Хуудас';
    protected static ?string $pluralModelLabel = 'Статик хуудас';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Гарчиг')->required()->live(onBlur: true)
                ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
            Forms\Components\TextInput::make('slug')->label('Slug (URL)')->required()->unique(ignoreRecord: true),
            Forms\Components\Toggle::make('is_published')->label('Нийтлэгдсэн')->default(true),
            Forms\Components\TextInput::make('sort')->label('Эрэмбэ')->numeric()->default(0),
            Forms\Components\FileUpload::make('cover_image')->label('Нүүр зураг')->image()
                ->disk('public')->directory('pages')->columnSpanFull(),
            Forms\Components\RichEditor::make('body')->label('Агуулга')->columnSpanFull()
                ->fileAttachmentsDisk('public')->fileAttachmentsDirectory('pages/body'),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Гарчиг')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('URL')->prefix('/'),
                Tables\Columns\IconColumn::make('is_published')->label('Нийтэлсэн')->boolean(),
                Tables\Columns\TextColumn::make('sort')->label('Эрэмбэ')->sortable(),
            ])
            ->defaultSort('sort')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit'   => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
