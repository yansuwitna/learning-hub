# PROMPT UTAMA — EXCELVERSE

## Gamified Excel Learning Platform untuk Siswa SMK

Anda adalah **Senior Full-Stack Web Developer, UI/UX Designer, Game Designer, Educational Technology Specialist, dan Software Architect**.

Saya ingin Anda membangun aplikasi pembelajaran berbasis web bernama:

# EXCELVERSE

### Learn Excel. Play. Solve. Level Up.

Aplikasi ini adalah **game edukasi untuk membantu siswa SMK belajar Microsoft Excel secara menyenangkan melalui misi, tantangan, puzzle, XP, level, achievement, dan simulasi kasus nyata**.

Aplikasi harus terasa seperti aplikasi game modern, bukan seperti aplikasi ujian atau LMS biasa.

---

# 1. TUJUAN APLIKASI

Tujuan utama:

1. Membuat siswa tertarik belajar Excel.
2. Mengubah latihan Excel menjadi pengalaman bermain game.
3. Membantu siswa belajar dari level pemula hingga mahir.
4. Melatih kemampuan memahami masalah, membuat rumus, membaca data, dan memperbaiki kesalahan.
5. Memberikan feedback langsung setelah siswa menjawab.
6. Membantu guru memantau perkembangan belajar siswa.
7. Aplikasi harus ringan, cepat, responsif, dan dapat digunakan pada berbagai perangkat.

Gunakan pendekatan:

* Gamification
* Problem Based Learning
* Learning by Doing
* Microlearning
* Feedback langsung
* Progressive difficulty
* Pembelajaran Mendalam
* Memahami → Mengaplikasi → Merefleksi

---

# 2. TARGET PENGGUNA

### Siswa

Target utama adalah siswa SMK kelas X–XII.

Siswa harus dapat:

* Membuat akun/login.
* Memilih avatar.
* Melihat level.
* Memainkan misi.
* Menyelesaikan tantangan.
* Mendapatkan XP.
* Mendapatkan badge.
* Melihat progress.
* Mengulang materi.
* Melihat riwayat hasil belajar.

### Guru

Guru dapat:

* Melihat daftar siswa.
* Melihat progress siswa.
* Melihat hasil misi.
* Melihat skor.
* Melihat materi yang sudah dikuasai.
* Melihat soal yang paling banyak salah.
* Membuat atau mengedit misi.
* Membuat soal.
* Mengatur tingkat kesulitan.
* Melihat leaderboard kelas.
* Export laporan.

### Admin

Admin dapat:

* Mengelola pengguna.
* Mengelola kelas.
* Mengelola materi.
* Mengelola soal.
* Mengelola level.
* Mengelola badge.
* Mengelola pengaturan aplikasi.
* Melihat activity log.

---

# 3. TEKNOLOGI

Gunakan teknologi modern yang cepat dan maintainable.

## Backend

Gunakan:

* Laravel 12
* PHP 8.2+
* MySQL/MariaDB
* REST API atau arsitektur API-first
* Laravel Sanctum
* Queue jika diperlukan
* Cache
* Database indexing

## Frontend

Gunakan:

* Vue 3
* Composition API
* TypeScript
* Vite
* Pinia
* Vue Router
* Tailwind CSS

Jika memungkinkan gunakan komponen UI yang ringan dan modern.

## PWA

Aplikasi wajib mendukung:

* Progressive Web App
* Install ke Android
* Install ke Windows
* Install ke Chrome/Edge
* Responsive Web
* Offline cache untuk materi tertentu
* Service Worker
* Web App Manifest
* Splash screen
* App icon

---

# 4. PRINSIP PERFORMA

Prioritaskan kecepatan.

Aplikasi harus:

* Fast loading
* Mobile first
* Lazy loading
* Code splitting
* Component-based
* Optimized assets
* WebP/AVIF untuk gambar
* Hindari library besar yang tidak diperlukan
* Hindari animasi berat
* Gunakan caching
* Gunakan pagination
* Gunakan server-side filtering untuk data besar
* Gunakan debounce pada pencarian
* Optimalkan query database
* Hindari N+1 query
* Gunakan eager loading bila diperlukan

Target:

* First Load cepat
* Navigasi antar halaman terasa instan
* Animasi tetap smooth pada smartphone kelas menengah
* Tidak membuat browser berat

