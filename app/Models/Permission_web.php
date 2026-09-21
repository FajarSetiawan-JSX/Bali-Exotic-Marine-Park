<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['web_id', 'division_position_id'])]
class Permission_web extends Model
{
    public function web(): BelongsTo
    {
        return $this->belongsTo(Web::class, 'web_id');
    }
    public function divisionPosition(): BelongsTo
    {
        return $this->belongsTo(DivisionPosition::class, 'division_position_id');
    }
}
