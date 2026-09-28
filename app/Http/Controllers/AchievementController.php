<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Badge;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user?->student;

        $allBadges = Badge::all();
        $unlockedBadgeIds = [];

        if ($student) {
            $unlockedBadgeIds = $student->badges()->pluck('badges.id')->toArray();
        }

        return Inertia::render('Achievement/Index', [
            'badges' => $allBadges,
            'unlocked_badge_ids' => $unlockedBadgeIds,
            'student' => $student ? $student->load('level') : null,
        ]);
    }
}
