<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentMission extends Model
{
    protected $fillable = [
        'student_id',
        'mission_id',
        'status',
        'score',
        'stars',
        'reflection_notes',
        'completed_at',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class);
    }
}
