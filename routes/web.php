<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\GameController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

// Landing Page
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('landing');

// Role-based Router Dashboard
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isTeacher()) {
        return redirect()->route('teacher.dashboard');
    }
    return redirect()->route('student.dashboard');
})->middleware(['auth'])->name('dashboard');

// Authenticated Student Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    
    // Missions & Game Engine
    Route::get('/missions', [MissionController::class, 'index'])->name('missions.index');
    Route::get('/missions/{id}', [MissionController::class, 'show'])->name('missions.show');

    // Learn Materials
    Route::get('/learn', [LearnController::class, 'index'])->name('learn.index');
    Route::get('/learn/{id}', [LearnController::class, 'show'])->name('learn.show');

    // Daily Challenge
    Route::get('/challenge', [ChallengeController::class, 'index'])->name('challenge.index');

    // Leaderboard & Achievements
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Teacher Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
});

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

// Game API endpoints
Route::middleware(['auth'])->prefix('api/game')->group(function () {
    Route::post('/submit-answer', [GameController::class, 'submitAnswer']);
    Route::get('/hint/{question_id}', [GameController::class, 'getHint']);
    Route::post('/complete-mission', [GameController::class, 'completeMission']);
    Route::post('/reflection', [GameController::class, 'saveReflection']);
});

require __DIR__.'/auth.php';
