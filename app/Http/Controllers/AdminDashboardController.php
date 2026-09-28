<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\Mission;
use App\Models\Question;
use App\Models\Level;
use App\Models\Badge;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_students' => Student::count(),
            'total_teachers' => Teacher::count(),
            'total_classes' => SchoolClass::count(),
            'total_levels' => Level::count(),
            'total_missions' => Mission::count(),
            'total_questions' => Question::count(),
            'total_badges' => Badge::count(),
        ];

        $recentUsers = User::with('role')->latest()->take(10)->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recent_users' => $recentUsers,
        ]);
    }
}
