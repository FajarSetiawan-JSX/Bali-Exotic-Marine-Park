<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['level_id', 'name', 'slug', 'description'])]
class Division extends Model
{
    /** @use HasFactory<\Database\Factories\DivisionFactory> */
    use HasFactory;
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'division_id');
    }

    public function TypeSchedule(): HasOne
    {
        return $this->hasOne(DivisionTypeSchedule::class, 'division_id');
    }
}
