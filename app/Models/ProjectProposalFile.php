<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectProposalFile extends Model
{
    protected $fillable = [
        'project_proposal_id', 'project_material_id', 'file_path', 'original_name',
    ];

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(ProjectProposal::class, 'project_proposal_id');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(ProjectMaterial::class, 'project_material_id');
    }
}
