<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['division_id', 'question', 'type', 'part'])]
class Question extends Model
{
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function section(): HasOne
    {
        return $this->hasOne(SectionQuestion::class, 'question_id');
    }
    public function patrol(): HasMany
    {
        return $this->hasMany(PatrolQuestion::class, 'question_id');
    }
}
