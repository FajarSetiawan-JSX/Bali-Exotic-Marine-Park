<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['division_work_time_id', 'user_id', 'name'])]
class Templete extends Model
{
    public function divisionworktime(): BelongsTo
    {
        return $this->belongsTo(DivisionWorkTime::class, 'division_work_time_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function templetetime(): HasOne
    {
        return $this->hasOne(TempleteTime::class, 'templete_id');
    }
}
