<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['basic_information_id', 'category', 'name', 'count', 'information', 'time', 'img'])]
class Visitor extends Model
{
    public function basicinformation(): BelongsTo
    {
        return $this->belongsTo(BasicInformation::class, 'basic_information_id');
    }

    public function supplier(): HasOne
    {
        return $this->hasOne(VisitorSupplier::class, 'visitor_id');
    }
    public function booking(): HasOne
    {
        return $this->hasOne(VisitorBooking::class, 'visitor_id');
    }
}
