<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'length', 'width', 'height'])]
class Pool extends Model
{
    public function waterquality(): HasMany
    {
        return $this->hasMany(WaterQuality::class, 'pool_id');
    }
}
