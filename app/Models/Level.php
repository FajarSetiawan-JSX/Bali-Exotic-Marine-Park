<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['level'])]
class Level extends Model
{
    public function division(): HasMany
    {
        return $this->hasMany(Division::class, 'level_id');
    }
}
