<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'description'])]
class BookingMethode extends Model
{
    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class, 'methode_booking_id');
    }
}
