<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['templete_id', 'time_id'])]
class TempleteTime extends Model
{
    public function templete(): BelongsTo
    {
        return $this->belongsTo(Templete::class, 'templete_id');
    }
    public function time(): BelongsTo
    {
        return $this->belongsTo(Time::class, 'time_id');
    }
}
