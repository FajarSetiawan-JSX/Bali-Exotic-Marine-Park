<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['patrol_area_id', 'area_section_id', 'check'])]
class PatrolAreaSection extends Model
{
    public function patrolarea(): BelongsTo
    {
        return $this->belongsTo(PatrolArea::class, 'patrol_area_id');
    }
    public function areasection(): BelongsTo
    {
        return $this->belongsTo(AreaSection::class, 'area_section_id');
    }
    public function patrolareasectionquestion(): HasMany
    {
        return $this->hasMany(PatrolAreaSectionQuestion::class, 'patrol_area_section_id');
    }
}
