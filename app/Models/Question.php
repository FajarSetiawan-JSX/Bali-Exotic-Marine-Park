<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['question', 'type', 'option', 'part', 'trigger'])]
class Question extends Model
{
    public function section(): HasMany
    {
        return $this->hasMany(SectionQuestion::class, 'question_id');
    }
}
