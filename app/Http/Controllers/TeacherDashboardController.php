<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentMission;
use App\Models\Question;
use App\Models\StudentQuestionAttempt;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $classes = SchoolClass::where('teacher_id', $user->id)
            ->withCount('students')
            ->get();

        $students = Student::with(['user', 'level', 'schoolClass'])
            ->withCount(['studentMissions as completed_missions' => function ($q) {
                $q->where('status', 'completed');
            }])
            ->orderBy('xp', 'desc')
            ->get();

        $totalStudents = $students->count();
        $avgXp = $totalStudents > 0 ? (int)$students->avg('xp') : 0;
        $totalCompletedMissions = StudentMission::where('status', 'completed')->count();

        // Learning analytics - error prone areas
        $mostFailedQuestions = StudentQuestionAttempt::where('is_correct', false)
            ->selectRaw('question_id, count(*) as fail_count')
            ->groupBy('question_id')
            ->orderBy('fail_count', 'desc')
            ->with('question')
            ->take(5)
            ->get();

        return Inertia::render('Teacher/Dashboard', [
            'classes' => $classes,
            'students' => $students,
            'stats' => [
                'total_students' => $totalStudents,
                'active_students' => $totalStudents,
                'avg_xp' => $avgXp,
                'total_completed_missions' => $totalCompletedMissions,
            ],
            'most_failed_questions' => $mostFailedQuestions,
        ]);
    }
}
