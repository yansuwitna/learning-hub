<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Roles Table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Update Users Table to include role & settings
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id')->constrained('roles')->nullOnDelete();
            $table->string('avatar')->default('default_avatar.png')->after('email');
            $table->boolean('dark_mode')->default(true)->after('avatar');
            $table->boolean('sound_enabled')->default(true)->after('dark_mode');
            $table->boolean('reduced_motion')->default(false)->after('sound_enabled');
        });

        // 2. Classes Table
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('teacher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 3. Levels Table
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->integer('level_number')->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->integer('min_xp')->default(0);
            $table->string('icon')->default('trophy');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 4. Categories Table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 5. Students Table
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('class_id')->nullable()->constrained('classes')->nullOnDelete();
            $table->foreignId('level_id')->default(1)->constrained('levels')->onDelete('cascade');
            $table->bigInteger('xp')->default(0);
            $table->integer('streak_count')->default(0);
            $table->date('last_active_date')->nullable();
            $table->timestamps();
        });

        // 6. Teachers Table
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nip')->nullable();
            $table->string('department')->nullable();
            $table->timestamps();
        });

        // 7. Missions Table
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('world_name')->default('WORLD 1 — SCHOOL');
            $table->integer('difficulty')->default(1); // 1-5 stars
            $table->integer('estimated_minutes')->default(5);
            $table->integer('xp_reward')->default(100);
            $table->integer('total_questions')->default(5);
            $table->enum('status', ['active', 'draft', 'archived'])->default('active');
            $table->timestamps();
        });

        // 8. Questions Table
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade');
            $table->foreignId('mission_id')->nullable()->constrained('missions')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->enum('question_type', [
                'multiple_choice',
                'true_false',
                'formula_input',
                'formula_prediction',
                'debugging',
                'matching',
                'sorting',
                'simulation',
                'project'
            ])->default('multiple_choice');
            $table->text('question');
            $table->json('data_json')->nullable(); // Spreadsheet context data
            $table->text('correct_answer');
            $table->text('explanation')->nullable();
            $table->string('hint_1')->nullable();
            $table->string('hint_2')->nullable();
            $table->string('hint_3')->nullable();
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
            $table->integer('xp')->default(20);
            $table->integer('time_seconds')->default(60);
            $table->enum('status', ['active', 'draft'])->default('active');
            $table->timestamps();
        });

        // 9. Question Options Table
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->string('option_key'); // A, B, C, D
            $table->text('option_text');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });

        // 10. Student Progress Table
        Schema::create('student_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        // 11. Student Missions Table
        Schema::create('student_missions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('mission_id')->constrained('missions')->onDelete('cascade');
            $table->enum('status', ['locked', 'in_progress', 'completed'])->default('locked');
            $table->integer('score')->default(0);
            $table->integer('stars')->default(0);
            $table->text('reflection_notes')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        // 12. Student Question Attempts Table
        Schema::create('student_question_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->boolean('is_correct');
            $table->text('user_answer');
            $table->integer('time_taken')->default(0);
            $table->integer('hint_used_count')->default(0);
            $table->integer('xp_gained')->default(0);
            $table->timestamps();
        });

        // 13. XP Transactions Table
        Schema::create('xp_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->integer('amount');
            $table->string('source_type'); // mission, question, daily_challenge, streak, bonus
            $table->unsignedBigInteger('source_id')->nullable();
            $table->string('description');
            $table->timestamps();
        });

        // 14. Badges Table
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description');
            $table->string('icon')->default('award');
            $table->string('requirement_type'); // sum_count, formula_challenges, debugging_fixed, speed_solver, level_complete
            $table->integer('requirement_value')->default(10);
            $table->timestamps();
        });

        // 15. Student Badges Table
        Schema::create('student_badges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('badge_id')->constrained('badges')->onDelete('cascade');
            $table->timestamp('unlocked_at');
            $table->timestamps();
        });

        // 16. Daily Challenges Table
        Schema::create('daily_challenges', function (Blueprint $table) {
            $table->id();
            $table->date('challenge_date')->unique();
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->integer('xp_bonus')->default(50);
            $table->timestamps();
        });

        // 17. Streaks Table
        Schema::create('streaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->integer('current_streak')->default(0);
            $table->integer('max_streak')->default(0);
            $table->date('last_completed_date')->nullable();
            $table->timestamps();
        });

        // 18. Materials Table
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('title');
            $table->text('content');
            $table->text('summary')->nullable();
            $table->integer('reading_time_minutes')->default(3);
            $table->timestamps();
        });

        // 19. Activity Logs Table
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action');
            $table->string('ip_address')->nullable();
            $table->json('details')->nullable();
            $table->timestamps();
        });

        // 20. Settings Table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('materials');
        Schema::dropIfExists('streaks');
        Schema::dropIfExists('daily_challenges');
        Schema::dropIfExists('student_badges');
        Schema::dropIfExists('badges');
        Schema::dropIfExists('xp_transactions');
        Schema::dropIfExists('student_question_attempts');
        Schema::dropIfExists('student_missions');
        Schema::dropIfExists('student_progress');
        Schema::dropIfExists('question_options');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('missions');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('students');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('levels');
        Schema::dropIfExists('classes');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id', 'avatar', 'dark_mode', 'sound_enabled', 'reduced_motion']);
        });

        Schema::dropIfExists('roles');
    }
};
