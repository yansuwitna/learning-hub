<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentQuestionAttempt extends Model
{
    protected $fillable = [
        'student_id',
        'question_id',
        'is_correct',
        'user_answer',
        'time_taken',
        'hint_used_count',
        'xp_gained',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
