<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['date_id', 'division_id', 'handover', 'templete_id'])]
class BasicInformation extends Model
{
    public function date(): BelongsTo
    {
        return $this->belongsTo(Date::class, 'date_id');
    }
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function templete(): BelongsTo
    {
        return $this->belongsTo(Templete::class, 'templete_id');
    }
    public function additional(): HasOne
    {
        return $this->hasOne(AdditionalBasicInformation::class, 'basic_information_id');
    }
    public function visitor(): HasMany
    {
        return $this->hasMany(Visitor::class, 'basic_information_id');
    }
    public function patrol(): HasMany
    {
        return $this->hasMany(Patrol::class, 'basic_information_id');
    }
}
