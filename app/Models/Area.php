<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'description'])]
class Area extends Model
{
    public function section(): HasMany
    {
        return $this->hasMany(AreaSection::class, 'area_id');
    }
    public function patrol(): HasMany
    {
        return $this->hasMany(PatrolArea::class, 'area_id');
    }
}
