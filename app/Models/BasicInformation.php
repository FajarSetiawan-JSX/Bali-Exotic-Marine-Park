<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['date_id', 'division_id', 'handover', 'templete_id', 'done', 'approved'])]
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
    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class, 'basic_information_id');
    }
    public function delivery(): HasMany
    {
        return $this->hasMany(Delivery::class, 'basic_information_id');
    }
    public function waterquality(): HasMany
    {
        return $this->hasMany(WaterQuality::class, 'basic_information_id');
    }
    public function poolplan(): HasMany
    {
        return $this->hasMany(poolplan::class, 'basic_information_id');
    }
    public function mamalreport(): HasMany
    {
        return $this->hasMany(MamalsReport::class, 'basic_information_id');
    }
    public function purchaseorder(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class, 'basic_information_id');
    }
    public function workorder(): HasMany
    {
        return $this->hasMany(WorkOrder::class, 'basic_information_id');
    }
    public function dietplan(): HasMany
    {
        return $this->hasMany(DietPlan::class, 'basic_information_id');
    }
    public function dietplanapprove(): HasMany
    {
        return $this->hasMany(DietPlanApprove::class, 'basic_information_id');
    }
    public function dietplanexecute(): HasMany
    {
        return $this->hasMany(DietPlanExecute::class, 'basic_information_id');
    }
}
