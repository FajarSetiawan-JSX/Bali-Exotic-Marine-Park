<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['basic_information_id', 'approve'])]
class Patrol extends Model
{
    public function basicinformation(): BelongsTo
    {
        return $this->belongsTo(BasicInformation::class, 'basic_information_id');
    }
    public function area(): HasMany
    {
        return $this->hasMany(PatrolArea::class, 'patrol_id');
    }
    public function question(): HasMany
    {
        return $this->hasMany(PatrolQuestion::class, 'patrol_id');
    }
}
