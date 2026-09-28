<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'level_id',
        'mission_id',
        'category_id',
        'question_type',
        'question',
        'data_json',
        'correct_answer',
        'explanation',
        'hint_1',
        'hint_2',
        'hint_3',
        'difficulty',
        'xp',
        'time_seconds',
        'status',
    ];

    protected $casts = [
        'data_json' => 'array',
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }
}
