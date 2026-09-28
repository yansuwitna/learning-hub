<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Badge;
use App\Models\StudentBadge;
use Illuminate\Support\Facades\DB;

class BadgeEvaluatorService
{
    /**
     * Check and evaluate badges for a student.
     * Returns an array of newly unlocked badges.
     */
    public function evaluate(Student $student): array
    {
        $unlockedBadges = [];
        $existingBadgeIds = DB::table('student_badges')
            ->where('student_id', $student->id)
            ->pluck('badge_id')
            ->toArray();

        $allBadges = Badge::all();

        foreach ($allBadges as $badge) {
            if (in_array($badge->id, $existingBadgeIds)) {
                continue;
            }

            $shouldUnlock = false;

            switch ($badge->requirement_type) {
                case 'level_complete':
                    $shouldUnlock = $student->level_id >= $badge->requirement_value;
                    break;
                case 'sum_count':
                    $sumAttempts = DB::table('student_question_attempts')
                        ->join('questions', 'student_question_attempts.question_id', '=', 'questions.id')
                        ->where('student_question_attempts.student_id', $student->id)
                        ->where('student_question_attempts.is_correct', true)
                        ->where(function ($q) {
                            $q->where('questions.correct_answer', 'LIKE', '%SUM%')
                              ->orWhere('student_question_attempts.user_answer', 'LIKE', '%SUM%');
                        })
                        ->count();
                    $shouldUnlock = $sumAttempts >= $badge->requirement_value;
                    break;
                case 'streak':
                    $shouldUnlock = $student->streak_count >= $badge->requirement_value;
                    break;
                case 'speed_solver':
                    $fastestAttempt = DB::table('student_question_attempts')
                        ->where('student_id', $student->id)
                        ->where('is_correct', true)
                        ->where('time_taken', '>', 0)
                        ->where('time_taken', '<=', 15)
                        ->first();
                    $shouldUnlock = (bool) $fastestAttempt;
                    break;
                default:
                    // General attempt count requirement
                    $attemptCount = DB::table('student_question_attempts')
                        ->where('student_id', $student->id)
                        ->where('is_correct', true)
                        ->count();
                    $shouldUnlock = $attemptCount >= $badge->requirement_value;
                    break;
            }

            if ($shouldUnlock) {
                StudentBadge::create([
                    'student_id' => $student->id,
                    'badge_id' => $badge->id,
                    'unlocked_at' => now(),
                ]);
                $unlockedBadges[] = $badge;
            }
        }

        return $unlockedBadges;
    }
}
