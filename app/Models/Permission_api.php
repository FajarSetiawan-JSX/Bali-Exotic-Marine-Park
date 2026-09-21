<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['api_id', 'division_position_id'])]
class Permission_api extends Model
{
    public function api(): BelongsTo
    {
        return $this->belongsTo(Api::class, 'api_id');
    }
    public function divisionPosition(): BelongsTo
    {
        return $this->belongsTo(DivisionPosition::class, 'division_position_id');
    }
}
