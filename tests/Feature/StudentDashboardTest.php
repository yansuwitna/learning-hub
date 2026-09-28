<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\DailyChallenge;
use App\Models\Question;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StudentDashboardTest extends TestCase
{
    use DatabaseTransactions;

    public function test_student_dashboard_can_be_rendered(): void
    {
        $this->seed();

        $studentUser = User::where('email', 'siswa@excelverse.id')->first();
        $this->assertNotNull($studentUser);

        $response = $this->actingAs($studentUser)->get('/student/dashboard');
        $response->assertStatus(200);
    }
}