Jangan memasukkan dependency hanya karena terlihat menarik.

Setiap library harus mempunyai alasan teknis yang jelas.

---

# 5. DESAIN UI/UX

Buat desain yang:

* Modern
* Elegan
* Futuristik
* Gamified
* Profesional
* Tidak kekanak-kanakan
* Cocok untuk siswa SMK
* Mobile-first
* Responsive
* Accessible

Gunakan:

* Poppins atau Inter
* Rounded card
* Soft shadow
* Glass effect secukupnya
* Gradient secukupnya
* Icon modern
* Progress bar
* XP animation
* Achievement card
* Level indicator
* Bottom navigation untuk mobile
* Sidebar untuk desktop

Jangan membuat desain terlalu ramai.

Prioritaskan:

CONTENT → HIERARCHY → USABILITY → BEAUTY

---

# 6. TEMA VISUAL

Sediakan:

### Light Mode

Tampilan terang, bersih, profesional.

### Dark Mode

Tampilan gelap dengan nuansa game modern.

Sediakan tombol:

☀ Light

🌙 Dark

Preferensi tema harus disimpan.

---

# 7. HALAMAN SISWA

Buat halaman:

### Landing Page

Berisi:

* Logo EXCELVERSE
* Tagline
* Penjelasan singkat
* Preview game
* Fitur
* Cara bermain
* CTA "Mulai Belajar"
* Login
* Register

---

### Dashboard Siswa

Tampilkan:

Nama siswa

Avatar

Level

XP

Progress level

Streak

Achievement

Misi aktif

Misi berikutnya

Tantangan harian

Statistik belajar

Contoh:

LEVEL 05

DATA EXPLORER

XP 2.450 / 3.000

██████████████░░

🔥 5 Hari Berturut-turut

---

# 8. SISTEM LEVEL

Buat sistem progression:

### Level 1

Excel Rookie

Materi:

* Mengenal Excel
* Workbook
* Worksheet
* Cell
* Row
* Column
* Range
* Alamat cell

### Level 2

Formula Fighter

Materi:

* Operator
* SUM
* AVERAGE
* MIN
* MAX
* COUNT

### Level 3

Logic Master

Materi:

* IF
* AND
* OR
* COUNTIF
* SUMIF

### Level 4

Data Explorer

Materi:

* Sort
* Filter
* Data Validation
* Conditional Formatting

### Level 5

Spreadsheet Engineer

Materi:

* Referensi relatif
* Referensi absolut
* Lookup
* IFERROR

### Level 6

Data Analyst

Materi:

* Chart
* PivotTable
* Analisis data
* Dashboard sederhana

### Level 7

Excel Master

Berisi:

* Studi kasus
* Debugging
* Analisis data
* Proyek

---

# 9. GAME MODE

Buat beberapa jenis permainan.

## MODE 1 — QUICK QUIZ

Soal dapat berupa:

* Multiple choice
* True/False
* Tebak hasil rumus
* Susun rumus
* Cocokkan fungsi

Waktu:

30–60 detik.

---

# MODE 2 — FORMULA BATTLE

Siswa diberikan masalah.

Contoh:

Harga barang = 20.000

Jumlah = 5

Siswa harus memasukkan formula:

=20.000*5

Aplikasi memeriksa jawabannya.

---

# MODE 3 — EXCEL DETECTIVE

Siswa diberikan spreadsheet yang mempunyai kesalahan.

Contoh:

Total seharusnya:

=SUM(B2:B10)

Tetapi rumus yang digunakan:

=SUM(B2:B8)

Siswa harus:

1. Menemukan kesalahan.
2. Menjelaskan kesalahan.
3. Memperbaikinya.

---

# MODE 4 — EXCEL TYCOON

Siswa mengelola toko.

Data:

* Barang
* Harga beli
* Harga jual
* Stok
* Barang masuk
* Barang keluar
* Penjualan
* Keuntungan

Siswa harus menggunakan kemampuan Excel untuk mengelola toko.

---

# MODE 5 — DAILY CHALLENGE

Setiap hari tersedia satu tantangan.

Contoh:

"Hitung total penjualan hari ini."

Reward:

+50 XP

Jika selesai:

