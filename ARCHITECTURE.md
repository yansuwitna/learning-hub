# EXCELVERSE - SYSTEM ARCHITECTURE & SYSTEM DESIGN DOCUMENT

## 1. ARCHITECTURE DIAGRAM (Text-based)

```
+-----------------------------------------------------------------------------------+
|                                 CLIENT SIDE                                       |
|  +-----------------------------------------------------------------------------+  |
|  |                   PWA Client (Vue 3 + TypeScript + Vite)                    |  |
|  |  +---------------------+  +----------------------+  +--------------------+  |  |
|  |  |   Student Frontend  |  |   Teacher Frontend   |  |   Admin Frontend   |  |  |
|  |  +---------------------+  +----------------------+  +--------------------+  |  |
|  |  +-----------------------------------------------------------------------+  |  |
|  |  | Game Engine Core: Quiz | Formula Battle | Detective | Tycoon | Daily   |  |  |
|  |  +-----------------------------------------------------------------------+  |  |
|  |  +-----------------------------------------------------------------------+  |  |
|  |  | Pinia Stores (Auth, Progress, Game, Theme) | Service Worker (PWA)     |  |  |
|  |  +-----------------------------------------------------------------------+  |  |
|  +-----------------------------------------------------------------------------+  |
+------------------------------------------|----------------------------------------+
                                           | HTTPS / JSON API (Inertia + REST)
+------------------------------------------v----------------------------------------+
|                                 SERVER SIDE                                       |
|  +-----------------------------------------------------------------------------+  |
|  |                       Laravel 12 API & Controller Core                      |  |
|  |  +----------------------+ +--------------------+ +-----------------------+  |  |
|  |  | Auth (Sanctum/Breeze)| |  Game Engine API   | | Progression Controller|  |  |
|  |  +----------------------+ +--------------------+ +-----------------------+  |  |
|  |  +-----------------------------------------------------------------------+  |  |
|  |  | Service Layer: Scoring Engine | XP Calculator | Badge Evaluator        |  |  |
|  |  +-----------------------------------------------------------------------+  |  |
|  |  +-----------------------------------------------------------------------+  |  |
|  |  | Database Models & Eloquent ORM (MariaDB / MySQL)                      |  |  |
|  |  +-----------------------------------------------------------------------+  |  |
|  +-----------------------------------------------------------------------------+  |
+-----------------------------------------------------------------------------------+
```

---

## 2. DATABASE ERD (Text-based)

```
[roles] 1 --- * [users] 1 --- 1 [students] * --- 1 [classes]
                   |             |
                   |             + --- * [student_progress]
                   |             + --- * [student_missions]
                   |             + --- * [student_question_attempts]
                   |             + --- * [student_badges] * --- 1 [badges]
                   |             + --- * [xp_transactions]
                   |             + --- * [streaks]
                   |
                   + --- 1 [teachers] 1 --- * [classes]

[levels] 1 --- * [missions] 1 --- * [questions] 1 --- * [question_options]
                    |
                    + --- * [student_missions]

[categories] 1 --- * [materials]
[daily_challenges] 1 --- * [student_question_attempts]
[leaderboards]
[notifications]
[activity_logs]
[settings]
```

---

## 3. FOLDER STRUCTURE

```
excel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   ├── Teacher/
│   │   │   ├── Student/
│   │   │   ├── GameController.php
│   │   │   ├── MissionController.php
│   │   │   ├── ChallengeController.php
│   │   │   └── LeaderboardController.php
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Role.php
│   │   ├── SchoolClass.php
│   │   ├── Student.php
│   │   ├── Teacher.php
│   │   ├── Level.php
│   │   ├── Mission.php
│   │   ├── Question.php
│   │   ├── QuestionOption.php
│   │   ├── Answer.php
│   │   ├── StudentProgress.php
│   │   ├── StudentMission.php
│   │   ├── StudentQuestionAttempt.php
│   │   ├── XpTransaction.php
│   │   ├── Badge.php
│   │   ├── StudentBadge.php
│   │   ├── DailyChallenge.php
│   │   ├── Streak.php
│   │   ├── Material.php
│   │   ├── Category.php
│   │   ├── Notification.php
│   │   ├── ActivityLog.php
│   │   └── Setting.php
│   └── Services/
│       ├── GameEngineService.php
│       ├── XpScoringService.php
│       └── BadgeEvaluatorService.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── js/
│   │   ├── Components/
│   │   │   ├── AppHeader.vue
│   │   │   ├── AppSidebar.vue
│   │   │   ├── MobileBottomNav.vue
│   │   │   ├── ProgressBar.vue
│   │   │   ├── XpBadge.vue
│   │   │   ├── LevelCard.vue
│   │   │   ├── MissionCard.vue
│   │   │   ├── QuestionCard.vue
│   │   │   ├── QuizOption.vue
│   │   │   ├── Timer.vue
│   │   │   ├── ComboCounter.vue
│   │   │   ├── HintPanel.vue
│   │   │   ├── ResultModal.vue
│   │   │   ├── AchievementCard.vue
│   │   │   ├── Leaderboard.vue
│   │   │   ├── StatCard.vue
│   │   │   ├── ToastNotification.vue
│   │   │   ├── LoadingSkeleton.vue
│   │   │   └── ConfirmDialog.vue
│   │   ├── Layouts/
│   │   │   ├── AuthenticatedLayout.vue
│   │   │   └── GuestLayout.vue
│   │   ├── Pages/
│   │   │   ├── Welcome.vue
│   │   │   ├── Dashboard.vue
│   │   │   ├── Missions/
│   │   │   │   ├── Index.vue
│   │   │   │   └── Show.vue
│   │   │   ├── Learn/
│   │   │   │   ├── Index.vue
│   │   │   │   └── Show.vue
│   │   │   ├── Challenge/
│   │   │   │   └── Index.vue
│   │   │   ├── Achievement/
│   │   │   │   └── Index.vue
│   │   │   ├── Leaderboard/
│   │   │   │   └── Index.vue
│   │   │   ├── Profile/
│   │   │   │   └── Show.vue
│   │   │   ├── Teacher/
│   │   │   │   ├── Dashboard.vue
│   │   │   │   ├── Classes/
│   │   │   │   └── Analytics/
│   │   │   └── Admin/
│   │   │       ├── Dashboard.vue
│   │   │       └── Users/
│   │   └── Stores/
│   │       ├── authStore.ts
│   │       ├── gameStore.ts
│   │       └── themeStore.ts
│   └── css/
│       └── app.css
└── routes/
    ├── web.php
    └── api.php
```

