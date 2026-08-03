<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['division_id', 'user_position_id'])]
class AssignSupervisorForDivision extends Model
{
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function user_position(): BelongsTo
    {
        return $this->belongsTo(UserPosition::class, 'user_position_id');
    }
}
