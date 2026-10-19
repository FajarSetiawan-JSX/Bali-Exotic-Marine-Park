<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['basic_information_id', 'mamal_id', 'diet', 'breathe', 'faces', 'floating', 'attentive', 'skin', 'eyes', 'remark'])]
class MamalsReport extends Model
{
    public function basic(): BelongsTo
    {
        return $this->belongsTo(BasicInformation::class, 'basic_information_id');
    }
    public function mamal(): BelongsTo
    {
        return $this->belongsTo(Mamals::class, 'mamal_id');
    }
    public function mamalreportvet(): HasOne
    {
        return $this->hasOne(MamalReportVet::class, 'mamals_reports_id');
    }
}
