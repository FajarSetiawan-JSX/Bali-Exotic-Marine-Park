<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['methode', 'slug'])]
class Methode extends Model
{
    public function web(): HasMany
    {
        return $this->hasMany(Web::class, 'methode_id');
    }
    public function api(): HasMany
    {
        return $this->hasMany(Api::class, 'methode_id');
    }
}
