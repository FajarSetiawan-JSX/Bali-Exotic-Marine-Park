<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['patrol_area_section_question_id', 'patrol_question_id', 'answer', 'img'])]
class AnswerText extends Model
{
    public function patrolareasectionquestion(): BelongsTo
    {
        return $this->belongsTo(PatrolAreaSectionQuestion::class, 'patrol_area_section_question_id');
    }
}
