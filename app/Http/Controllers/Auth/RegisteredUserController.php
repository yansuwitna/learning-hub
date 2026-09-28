<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Level;
use App\Models\Student;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $studentRole = Role::firstOrCreate(
            ['slug' => 'student'],
            ['name' => 'Siswa']
        );

        $user = User::create([
            'role_id' => $studentRole->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

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

        Student::create([
            'user_id' => $user->id,
            'level_id' => $firstLevel->id,
            'xp' => 0,
            'streak_count' => 1,
            'last_active_date' => now()->toDateString(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
