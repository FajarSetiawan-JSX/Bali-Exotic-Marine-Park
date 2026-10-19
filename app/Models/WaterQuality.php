<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['basic_information_id', 'pool_id', 'time', 'ci', 'ph', 'phMeter', 'celcius', 'sanalitas', 'chlorine', 'sodaAsh', 'hcl', 'Additional'])]
class WaterQuality extends Model
{
    public function pool(): BelongsTo
    {
        return $this->belongsTo(Pool::class, 'pool_id');
    }
    public function basic(): BelongsTo
    {
        return $this->belongsTo(BasicInformation::class, 'basic_information_id');
    }
}
