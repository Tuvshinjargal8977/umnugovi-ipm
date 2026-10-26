<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectProposal extends Model
{
    protected $fillable = [
        'project_id', 'name', 'organization', 'phone', 'email', 'note', 'is_reviewed',
    ];

    protected $casts = [
        'is_reviewed' => 'boolean',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(ProjectProposalFile::class);
    }
}
