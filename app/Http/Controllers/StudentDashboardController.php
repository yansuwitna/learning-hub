<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Student;
use App\Models\Level;
use App\Models\Mission;
use App\Models\StudentMission;
use App\Models\Badge;
use App\Models\DailyChallenge;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->student) {
            // Guarantee level 1 exists before attaching
            $firstLevel = Level::firstOrCreate(
                ['level_number' => 1],
                [
                    'title' => 'Excel Rookie',
                    'subtitle' => 'Pengenalan Spreadsheet & Struktur Dasar',
                    'min_xp' => 0,
                    'icon' => 'book-open',
                    'description' => 'Mengenal interface Excel, Workbook, Worksheet, Cell, Row, Column, Range, dan Alamat Cell.'
                ]
            );

            $student = Student::create([
                'user_id' => $user->id,
                'level_id' => $firstLevel->id,
                'xp' => 0,
                'streak_count' => 1,
                'last_active_date' => now()->toDateString(),
            ]);
        } else {
            $student = $user->student;
        }

        $student->load(['user', 'level', 'schoolClass', 'badges']);

        $nextLevel = Level::where('level_number', '>', $student->level->level_number)
            ->orderBy('level_number', 'asc')
            ->first();

        $activeMissions = Mission::where('level_id', '<=', $student->level->id)
            ->where('status', 'active')
            ->with(['level', 'studentMissions' => fn($q) => $q->where('student_id', $student->id)])
            ->get();

        $dailyChallenge = DailyChallenge::where('challenge_date', now()->toDateString())
            ->with('question')
            ->first();

        $totalCompletedMissions = StudentMission::where('student_id', $student->id)
            ->where('status', 'completed')
            ->count();
            
        // MOCK SUBJECTS FOR THE NEW LOBBY UI
        $mockSubjects = [
            [
                'id' => 1,
                'name' => 'Excelverse',
                'description' => 'Pelajari formula, analisis data, dan visualisasi dengan Spreadsheet.',
                'icon' => 'Table',
                'theme' => 'emerald',
                'current_level' => $student->level->level_number,
                'level_title' => $student->level->title,
                'progress_percent' => $nextLevel ? round(($student->xp / $nextLevel->min_xp) * 100) : 100,
                'xp' => $student->xp,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Kelistrikan Dasar',
                'description' => 'Pahami K3, instalasi kabel, saklar, dan perhitungan beban listrik rumah.',
                'icon' => 'Zap',
                'theme' => 'amber',
                'current_level' => 1,
                'level_title' => 'Rookie Electrician',
                'progress_percent' => 0,
                'xp' => 0,
                'is_active' => false, // false means we haven't started this course yet in our demo
            ]
        ];

        return Inertia::render('Student/Dashboard', [
            'student' => $student,
            'next_level' => $nextLevel,
            'active_missions' => $activeMissions,
            'daily_challenge' => $dailyChallenge,
            'subjects' => $mockSubjects,
            'stats' => [
                'completed_missions' => $totalCompletedMissions,
                'total_badges' => $student->badges->count(),
                'streak' => $student->streak_count,
            ],
        ]);
    }
}
