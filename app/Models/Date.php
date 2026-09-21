<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['date', 'month_id'])]
class Date extends Model
{
    public function month(): BelongsTo
    {
        return $this->belongsTo(Month::class, 'month_id');
    }

    public function schedule(): HasMany
    {
        return $this->hasMany(Schedule::class, 'date_id');
    }
    public function basic(): HasMany
    {
        return $this->hasMany(BasicInformation::class, 'date_id');
    }
}
