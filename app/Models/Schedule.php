<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['date_id', 'templete_id'])]
class Schedule extends Model
{
    public function date(): BelongsTo
    {
        return $this->belongsTo(Date::class, 'date_id');
    }
    public function templete(): BelongsTo
    {
        return $this->belongsTo(Templete::class, 'templete_id');
    }
    public function absen(): HasOne
    {
        return $this->hasOne(Absen::class, 'schedule_id');
    }
}
