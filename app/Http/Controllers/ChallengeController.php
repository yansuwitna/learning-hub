<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\DailyChallenge;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user?->student;

        $challenge = DailyChallenge::where('challenge_date', now()->toDateString())
            ->with(['question.options'])
            ->first();

        return Inertia::render('Challenge/Index', [
            'challenge' => $challenge,
            'student' => $student ? $student->load('level') : null,
        ]);
    }
}
