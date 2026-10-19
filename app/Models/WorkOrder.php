<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['basic_information_id', 'spv_id', 'item', 'status', 'confirm', 'remark', 'img'])]
class WorkOrder extends Model
{
    public function basic(): BelongsTo
    {
        return $this->belongsTo(BasicInformation::class, 'basic_information_id');
    }
    public function spv(): BelongsTo
    {
        return $this->belongsTo(User::class, 'spv_id');
    }
}
