<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'division_position_id'])]
class UserDivisionPosition extends Model
{
    public function divisionPosition(): BelongsTo
    {
        return $this->belongsTo(DivisionPosition::class, 'division_position_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
