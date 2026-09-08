<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasTranslations;

    protected $fillable = [
        'project_category_id', 'title', 'slug', 'status',
        'proponent', 'phase', 'study_status', 'contract_type', 'contract_duration',
        'financing', 'policy_reference', 'address',
        'preliminary_assessment_at', 'proposal_deadline', 'info_meeting_at',
        'summary', 'body', 'cover_image', 'gallery',
        'is_featured', 'published_at',
    ];

    public array $translatable = [
        'title', 'proponent', 'phase', 'study_status', 'contract_type',
        'contract_duration', 'financing', 'policy_reference', 'address',
        'summary', 'body',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'preliminary_assessment_at' => 'date',
        'proposal_deadline' => 'date',
        'info_meeting_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    public const STATUSES = [
        'pre_assessment'     => 'Урьдчилан үнэлгээ хийх',
        'under_study'        => 'Судлагдаж буй',
        'ongoing'            => 'Хэрэгжиж буй',
        'open_for_proposals' => 'Санал авч буй',
        'completed'          => 'Дууссан',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
