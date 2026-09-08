<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use App\Models\ProjectCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    use Translatable;

    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Төслүүд';
    protected static ?string $modelLabel = 'Төсөл';
    protected static ?string $pluralModelLabel = 'Төслүүд';
    protected static ?string $navigationGroup = 'Контент';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make()->columnSpanFull()->tabs([

                Forms\Components\Tabs\Tab::make('Үндсэн')->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Гарчиг (сонгосон хэлээр)')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Forms\Set $set, ?string $state) =>
                            $set('slug', Str::slug($state ?? ''))),

                    Forms\Components\TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->required()
                        ->unique(ignoreRecord: true),

                    Forms\Components\Select::make('project_category_id')
                        ->label('Ангилал')
                        ->options(fn () => ProjectCategory::all()->mapWithKeys(
                            fn (ProjectCategory $c) => [$c->id => $c->name],
                        ))
                        ->searchable(),

                    Forms\Components\Select::make('status')
                        ->label('Явц')
                        ->options(Project::STATUSES)
                        ->default('pre_assessment')
                        ->required(),

                    Forms\Components\Toggle::make('is_featured')->label('Онцлох'),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Нийтэлсэн огноо')
                        ->seconds(false)
                        ->default(now())
                        ->helperText('Хоосон бол төсөл нийтэд харагдахгүй.'),
                ])->columns(2),

                Forms\Components\Tabs\Tab::make('Хураангуй')->schema([
                    Forms\Components\TextInput::make('proponent')->label('Төсөл санаачлагч'),
                    Forms\Components\TextInput::make('phase')->label('Төслийн явц (Үе 1/2/3)'),
                    Forms\Components\TextInput::make('study_status')->label('Судлагдсан байдал'),
                    Forms\Components\TextInput::make('contract_type')->label('Гэрээний төрөл'),
                    Forms\Components\TextInput::make('contract_duration')->label('Гэрээний хугацаа'),
                    Forms\Components\TextInput::make('address')->label('Хаяг')->columnSpanFull(),
                    Forms\Components\RichEditor::make('financing')->label('Санхүүжилтийн хэлбэр')->columnSpanFull(),
                    Forms\Components\RichEditor::make('policy_reference')->label('Бодлогын баримт бичиг')->columnSpanFull(),
                ])->columns(2),

                Forms\Components\Tabs\Tab::make('Огноо')->schema([
                    Forms\Components\DatePicker::make('preliminary_assessment_at')->label('Урьдчилсан үнэлгээ'),
                    Forms\Components\DatePicker::make('proposal_deadline')->label('Санал авах эцсийн хугацаа'),
                    Forms\Components\DateTimePicker::make('info_meeting_at')->label('Мэдээллийн уулзалт')->seconds(false),
                ])->columns(3),

                Forms\Components\Tabs\Tab::make('Контент')->schema([
                    Forms\Components\Textarea::make('summary')->label('Богино тайлбар')->rows(3),
                    Forms\Components\RichEditor::make('body')->label('Дэлгэрэнгүй тайлбар')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('projects/body'),
                ]),

                Forms\Components\Tabs\Tab::make('Медиа')->schema([
                    Forms\Components\FileUpload::make('cover_image')
                        ->label('Нүүр зураг')
                        ->image()
                        ->disk('public')->directory('projects')
                        ->maxSize(5120)
                        ->imageResizeMode('contain')
                        ->imageResizeUpscale(false)
                        ->imageResizeTargetWidth('1600')
                        ->imageResizeTargetHeight('1067')
                        ->imageEditor()
                        ->helperText('Зөвлөмж: 16:10 харьцаа. Хэт том зураг автоматаар багасна (макс 5MB).'),
                    Forms\Components\FileUpload::make('gallery')
                        ->label('Зургийн цомог')
                        ->image()->multiple()->reorderable()
                        ->disk('public')->directory('projects/gallery')
                        ->maxFiles(12)
                        ->maxSize(5120)
                        ->imageResizeMode('contain')
                        ->imageResizeUpscale(false)
                        ->imageResizeTargetWidth('1600')
                        ->imageResizeTargetHeight('1067'),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')->label('')->disk('public')->square(),
                Tables\Columns\TextColumn::make('title')->label('Гарчиг')->searchable()->limit(60)->wrap(),
                Tables\Columns\TextColumn::make('status')->label('Явц')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Project::STATUSES[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        'open_for_proposals' => 'success',
                        'ongoing' => 'info',
                        'completed' => 'gray',
                        default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('proposal_deadline')->label('Санал авах')->date('Y-m-d'),
                Tables\Columns\IconColumn::make('is_featured')->label('Онцлох')->boolean(),
                Tables\Columns\TextColumn::make('published_at')->label('Нийтэлсэн')->dateTime('Y-m-d')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label('Явц')->options(Project::STATUSES),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Онцлох'),
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
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
