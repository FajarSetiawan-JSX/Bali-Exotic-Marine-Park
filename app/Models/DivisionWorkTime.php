<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['division_id', 'work_time_id', 'work'])]
class DivisionWorkTime extends Model
{
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function worktime(): BelongsTo
    {
        return $this->belongsTo(WorkTime::class, 'work_time_id');
    }

    public function templete(): HasMany
    {
        return $this->hasMany(Templete::class, 'division_work_time_id');
    }
}
