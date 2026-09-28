<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'class_id',
        'level_id',
        'xp',
        'streak_count',
        'last_active_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function studentMissions(): HasMany
    {
        return $this->hasMany(StudentMission::class);
    }

    public function questionAttempts(): HasMany
    {
        return $this->hasMany(StudentQuestionAttempt::class);
    }

    public function xpTransactions(): HasMany
    {
        return $this->hasMany(XpTransaction::class);
    }

    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'student_badges')
                    ->withPivot('unlocked_at')
                    ->withTimestamps();
    }
}
