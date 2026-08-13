<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['position_id', 'division_id', 'name', 'slug'])]
class DivisionPosition extends Model
{
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function user(): HasMany
    {
        return $this->hasMany(UserDivisionPosition::class, 'division_position_id');
    }
}
