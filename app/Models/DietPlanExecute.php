<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['basic_information_id', 'diet_plan_approve_id', 'gelatin', 'selar', 'layang', 'total'])]
class DietPlanExecute extends Model
{
    public function basic(): BelongsTo
    {
        return $this->belongsTo(BasicInformation::class, 'basic_information_id');
    }
    public function dietplanapprove(): BelongsTo
    {
        return $this->belongsTo(DietPlanApprove::class, 'diet_plan_approve_id');
    }
}
