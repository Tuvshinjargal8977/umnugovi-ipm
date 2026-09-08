<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\PostCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Мэдээ мэдээлэл';
    protected static ?string $modelLabel = 'Мэдээ';
    protected static ?string $pluralModelLabel = 'Мэдээ мэдээлэл';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Гарчиг')->required()->live(onBlur: true)
                ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
            Forms\Components\TextInput::make('slug')->label('Slug')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('post_category_id')
                ->label('Ангилал')
                ->relationship('category', 'name')
                ->getOptionLabelFromRecordUsing(fn (PostCategory $r) => $r->name)
                ->searchable()->preload(),
            Forms\Components\TextInput::make('author')->label('Нийтэлсэн')->default('Төр, хувийн хэвшлийн түншлэлийн төв'),
            Forms\Components\DateTimePicker::make('published_at')->label('Нийтэлсэн огноо')->seconds(false)->default(now()),
            Forms\Components\FileUpload::make('cover_image')->label('Нүүр зураг')->image()
                ->disk('public')->directory('posts')->columnSpanFull()
                ->maxSize(5120)
                ->imageResizeMode('contain')->imageResizeUpscale(false)
                ->imageResizeTargetWidth('1600')->imageResizeTargetHeight('1067')
                ->imageEditor(),
            Forms\Components\Textarea::make('excerpt')->label('Товч')->rows(3)->columnSpanFull(),
            Forms\Components\RichEditor::make('body')->label('Агуулга')->columnSpanFull()
                ->fileAttachmentsDisk('public')->fileAttachmentsDirectory('posts/body'),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')->label('')->disk('public')->square(),
                Tables\Columns\TextColumn::make('title')->label('Гарчиг')->searchable()->limit(70)->wrap(),
                Tables\Columns\TextColumn::make('category.name')->label('Ангилал')->badge(),
                Tables\Columns\TextColumn::make('published_at')->label('Нийтэлсэн')->dateTime('Y-m-d')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('post_category_id')->label('Ангилал')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
