<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'address'])]
class Supplier extends Model
{
    public function visitor(): HasMany
    {
        return $this->hasMany(VisitorSupplier::class, 'supplier_id');
    }
}