🔥 Daily Streak +1

---

# 10. SISTEM XP

Buat sistem XP.

Contoh:

Soal mudah:

+10 XP

Soal sedang:

+20 XP

Soal sulit:

+40 XP

Misi selesai:

+50 XP

Daily Challenge:

+30 XP

Perfect Mission:

+50 XP bonus

Jangan membuat XP hanya berdasarkan kecepatan.

Utamakan:

* Ketepatan
* Pemahaman
* Konsistensi
* Penyelesaian misi

---

# 11. SISTEM COMBO

Jika siswa menjawab beberapa soal berturut-turut dengan benar:

COMBO ×2

COMBO ×3

COMBO ×4

Tampilkan animasi ringan.

Jika salah:

Combo kembali ke 0.

Jangan gunakan animasi berat.

---

# 12. SISTEM BADGE

Buat achievement.

Contoh:

🏅 SUM MASTER

Berhasil menyelesaikan 10 soal SUM.

🏅 FORMULA HERO

Menyelesaikan 20 tantangan formula.

🏅 DATA DETECTIVE

Berhasil memperbaiki 10 kesalahan spreadsheet.

🏅 SPEED SOLVER

Menyelesaikan tantangan dalam waktu tertentu.

🏅 EXCEL MASTER

Menyelesaikan seluruh level.

Badge harus dapat ditampilkan di profil siswa.

---

# 13. SISTEM HINT

Jika siswa mengalami kesulitan:

💡 HINT

Berikan petunjuk bertahap.

Hint 1:

"Perhatikan fungsi untuk menjumlahkan."

Hint 2:

"Fungsi yang kamu perlukan adalah SUM."

Hint 3:

"Gunakan range B2:B10."

Hint harus mengurangi reward secara ringan agar siswa tetap terdorong mencoba.

---

# 14. FEEDBACK

Jangan hanya menampilkan:

❌ Jawaban Salah

Tetapi:

❌ Belum tepat.

Coba perhatikan range data.

Rumus yang kamu gunakan mengambil data sampai baris 8, sedangkan tabel memiliki data sampai baris 10.

Feedback harus bersifat:

* Singkat
* Jelas
* Edukatif
* Tidak menghakimi

Jika benar:

🎉 BENAR!

Rumusmu sudah tepat.

+20 XP

---

# 15. SISTEM SOAL

Database soal minimal mempunyai:

* id
* level_id
* kategori
* tipe_soal
* pertanyaan
* data_soal
* pilihan
* jawaban_benar
* pembahasan
* hint
* tingkat_kesulitan
* xp
* waktu
* status
* created_at
* updated_at

Tipe soal:

multiple_choice

true_false

formula_input

formula_prediction

debugging

matching

sorting

simulation

project

---

# 16. DATABASE

Rancang database yang scalable.

Minimal tabel:

users

roles

classes

students

teachers

levels

missions

questions

question_options

answers

student_progress

student_missions

student_question_attempts

xp_transactions

badges

student_badges

daily_challenges

streaks

leaderboards

materials

categories

notifications

activity_logs

settings

Gunakan foreign key dan index dengan benar.

---

# 17. DASHBOARD GURU

Dashboard guru harus menampilkan:

Jumlah siswa

Siswa aktif

Total misi selesai

Rata-rata progress

Materi dengan tingkat kesalahan tertinggi

Soal paling sulit

Grafik perkembangan kelas

Daftar siswa

Contoh:

Nama | Level | XP | Progress | Misi

Siswa 1 | 4 | 1.250 | 70% | 15

Siswa 2 | 3 | 900 | 55% | 11

---

# 18. ANALISIS PEMBELAJARAN

Guru dapat melihat:

### Materi yang dikuasai

✓ SUM

✓ AVERAGE

✓ MIN/MAX

### Materi yang perlu diperkuat

⚠ IF

⚠ COUNTIF

⚠ Referensi absolut

Tampilkan dalam dashboard dengan visualisasi sederhana.

Tujuannya bukan sekadar memberikan ranking siswa, tetapi membantu guru mengetahui bagian materi yang perlu diperkuat.

---

# 19. LEADERBOARD

Buat leaderboard sebagai fitur opsional.

Filter:

* Harian
* Mingguan
* Bulanan
* Kelas

