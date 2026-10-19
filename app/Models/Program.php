<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'description'])]
class Program extends Model
{
    public function category(): HasMany
    {
        return $this->hasMany(ProgramCategory::class, 'program_id');
    }
    public function mamalreportvet(){
        return $this->hasMany(MamalReportVet::class, 'program_id');
    }
}
