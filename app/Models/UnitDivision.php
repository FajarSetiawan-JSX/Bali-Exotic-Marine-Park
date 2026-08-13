<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['division_id', 'unit_id', 'name'])]
class UnitDivision extends Model
{
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function division(): BelongsTo
    {
        return $this->belongsTo(UnitDivision::class, 'division_id');
    }
}
