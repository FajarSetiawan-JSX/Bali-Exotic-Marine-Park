<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['basic_information_id','chlorine', 'sodaAsh', 'hcl', 'Additional'])]
class PoolPlan extends Model
{
    public function basic(): BelongsTo
    {
        return $this->belongsTo(BasicInformation::class, 'basic_information_id');
    }
}
