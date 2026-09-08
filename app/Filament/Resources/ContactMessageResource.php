<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationLabel = 'Санал хүсэлт';
    protected static ?string $modelLabel = 'Санал хүсэлт';
    protected static ?string $pluralModelLabel = 'Санал хүсэлт';
    protected static ?string $navigationGroup = 'Харилцаа';

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('is_read', false)->count();

        return $count ? (string) $count : null;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Нэр')->disabled(),
            Forms\Components\TextInput::make('email')->label('Имэйл')->disabled(),
            Forms\Components\TextInput::make('phone')->label('Утас')->disabled(),
            Forms\Components\TextInput::make('subject')->label('Гарчиг')->disabled()->columnSpanFull(),
            Forms\Components\Textarea::make('body')->label('Агуулга')->disabled()->rows(6)->columnSpanFull(),
            Forms\Components\Toggle::make('is_read')->label('Уншсан'),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_read')->label('')->boolean()
                    ->trueIcon('heroicon-o-envelope-open')->falseIcon('heroicon-s-envelope'),
                Tables\Columns\TextColumn::make('name')->label('Нэр')->searchable(),
                Tables\Columns\TextColumn::make('subject')->label('Гарчиг')->limit(50)->placeholder('—'),
                Tables\Columns\TextColumn::make('email')->label('Имэйл')->searchable()->placeholder('—'),
                Tables\Columns\TextColumn::make('phone')->label('Утас')->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')->label('Огноо')->dateTime('Y-m-d H:i')->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')->label('Уншсан эсэх'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Үзэх'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'edit'  => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
