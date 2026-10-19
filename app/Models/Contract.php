<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'description', 'duration'])]
class Contract extends Model
{
    public function user(): HasMany
    {
        return $this->hasMany(ContractUser::class, 'contract_id');
    }
}
