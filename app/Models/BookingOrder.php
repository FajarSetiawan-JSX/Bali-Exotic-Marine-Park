<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['booking_id', 'program_category_id', 'session'])]
class BookingOrder extends Model
{
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    public function program(): BelongsTo
    {
        return $this->belongsTo(ProgramCategory::class, 'program_category_id');
    }
}
