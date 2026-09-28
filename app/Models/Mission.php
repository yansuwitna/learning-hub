<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mission extends Model
{
    protected $fillable = [
        'level_id',
        'title',
        'description',
        'world_name',
        'difficulty',
        'estimated_minutes',
        'xp_reward',
        'total_questions',
        'status',
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function studentMissions(): HasMany
    {
        return $this->hasMany(StudentMission::class);
    }
}
