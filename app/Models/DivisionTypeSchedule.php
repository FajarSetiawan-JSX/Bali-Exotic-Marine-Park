<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['division_id', 'type_schedule_id'])]
class DivisionTypeSchedule extends Model
{
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeSchedule::class, 'type_schedule_id');
    }
}
