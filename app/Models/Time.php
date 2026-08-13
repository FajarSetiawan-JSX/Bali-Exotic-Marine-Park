<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['work_time_id', 'name', 'slug', 'start', 'end', 'break_start', 'break_end'])]
class Time extends Model
{
    public function worktime(): BelongsTo
    {
        return $this->belongsTo(WorkTime::class, 'work_time_id');
    }

    public function templetetime(): HasMany
    {
        return $this->hasMany(TempleteTime::class, 'time_id');
    }
}