Tampilkan:

🥇

🥈

🥉

Namun sediakan juga mode:

"Progress Saya"

sehingga siswa tidak hanya membandingkan dirinya dengan siswa lain.

---

# 20. SISTEM MISI

Setiap misi mempunyai:

Nama misi

Deskripsi

Level

Materi

Kesulitan

Estimasi waktu

XP

Jumlah soal

Status

Reward

Contoh:

### Misi #001

KASIR PEMULA

"Hitung total penjualan toko."

Materi:

SUM

Kesulitan:

⭐

Reward:

+100 XP

---

# 21. STORYLINE

Tambahkan cerita ringan.

Siswa seolah-olah menjadi:

"Data Specialist"

yang harus membantu berbagai organisasi menyelesaikan masalah menggunakan Excel.

Contoh dunia:

WORLD 1 — SCHOOL

WORLD 2 — SHOP

WORLD 3 — OFFICE

WORLD 4 — BUSINESS

WORLD 5 — DATA CENTER

Setiap dunia memiliki misi berbeda.

---

# 22. RESPONSIVE DESIGN

WAJIB berjalan dengan baik pada:

* Android
* iPhone
* Tablet
* Laptop
* Desktop

Breakpoints harus dirancang dengan pendekatan mobile-first.

Pada mobile:

* Bottom navigation
* Tombol besar
* Card sederhana
* Input mudah disentuh
* Jangan gunakan tabel lebar tanpa horizontal scroll

Pada desktop:

* Sidebar
* Dashboard multi-column
* Area game lebih luas

---

# 23. PWA

Implementasikan:

manifest.json

service worker

offline cache

install prompt

app icon

splash screen

theme color

Caching strategi:

* Cache static assets
* Cache materi yang sudah dibuka
* Cache data tertentu yang aman
* Sinkronisasi ketika koneksi kembali tersedia

Jangan menyimpan data sensitif secara sembarangan di browser.

---

# 24. OFFLINE MODE

Jika memungkinkan:

Siswa dapat memainkan beberapa:

* Materi
* Quiz
* Daily Challenge

ketika internet terputus.

Jawaban disimpan sementara.

Ketika internet kembali:

Sync

→ server

→ update XP

→ update progress

Hindari pemberian XP ganda akibat sinkronisasi ulang.

---

# 25. KEAMANAN

Implementasikan:

* Authentication
* Authorization
* Role-based access control
* CSRF protection
* XSS protection
* Validation
* Rate limiting
* Secure API
* Password hashing
* Server-side validation

Jangan pernah mempercayai skor atau XP yang dikirim langsung dari browser.

XP dan hasil permainan harus diverifikasi oleh server.

---

# 26. KODE

Gunakan:

* Clean Architecture yang proporsional
* Reusable components
* Service layer jika diperlukan
* Form Request
* API Resource
* Policy
* Repository hanya jika memang diperlukan
* TypeScript interface/type
* Naming yang konsisten

Gunakan bahasa Indonesia untuk:

* Label UI
* Menu
* Deskripsi
* Materi
* Feedback

Gunakan bahasa Inggris untuk:

* Nama class
* Nama method
* Nama database table
* Nama variable

Berikan komentar kode hanya pada bagian yang penting agar mudah dirawat.

---

# 27. KOMPONEN VUE

Buat reusable components:

AppHeader

AppSidebar

MobileBottomNav

ProgressBar

XpBadge

LevelCard

MissionCard

QuestionCard

QuizOption

Timer

ComboCounter

HintPanel

ResultModal

AchievementCard

Leaderboard

StatCard

ToastNotification

LoadingSkeleton

EmptyState

ConfirmDialog

---

# 28. ANIMASI

Gunakan animasi secukupnya.

Contoh:

XP bertambah:

+20 XP

Level Up:

LEVEL UP!

Badge:

ACHIEVEMENT UNLOCKED

Jawaban benar:

✓ Correct

Jawaban salah:

Try Again

Gunakan CSS animation atau library ringan.

Jangan menggunakan animasi berat yang membuat smartphone lambat.

---

# 29. AUDIO

Audio bersifat:

OPTIONAL

Sediakan pengaturan:

🔊 Sound ON/OFF

Jangan memainkan audio otomatis ketika halaman dibuka.

