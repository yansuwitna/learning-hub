<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Question;
use App\Models\Level;
use App\Models\StudentQuestionAttempt;
use App\Models\XpTransaction;
use App\Models\StudentMission;
use Illuminate\Support\Facades\DB;

class GameEngineService
{
    protected BadgeEvaluatorService $badgeEvaluator;

    public function __construct(BadgeEvaluatorService $badgeEvaluator)
    {
        $this->badgeEvaluator = $badgeEvaluator;
    }

    /**
     * Normalize formula or string input for accurate verification.
     */
    public function normalizeAnswer(string $answer): string
    {
        $ans = trim($answer);
        $ans = preg_replace('/\s+/', '', $ans); // strip whitespace in formulas
        return strtoupper($ans);
    }

    /**
     * Check if user answer matches target correct answer.
     */
    public function verifyAnswer(Question $question, string $userAnswer): bool
    {
        $userNorm = $this->normalizeAnswer($userAnswer);
        $correctNorm = $this->normalizeAnswer($question->correct_answer);

        if ($userNorm === $correctNorm) {
            return true;
        }

        // Support alternative formula syntax (e.g., =SUM(B2:B10) vs SUM(B2:B10))
        if ($question->question_type === 'formula_input' || $question->question_type === 'debugging') {
            $userNoEqual = ltrim($userNorm, '=');
            $correctNoEqual = ltrim($correctNorm, '=');
            if ($userNoEqual === $correctNoEqual) {
                return true;
            }
        }

        return false;
    }

    /**
     * Submit question attempt, calculate XP, combo, streak, level up.
     */
    public function processQuestionAttempt(
        Student $student,
        Question $question,
        string $userAnswer,
        int $timeTaken = 0,
        int $hintUsedCount = 0,
        int $currentCombo = 0
    ): array {
        $isCorrect = $this->verifyAnswer($question, $userAnswer);

        $xpGained = 0;
        $comboMultiplier = 1;

        if ($isCorrect) {
            $baseXp = $question->xp > 0 ? $question->xp : 20;

            // Combo multiplier calculation
            if ($currentCombo >= 4) {
                $comboMultiplier = 2.0;
            } elseif ($currentCombo >= 3) {
                $comboMultiplier = 1.5;
            } elseif ($currentCombo >= 2) {
                $comboMultiplier = 1.25;
            }

            // Hint penalty (10% reduction per hint used, min 50% XP)
            $hintPenaltyMultiplier = max(0.5, 1.0 - ($hintUsedCount * 0.1));

            $xpGained = (int) round($baseXp * $comboMultiplier * $hintPenaltyMultiplier);

            // Award XP to student
            $student->xp += $xpGained;

            // Check streak
            $today = now()->toDateString();
            if ($student->last_active_date !== $today) {
                $yesterday = now()->subDay()->toDateString();
                if ($student->last_active_date === $yesterday) {
                    $student->streak_count += 1;
                } else {
                    $student->streak_count = 1;
                }
                $student->last_active_date = $today;
            }

            // Check Level Up
            $leveledUp = false;
            $nextLevel = Level::where('min_xp', '<=', $student->xp)
                ->orderBy('level_number', 'desc')
                ->first();

            if ($nextLevel && $nextLevel->id !== $student->level_id && $nextLevel->level_number > $student->level->level_number) {
                $student->level_id = $nextLevel->id;
                $leveledUp = true;
            }

            $student->save();

            // Record XP Transaction
            XpTransaction::create([
                'student_id' => $student->id,
                'amount' => $xpGained,
                'source_type' => 'question',
                'source_id' => $question->id,
                'description' => "Menjawab benar soal ID {$question->id}",
            ]);
        }

        // Record Attempt
        StudentQuestionAttempt::create([
            'student_id' => $student->id,
            'question_id' => $question->id,
            'is_correct' => $isCorrect,
            'user_answer' => $userAnswer,
            'time_taken' => $timeTaken,
            'hint_used_count' => $hintUsedCount,
            'xp_gained' => $xpGained,
        ]);

        // Evaluate Badges
        $newBadges = $this->badgeEvaluator->evaluate($student);

        return [
            'is_correct' => $isCorrect,
            'user_answer' => $userAnswer,
            'correct_answer' => $question->correct_answer,
            'explanation' => $question->explanation,
            'xp_gained' => $xpGained,
            'new_total_xp' => $student->xp,
            'current_level' => $student->level->load('missions'),
            'leveled_up' => $leveledUp ?? false,
            'new_badges' => $newBadges,
            'feedback' => $isCorrect
                ? "🎉 BENAR! Rumus/jawabanmu sudah tepat! +{$xpGained} XP"
                : "❌ Belum tepat. {$question->explanation}",
        ];
    }
}
