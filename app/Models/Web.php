<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['methode_id', 'name', 'slug', 'route', 'scope', 'description'])]
class Web extends Model
{
    public function methode(): BelongsTo
    {
        return $this->belongsTo(Methode::class, 'methode_id');
    }
    public function permissionweb(): HasMany
    {
        return $this->hasMany(Permission_web::class, 'web_id');
    }
}
