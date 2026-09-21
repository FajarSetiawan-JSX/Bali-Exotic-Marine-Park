<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['patrol_area_section_id', 'section_question_id', 'answer'])]
class PatrolAreaSectionQuestion extends Model
{
    public function patrolareasection(): BelongsTo
    {
        return $this->belongsTo(PatrolAreaSection::class, 'patrol_area_section_id');
    }
    public function sectionquestion(): BelongsTo
    {
        return $this->belongsTo(SectionQuestion::class, 'section_question_id');
    }
    public function answerchecklist(): HasOne
    {
        return $this->hasOne(AnswerChecklist::class, 'patrol_area_section_question_id');
    }
    public function answertext(): HasOne
    {
        return $this->hasOne(AnswerText::class, 'patrol_area_section_question_id');
    }
}
