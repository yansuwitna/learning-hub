<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user?->student;

        $topStudents = Student::with(['user', 'level', 'schoolClass'])
            ->orderBy('xp', 'desc')
            ->take(50)
            ->get();

        $myRank = null;
        if ($student) {
            $higherCount = Student::where('xp', '>', $student->xp)->count();
            $myRank = $higherCount + 1;
        }

        return Inertia::render('Leaderboard/Index', [
            'top_students' => $topStudents,
            'my_rank' => $myRank,
            'current_student' => $student ? $student->load(['user', 'level']) : null,
        ]);
    }
}
