<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['basic_information_id', 'spv_id', 'supplier', 'item', 'nominal', 'rekening', 'category', 'status', 'duration', 'remark', 'confirm', 'confirm_at'])]
class PurchaseOrder extends Model
{
    public function basic(): BelongsTo
    {
        return $this->belongsTo(BasicInformation::class, 'basic_information_id');
    }
    public function spv(): BelongsTo
    {
        return $this->belongsTo(User::class, 'spv_id');
    }
    public function arrive(): HasOne
    {
        return $this->hasOne(Arrive::class, 'purchase_order_id');
    }
}
