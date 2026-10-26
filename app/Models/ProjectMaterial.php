<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ProjectMaterial extends Model
{
    use HasTranslations;

    protected $fillable = [
        'project_id', 'name', 'description', 'template_file', 'external_url', 'is_required', 'sort',
    ];

    public array $translatable = ['name', 'description'];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