---

## 4. ROUTE & API LIST

### Web Routes
- `GET /` -> Landing Page (`Welcome.vue`)
- `GET /dashboard` -> Redirect by Role (Siswa, Guru, Admin)
- `GET /student/dashboard` -> Dashboard Siswa
- `GET /missions` -> Daftar Misi
- `GET /missions/{id}` -> Halaman Game Misi
- `GET /learn` -> Materi Pembelajaran
- `GET /learn/{id}` -> Detail Materi
- `GET /challenges` -> Daily Challenge
- `GET /achievements` -> Lencana & Trophy
- `GET /leaderboard` -> Peringkat Siswa
- `GET /profile` -> Profil & Statistik Siswa
- `GET /teacher/dashboard` -> Panel Guru
- `GET /admin/dashboard` -> Panel Admin

### API Routes
- `POST /api/game/submit-answer` -> Verifikasi jawaban & kalkulasi XP di server
- `POST /api/game/complete-mission` -> Penyelesaian misi & evaluasi lencana
- `GET /api/game/hint/{question_id}` -> Mengambil hint bertahap
- `POST /api/game/reflection` -> Menyimpan refleksi siswa setelah misi
- `GET /api/leaderboard` -> Data leaderboard (Harian, Mingguan, Kelas)

---

## 5. TABLES & RELATIONS

1. `roles`: id, name, slug
2. `users`: id, role_id, name, email, avatar, password, dark_mode, sound_enabled
3. `classes`: id, name, code, teacher_id
4. `students`: id, user_id, class_id, level_id, xp, streak_count, last_active_at
5. `teachers`: id, user_id, nip, department
6. `levels`: id, level_number, title, min_xp, icon, description
7. `missions`: id, level_id, title, description, world_name, difficulty, xp_reward, total_questions
8. `questions`: id, mission_id, category_id, question_type, question_text, data_json, correct_answer, explanation, hint_1, hint_2, hint_3, xp, time_limit
9. `question_options`: id, question_id, option_key, option_text
10. `student_progress`: id, student_id, level_id, completed_at
11. `student_missions`: id, student_id, mission_id, status, score, stars, completed_at
12. `student_question_attempts`: id, student_id, question_id, is_correct, user_answer, time_taken, hint_used_count, xp_gained
13. `xp_transactions`: id, student_id, amount, source_type, source_id, description
14. `badges`: id, code, name, description, icon, requirement_type, requirement_value
15. `student_badges`: id, student_id, badge_id, unlocked_at
16. `daily_challenges`: id, date, question_id, xp_bonus
17. `streaks`: id, student_id, current_streak, max_streak, last_completed_date
18. `materials`: id, level_id, category_id, title, content, summary, reading_time_minutes
19. `categories`: id, name, slug
20. `notifications`: id, user_id, title, message, is_read
21. `activity_logs`: id, user_id, action, ip_address, created_at
22. `settings`: id, key, value

---

## 6. WORKFLOWS

### A. Authentication Flow
1. Siswa/Guru/Admin login menggunakan credential.
2. Server membuat session / Sanctum token dan mengembalikan data User + Role.
3. Front-end mengarahkan pengguna ke Dashboard sesuai role.

### B. Game & Verification Flow
1. Siswa memilih Misi / Question.
2. Jawaban dikirim ke `POST /api/game/submit-answer` (TIDAK ADA verifikasi lokal agar skor aman).
3. Server memvalidasi `user_answer` terhadap `correct_answer` (dukungan perkalian formula seperti `=SUM(B2:B10)` atau tebakan pilihan ganda).
4. Jika benar: Combo bertambah (+1), server menghitung XP dasar + bonus combo.
5. Server mencatat `student_question_attempts` dan `xp_transactions`.

### C. XP & Level Progression Flow
1. Ketika XP bertambah, server mengecek total XP siswa.
2. Jika total XP `>= min_xp` level berikutnya, status level siswa dinaikkan (`level_id += 1`).
3. Event `LevelUp` dipicu, mengembalikan status `level_up: true` ke Vue client untuk menampilkan modal animasi Level Up!

---
