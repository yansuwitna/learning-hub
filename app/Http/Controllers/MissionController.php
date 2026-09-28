<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Mission;
use App\Models\Level;
use App\Models\StudentMission;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;

        $levels = Level::with(['missions' => function ($query) use ($student) {
            $query->with(['studentMissions' => function ($q) use ($student) {
                if ($student) {
                    $q->where('student_id', $student->id);
                }
            }]);
        }])->orderBy('level_number', 'asc')->get();

        return Inertia::render('Missions/Index', [
            'levels' => $levels,
            'student' => $student ? $student->load('level') : null,
        ]);
    }

    public function show($id)
    {
        $user = Auth::user();
        $student = $user->student;

        $mission = Mission::with(['level', 'questions.options'])->findOrFail($id);

        $studentMission = null;
        if ($student) {
            $studentMission = StudentMission::where('student_id', $student->id)
                ->where('mission_id', $mission->id)
                ->first();
        }

        return Inertia::render('Missions/Show', [
            'mission' => $mission,
            'student_mission' => $studentMission,
            'student' => $student ? $student->load('level') : null,
        ]);
    }
}
