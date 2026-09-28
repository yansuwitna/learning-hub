<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class XpTransaction extends Model
{
    protected $fillable = [
        'student_id',
        'amount',
        'source_type',
        'source_id',
        'description',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
