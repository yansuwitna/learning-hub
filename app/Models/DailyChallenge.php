<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyChallenge extends Model
{
    protected $fillable = [
        'challenge_date',
        'question_id',
        'xp_bonus',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