---

# 30. AKSESIBILITAS

Perhatikan:

* Keyboard navigation
* Focus state
* Kontras
* ARIA label
* Ukuran tombol
* Screen reader
* Reduced motion

Sediakan:

"Reduce Animation"

untuk perangkat pengguna.

---

# 31. PERFORMANCE MONITORING

Sediakan struktur agar nantinya mudah diintegrasikan dengan:

* Web Vitals
* Error tracking
* Activity monitoring

Jangan memasukkan layanan eksternal yang tidak diperlukan pada MVP.

---

# 32. ADMIN PANEL

Admin panel harus sederhana.

Menu:

Dashboard

Pengguna

Kelas

Level

Misi

Soal

Materi

Badge

Daily Challenge

Laporan

Activity Log

Pengaturan

---

# 33. GURU PANEL

Menu:

Dashboard

Kelas Saya

Siswa

Misi

Soal

Progress

Analisis

Laporan

---

# 34. SISWA PANEL

Menu:

Home

Misi

Learn

Challenge

Achievement

Leaderboard

Profile

---

# 35. SISTEM NAVIGASI

Desktop:

Sidebar + Header

Mobile:

Bottom Navigation

Navigasi jangan membuat halaman reload penuh.

Gunakan SPA experience.

---

# 36. LANDING PAGE

Buat landing page yang sangat menarik.

Hero:

EXCELVERSE

"Belajar Excel dengan cara yang berbeda."

CTA:

MULAI BERMAIN

Section:

Kenapa ExcelVerse?

Learn

Play

Solve

Level Up

Section:

Cara bermain

1. Pilih misi
2. Pecahkan masalah
3. Dapatkan XP
4. Naik level

Section:

Preview game

Section:

Achievement

Section:

Untuk Guru

CTA:

"Mulai Petualangan"

---

# 37. DATA DEMO

Saat instalasi pertama, buat Seeder:

Admin demo

Guru demo

Siswa demo

Class demo

7 level

Minimal 30 mission

Minimal 100 soal

Minimal 10 badge

Daily challenge

Leaderboard demo

Gunakan data yang realistis dan relevan dengan pembelajaran Excel.

---

# 38. CONTOH MATERI

Buat materi:

1. Mengenal Excel
2. Cell dan Range
3. Operator
4. SUM
5. AVERAGE
6. MIN
7. MAX
8. COUNT
9. IF
10. AND
11. OR
12. COUNTIF
13. SUMIF
14. Sort
15. Filter
16. Data Validation
17. Conditional Formatting
18. Referensi Absolut
19. Lookup
20. Chart
21. PivotTable
22. Studi Kasus
23. Debugging
24. Proyek Pengelolaan Barang

---

# 39. CONTOH STUDI KASUS

Gunakan kasus yang dekat dengan siswa SMK.

Contoh:

### TOKO KOMPUTER

Data:

Kode Barang

Nama Barang

Harga

Stok

Barang Masuk

Barang Keluar

Stok Akhir

Siswa harus menghitung:

Stok Akhir

Total Nilai Stok

Total Penjualan

Keuntungan

Barang dengan stok minimum

---

# 40. SISTEM REFLEKSI

Setelah misi selesai tampilkan:

### REFLEKSI

Apa yang kamu pelajari?

Apa kesalahan yang kamu lakukan?

Bagian mana yang masih membingungkan?

Apa strategi yang akan kamu gunakan pada misi berikutnya?

Gunakan pilihan sederhana dan jawaban singkat.

Data refleksi dapat dilihat guru.

---

# 41. JANGAN MEMBUAT APLIKASI SEPERTI LMS

Ini sangat penting.

EXCELVERSE harus terasa seperti:

GAME + LEARNING

bukan:

LMS + QUIZ

Ketika siswa membuka aplikasi, hal pertama yang harus terasa adalah:

"Ini game."

bukan:

"Ini tugas sekolah."

---

# 42. ARSITEKTUR PROYEK

Buat struktur proyek yang rapi dan mudah dikembangkan.

Pisahkan:

Backend

Frontend

Components

Pages

Layouts

Stores

Services

Types

API

Database

Seeders

Tests

Dokumentasikan struktur folder.

---

# 43. TESTING

Buat:

