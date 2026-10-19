<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['patrol_id', 'question_id', 'answered'])]
class PatrolQuestion extends Model
{
    public function patrol(): BelongsTo
    {
        return $this->belongsTo(Patrol::class, 'patrol_id');
    }
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
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
