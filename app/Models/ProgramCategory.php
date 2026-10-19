<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['program_id', 'category', 'price'])]
class ProgramCategory extends Model
{
    public function order(): HasMany
    {
        return $this->hasMany(BookingOrder::class, 'program_category_id');
    }
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
