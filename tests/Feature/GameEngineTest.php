<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Level;
use App\Models\Student;
use App\Models\Question;
use App\Services\GameEngineService;
use App\Services\BadgeEvaluatorService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GameEngineTest extends TestCase
{
    use DatabaseTransactions;

    public function test_verifies_formula_answers_correctly(): void
    {
        $badgeEvaluator = new BadgeEvaluatorService();
        $engine = new GameEngineService($badgeEvaluator);

        $question = new Question([
            'question_type' => 'formula_input',
            'correct_answer' => '=SUM(B2:B10)',
        ]);

        $this->assertTrue($engine->verifyAnswer($question, '=SUM(B2:B10)'));
        $this->assertTrue($engine->verifyAnswer($question, 'sum(b2:b10)'));
        $this->assertTrue($engine->verifyAnswer($question, ' SUM ( B2 : B10 ) '));
        $this->assertFalse($engine->verifyAnswer($question, '=SUM(B2:B8)'));
    }

    public function test_student_gains_xp_and_levels_up(): void
    {
        $this->seed();

        $studentUser = User::where('email', 'siswa@excelverse.id')->first();
        $this->assertNotNull($studentUser);

        $student = $studentUser->student;
        $initialXp = $student->xp;

        $question = Question::first();
        $this->assertNotNull($question);

        $badgeEvaluator = new BadgeEvaluatorService();
        $engine = new GameEngineService($badgeEvaluator);

        $result = $engine->processQuestionAttempt($student, $question, $question->correct_answer);

        $this->assertTrue($result['is_correct']);
        $this->assertGreaterThan($initialXp, $student->fresh()->xp);
    }
}
