<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug'])]
class TypeSchedule extends Model
{
    public function division(): HasMany
    {
        return $this->hasMany(DivisionTypeSchedule::class, 'type_schedule_id');
    }
}
