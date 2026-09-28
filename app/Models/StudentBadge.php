<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentBadge extends Model
{
    protected $fillable = ['student_id', 'badge_id', 'unlocked_at'];
}
