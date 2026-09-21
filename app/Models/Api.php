<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['methode_id', 'name', 'slug', 'route', 'url', 'description'])]
class Api extends Model
{
    public function methode(): BelongsTo
    {
        return $this->belongsTo(Methode::class, 'methode_id');
    }
    public function permissionapi(): HasMany
    {
        return $this->hasMany(Permission_api::class, 'api_id');
    }
}
