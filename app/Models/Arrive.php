<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['basic_information_id', 'purchase_order_id', 'additional', 'img'])]
class Arrive extends Model
{
    public function basic(): BelongsTo
    {
        return $this->belongsTo(BasicInformation::class, 'basic_information_id');
    }
    public function purchaseorder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }
}
