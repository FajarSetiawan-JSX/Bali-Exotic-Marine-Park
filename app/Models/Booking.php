<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['basic_information_id', 'methode_booking_id', 'name', 'payment', 'whatsapp', 'whatsapp_hash', 'email', 'activity'])]
class Booking extends Model
{
    public function basic(): BelongsTo
    {
        return $this->belongsTo(BasicInformation::class, 'basic_information_id');
    }
    public function methode_booking(): BelongsTo
    {
        return $this->belongsTo(BookingMethode::class, 'methode_booking_id');
    }
    public function guide(): HasOne
    {
        return $this->hasOne(Guide::class, 'booking_id');
    }
    public function order(): HasMany
    {
        return $this->hasMany(BookingOrder::class, 'booking_id');
    }
    public function visistor(): HasOne
    {
        return $this->hasOne(VisitorBooking::class, 'booking_id');
    }
}
