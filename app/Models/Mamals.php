<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'description', 'img'])]
class Mamals extends Model
{
    public function dietplan(): HasMany
    {
        return $this->hasMany(DietPlan::class, 'mamal_id');
    }
    public function report(): HasMany
    {
        return $this->hasMany(MamalsReport::class, 'mamal_id');
    }
}
