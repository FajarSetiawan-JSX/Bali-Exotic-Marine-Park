<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['month'])]
class Month extends Model
{
    public function date(): HasMany
    {
        return $this->hasMany(Date::class, 'month_id');
    }
}
