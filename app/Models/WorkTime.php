<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug'])]
class WorkTime extends Model
{
    public function division(): HasMany
    {
        return $this->hasMany(DivisionWorkTime::class, 'work_time_id');
    }

    public function time(): HasMany
    {
        return $this->hasMany(Time::class, 'work_time_id');
    }
}