* Unit test
* Feature test
* API test
* Authentication test
* Authorization test
* Game scoring test
* XP calculation test
* Progress calculation test
* Duplicate reward prevention test

Pastikan XP tidak dapat dimanipulasi melalui browser.

---

# 44. ERROR HANDLING

Buat UX error yang bagus.

Jangan tampilkan error teknis Laravel kepada siswa.

Contoh:

"Ups! Terjadi masalah."

"Coba lagi beberapa saat."

Guru/admin dapat melihat detail error melalui log.

---

# 45. LOADING EXPERIENCE

Gunakan:

Skeleton loading

Optimistic UI hanya untuk operasi yang aman

Toast

Progress indicator

Jangan membuat siswa menunggu halaman kosong.

---

# 46. HASIL AKHIR

Saya tidak ingin sekadar mendapatkan contoh kode.

Bangun aplikasi secara bertahap sampai menjadi aplikasi yang dapat dijalankan.

Tahapan:

PHASE 1

Setup project

PHASE 2

Database + migration

PHASE 3

Authentication + RBAC

PHASE 4

Dashboard

PHASE 5

Game engine

PHASE 6

Question system

PHASE 7

XP + Level

PHASE 8

Achievement

PHASE 9

Teacher dashboard

PHASE 10

Admin dashboard

PHASE 11

PWA

PHASE 12

Performance optimization

PHASE 13

Testing

PHASE 14

Deployment

---

# 47. ATURAN PENTING UNTUK AI CODING AGENT

Jangan memberikan pseudo-code.

Jangan memberikan kode yang sengaja dipotong.

Jangan menggunakan:

"dan seterusnya"

"implementasikan sendiri"

"kode lainnya sama"

Jika membuat file, tampilkan isi file lengkap.

Jika proyek terlalu besar untuk satu respons, kerjakan berdasarkan PHASE secara berurutan.

Setiap phase harus menghasilkan aplikasi yang tetap dapat dijalankan.

Jangan mengubah teknologi tanpa alasan.

Jangan menambahkan dependency yang tidak diperlukan.

Sebelum membuat kode:

1. Analisis kebutuhan.
2. Tentukan arsitektur.
3. Tentukan database.
4. Tentukan alur pengguna.
5. Tentukan komponen.
6. Baru implementasikan.

Setelah setiap phase:

* Periksa dependency.
* Periksa migration.
* Periksa route.
* Periksa API.
* Periksa authentication.
* Periksa responsive UI.
* Periksa error.
* Periksa performa.
* Periksa keamanan.

---

# 48. PRIORITAS UTAMA

Urutan prioritas:

1. FUNCTIONAL
2. FAST
3. RESPONSIVE
4. EASY TO USE
5. EDUCATIONAL
6. BEAUTIFUL
7. GAMIFIED

Jangan mengorbankan performa hanya untuk efek visual.

---

# 49. HASIL YANG SAYA INGINKAN

Saya ingin menghasilkan aplikasi:

**EXCELVERSE**

yang terasa seperti:

🎮 Game modern

*

📚 Aplikasi pembelajaran

*

📊 Spreadsheet learning

*

🏆 Achievement system

*

🧠 Problem solving

*

📱 PWA

Aplikasi harus dapat digunakan melalui:

Chrome

Edge

Firefox

Android

iPhone

Tablet

Laptop

Desktop

dengan satu basis kode.

---

# 50. MULAI SEKARANG

Mulai dari:

### STEP 1

Buat Software Architecture.

Tampilkan:

* Architecture diagram dalam bentuk teks
* Database ERD dalam bentuk teks
* Struktur folder
* Daftar route
* Daftar API
* Daftar halaman
* Daftar component
* Daftar tabel
* Relasi database
* Alur authentication
* Alur game
* Alur XP
* Alur scoring
* Alur progress

Kemudian lanjutkan implementasi **PHASE 1**.

Jangan langsung membuat semua fitur sekaligus.

Pastikan setiap tahap dapat dijalankan dan diuji sebelum melanjutkan ke tahap berikutnya.

Gunakan prinsip:

**BUILD → TEST → FIX → OPTIMIZE → CONTINUE**

Hasil akhir harus berupa aplikasi production-ready yang dapat dikembangkan lebih lanjut.
