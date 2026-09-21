<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['area_id', 'section_id'])]
class AreaSection extends Model
{
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function patrolareasection(): HasMany
    {
        return $this->hasMany(PatrolAreaSection::class, 'area_section_id');
    }
}
