<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Mission;
use App\Models\StudentMission;
use App\Services\GameEngineService;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    protected GameEngineService $gameEngine;

    public function __construct(GameEngineService $gameEngine)
    {
        $this->gameEngine = $gameEngine;
    }

    public function submitAnswer(Request $request)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'user_answer' => 'required|string',
            'time_taken' => 'nullable|integer',
            'hint_used_count' => 'nullable|integer',
            'current_combo' => 'nullable|integer',
        ]);

        $user = Auth::user();
        if (!$user || !$user->student) {
            return response()->json(['error' => 'Akses hanya untuk siswa.'], 403);
        }

        $student = $user->student;
        $question = Question::findOrFail($validated['question_id']);

        $result = $this->gameEngine->processQuestionAttempt(
            $student,
            $question,
            $validated['user_answer'],
            $validated['time_taken'] ?? 0,
            $validated['hint_used_count'] ?? 0,
            $validated['current_combo'] ?? 0
        );

        return response()->json($result);
    }

    public function getHint(Request $request, $questionId)
    {
        $question = Question::findOrFail($questionId);
        $level = $request->input('level', 1);

        $hint = match ((int)$level) {
            1 => $question->hint_1 ?? 'Perhatikan instruksi soal dengan teliti.',
            2 => $question->hint_2 ?? 'Gunakan fungsi yang sesuai dengan materi level ini.',
            3 => $question->hint_3 ?? "Jawaban mengarah ke: {$question->correct_answer}",
            default => $question->hint_1,
        };

        return response()->json([
            'question_id' => $question->id,
            'hint_level' => $level,
            'hint' => $hint,
        ]);
    }

    public function completeMission(Request $request)
    {
        $validated = $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'score' => 'required|integer',
            'stars' => 'required|integer',
        ]);

        $user = Auth::user();
        if (!$user || !$user->student) {
            return response()->json(['error' => 'Akses hanya untuk siswa.'], 403);
        }

        $student = $user->student;
        $mission = Mission::findOrFail($validated['mission_id']);

        $studentMission = StudentMission::updateOrCreate(
            [
                'student_id' => $student->id,
                'mission_id' => $mission->id,
            ],
            [
                'status' => 'completed',
                'score' => $validated['score'],
                'stars' => $validated['stars'],
                'completed_at' => now(),
            ]
        );

        // Bonus XP for mission completion
        $bonusXp = $mission->xp_reward;
        $student->xp += $bonusXp;
        $student->save();

        return response()->json([
            'message' => 'Misi berhasil diselesaikan!',
            'student_mission' => $studentMission,
            'bonus_xp' => $bonusXp,
            'total_xp' => $student->xp,
        ]);
    }

    public function saveReflection(Request $request)
    {
        $validated = $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'reflection_notes' => 'required|string',
        ]);

        $user = Auth::user();
        if (!$user || !$user->student) {
            return response()->json(['error' => 'Akses hanya untuk siswa.'], 403);
        }

        StudentMission::where('student_id', $user->student->id)
            ->where('mission_id', $validated['mission_id'])
            ->update(['reflection_notes' => $validated['reflection_notes']]);

        return response()->json(['message' => 'Refleksi berhasil disimpan!']);
    }
}
