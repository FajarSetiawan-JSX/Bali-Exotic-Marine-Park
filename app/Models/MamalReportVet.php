<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['basic_information_id', 'program_id', 'mamals_reports_id', 'group', 'health', 'klinis', 'social', 'status', 'additional', 'remark'])]
class MamalReportVet extends Model
{
    public function basic(): BelongsTo
    {
        return $this->belongsTo(BasicInformation::class, 'basic_information_id');
    }
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
    public function mamalreport(): BelongsTo
    {
        return $this->belongsTo(MamalsReport::class, 'mamals_reports_id');
    }
}
