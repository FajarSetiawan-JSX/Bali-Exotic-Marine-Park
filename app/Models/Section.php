<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name'])]
class Section extends Model
{
    public function question(): HasMany
    {
        return $this->hasMany(SectionQuestion::class, 'section_id');
    }
    public function area(): HasMany
    {
        return $this->hasMany(AreaSection::class, 'section_id');
    }
}
