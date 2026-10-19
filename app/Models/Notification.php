<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_division_position_id', 'notification', 'img'])]
class Notification extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserDivisionPosition::class, 'user_division_position_id');
    }
}
