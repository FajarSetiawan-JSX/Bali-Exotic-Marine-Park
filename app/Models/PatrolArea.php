<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['patrol_id', 'area_id', 'check'])]
class PatrolArea extends Model
{
    public function patrol(): BelongsTo
    {
        return $this->belongsTo(Patrol::class, 'patrol_id');
    }
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function patrolareasection(): HasMany
    {
        return $this->hasMany(PatrolAreaSection::class, 'patrol_area_id');
    }
}
