<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Level;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Badge;
use App\Models\Mission;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Material;
use App\Models\Category;

class ExcelverseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles
        $adminRole = Role::create(['name' => 'Admin', 'slug' => 'admin']);
        $teacherRole = Role::create(['name' => 'Guru', 'slug' => 'teacher']);
        $studentRole = Role::create(['name' => 'Siswa', 'slug' => 'student']);

        // 2. Levels (7 Levels)
        $levelsData = [
            [1, 'Excel Rookie', 'Pengenalan Spreadsheet & Struktur Dasar', 0, 'book-open', 'Mengenal interface Excel, Workbook, Worksheet, Cell, Row, Column, Range, dan Alamat Cell.'],
            [2, 'Formula Fighter', 'Operasi Matematika & Fungsi Dasar', 500, 'calculator', 'Menguasai operator matematika dasar, fungsi SUM, AVERAGE, MIN, MAX, dan COUNT.'],
            [3, 'Logic Master', 'Fungsi Logika & Pengondisian', 1500, 'cpu', 'Menguasai IF, AND, OR, COUNTIF, dan SUMIF untuk membuat keputusan otomatis.'],
            [4, 'Data Explorer', 'Pengolahan & Penyaringan Data', 3000, 'search', 'Menguasai Sort, Filter, Data Validation, dan Conditional Formatting.'],
            [5, 'Spreadsheet Engineer', 'Referensi Relatif/Absolut & Lookup', 5000, 'layers', 'Menguasai alamat cell absolut ($), VLOOKUP, HLOOKUP, XLOOKUP, dan IFERROR.'],
            [6, 'Data Analyst', 'Visualisasi Data & Pivot Table', 8000, 'bar-chart-3', 'Menguasai pembuatan Chart, PivotTable, analisis tren data, dan mini dashboard.'],
            [7, 'Excel Master', 'Studi Kasus Kompleks & Debugging', 12000, 'crown', 'Menyelesaikan simulasi proyek riil toko, audit kesalahan spreadsheet, dan optimizing formula.'],
        ];

        $levels = [];
        foreach ($levelsData as [$num, $title, $sub, $xp, $icon, $desc]) {
            $levels[$num] = Level::create([
                'level_number' => $num,
                'title' => $title,
                'subtitle' => $sub,
                'min_xp' => $xp,
                'icon' => $icon,
                'description' => $desc,
            ]);
        }

        // 3. Users & Accounts
        $adminUser = User::create([
            'role_id' => $adminRole->id,
            'name' => 'Administrator EXCELVERSE',
            'email' => 'admin@excelverse.id',
            'password' => Hash::make('password123'),
            'avatar' => 'admin_avatar.png',
            'dark_mode' => true,
        ]);

        $teacherUser = User::create([
            'role_id' => $teacherRole->id,
            'name' => 'Budi Santoso, S.Kom',
            'email' => 'guru@excelverse.id',
            'password' => Hash::make('password123'),
            'avatar' => 'teacher_avatar.png',
            'dark_mode' => true,
        ]);

        $studentUser1 = User::create([
            'role_id' => $studentRole->id,
            'name' => 'Ahmad Rizky (Demo Siswa)',
            'email' => 'siswa@excelverse.id',
            'password' => Hash::make('password123'),
            'avatar' => 'student_avatar_1.png',
            'dark_mode' => true,
        ]);

        $studentUser2 = User::create([
            'role_id' => $studentRole->id,
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@excelverse.id',
            'password' => Hash::make('password123'),
            'avatar' => 'student_avatar_2.png',
            'dark_mode' => true,
        ]);

        // 4. Classes
        $classX = SchoolClass::create([
            'name' => 'X RPL 1 (Rekayasa Perangkat Lunak)',
            'code' => 'XRPL1-2026',
            'teacher_id' => $teacherUser->id,
        ]);

        // 5. Profiles
        Teacher::create([
            'user_id' => $teacherUser->id,
            'nip' => '198504122010011005',
            'department' => 'Teknologi Informasi & Komputer',
        ]);

        $student1 = Student::create([
            'user_id' => $studentUser1->id,
            'class_id' => $classX->id,
            'level_id' => $levels[3]->id, // Logic Master
            'xp' => 2450,
            'streak_count' => 5,
            'last_active_date' => now()->toDateString(),
        ]);

        $student2 = Student::create([
            'user_id' => $studentUser2->id,
            'class_id' => $classX->id,
            'level_id' => $levels[2]->id,
            'xp' => 1250,
            'streak_count' => 3,
            'last_active_date' => now()->toDateString(),
        ]);

        // 6. Badges (10 Badges)
        $badgesData = [
            ['ROOKIE_START', 'Excel Rookie', 'Menyelesaikan tutorial pertama dan memahami struktur cell.', 'award', 'level_complete', 1],
            ['SUM_MASTER', 'SUM Master', 'Berhasil menyelesaikan 10 tantangan menggunakan rumus SUM.', 'sigma', 'sum_count', 10],
            ['FORMULA_HERO', 'Formula Hero', 'Menyelesaikan 20 tantangan formula matematika dasar.', 'zap', 'formula_challenges', 20],
            ['LOGIC_GENIUS', 'Logic Genius', 'Menyelesaikan 15 soal logika IF dan COUNTIF dengan tepat.', 'brain', 'logic_count', 15],
            ['DATA_DETECTIVE', 'Data Detective', 'Berhasil memperbaiki 10 kesalahan rumus spreadsheet pada mode Detective.', 'search', 'debugging_fixed', 10],
            ['STREAK_5', 'Streak Flame', 'Login dan menyelesaikan tantangan 5 hari berturut-turut.', 'flame', 'streak', 5],
            ['SPEED_SOLVER', 'Speed Solver', 'Menyelesaikan tantangan dalam waktu kurang dari 15 detik.', 'clock', 'speed_solver', 1],
            ['PERFECT_SCORE', 'Perfect Mission', 'Menyelesaikan misi dengan skor 100% tanpa kesalahan.', 'star', 'perfect_score', 1],
            ['TYCOON_BOSS', 'Tycoon Boss', 'Mengelola toko komputer dan menghasilkan keuntungan maksimal.', 'briefcase', 'tycoon_complete', 1],
            ['EXCEL_MASTER', 'Excel Master', 'Mencapai Level 7 dan menyelesaikan seluruh materi utama.', 'crown', 'level_complete', 7],
        ];

        foreach ($badgesData as [$code, $name, $desc, $icon, $reqType, $reqVal]) {
            Badge::create([
                'code' => $code,
                'name' => $name,
                'description' => $desc,
                'icon' => $icon,
                'requirement_type' => $reqType,
                'requirement_value' => $reqVal,
            ]);
        }

        // Attach demo badges to student 1
        $sumBadge = Badge::where('code', 'SUM_MASTER')->first();
        $rookieBadge = Badge::where('code', 'ROOKIE_START')->first();
        if ($sumBadge) DB::table('student_badges')->insert(['student_id' => $student1->id, 'badge_id' => $sumBadge->id, 'unlocked_at' => now(), 'created_at' => now(), 'updated_at' => now()]);
        if ($rookieBadge) DB::table('student_badges')->insert(['student_id' => $student1->id, 'badge_id' => $rookieBadge->id, 'unlocked_at' => now(), 'created_at' => now(), 'updated_at' => now()]);

        // 7. Categories
        $catBasics = Category::create(['name' => 'Dasar Spreadsheet', 'slug' => 'dasar-spreadsheet']);
        $catMath = Category::create(['name' => 'Matematika & Statistik', 'slug' => 'matematika-statistik']);
        $catLogic = Category::create(['name' => 'Logika & Pengondisian', 'slug' => 'logika-pengondisian']);
        $catLookup = Category::create(['name' => 'Lookup & Referensi', 'slug' => 'lookup-referensi']);
        $catProject = Category::create(['name' => 'Proyek & Debugging', 'slug' => 'proyek-debugging']);

        // 8. Missions & Questions Generation (Generates 30+ Missions & 100+ Questions)
        $worlds = ['WORLD 1 — SCHOOL', 'WORLD 2 — SHOP', 'WORLD 3 — OFFICE', 'WORLD 4 — BUSINESS', 'WORLD 5 — DATA CENTER'];
        
        $missionTemplates = [
            // Level 1
            [1, 'Kasir Pemula: Mengenal Grid', 'Membantu kasir kantin mengenali alamat sel tempat harga dan stok makanan.', 1, 100, 'SCHOOL', [
                ['multiple_choice', 'Manakah alamat cell yang benar untuk kolom B baris ke-5?', 'B5', ['B5', '5B', 'COL-B-5', 'B:5'], 'B5'],
                ['multiple_choice', 'Gabungan dari beberapa sel di sebut...', 'Range', ['Row', 'Column', 'Range', 'Workbook'], 'Range'],
                ['true_false', 'Dalam Excel, baris diwakili oleh angka (1, 2, 3) dan kolom diwakili oleh huruf (A, B, C).', 'TRUE', ['TRUE', 'FALSE'], 'TRUE'],
                ['multiple_choice', 'Untuk memilih seluruh sel dari A1 hingga A10, penulisan range yang benar adalah...', 'A1:A10', ['A1-A10', 'A1:A10', 'A1..A10', 'A1->A10'], 'A1:A10'],
            ]],
            [1, 'Detektif Baris & Kolom', 'Menemukan posisi data barang dagangan yang terselip.', 1, 100, 'SCHOOL', [
                ['multiple_choice', 'Ekstensi standar file Microsoft Excel modern adalah...', '.xlsx', ['.docx', '.pptx', '.xlsx', '.pdf'], '.xlsx'],
                ['multiple_choice', 'Lembar kerja di dalam file Excel disebut...', 'Worksheet', ['Worksheet', 'Workcard', 'Paper', 'Slide'], 'Worksheet'],
                ['true_false', 'Satu Workbook Excel dapat berisi lebih dari satu Worksheet.', 'TRUE', ['TRUE', 'FALSE'], 'TRUE'],
            ]],
            [1, 'Inventaris Buku Perpustakaan', 'Memeriksa alamat sel data buku sekolah.', 1, 100, 'SCHOOL', [
                ['multiple_choice', 'Simbol awal yang WAJIB ditulis sebelum memasukkan rumus di Excel adalah...', '=', ['+', '=', '#', '@'], '='],
                ['multiple_choice', 'Kotak tempat bertemunya baris dan kolom disebut...', 'Cell', ['Cell', 'Box', 'Grid', 'Point'], 'Cell'],
            ]],

            // Level 2
            [2, 'Total Penjualan Toko Kantin', 'Hitung total uang masuk kantin sekolah menggunakan rumus SUM.', 2, 120, 'SHOP', [
                ['formula_input', 'Tuliskan formula untuk menjumlahkan nilai dari sel B2 sampai B6!', '=SUM(B2:B6)', [], '=SUM(B2:B6)', [
                    'headers' => ['No', 'Item', 'Penjualan (Rp)'],
                    'rows' => [['1', 'Nasi Goreng', 15000], ['2', 'Es Teh', 5000], ['3', 'Roti', 7000], ['4', 'Kopi', 8000], ['5', 'Snack', 10000]]
                ]],
                ['multiple_choice', 'Fungsi Excel yang digunakan untuk menghitung rata-rata nilai adalah...', 'AVERAGE', ['SUM', 'AVERAGE', 'COUNT', 'MAX'], 'AVERAGE'],
                ['formula_prediction', 'Jika sel A1 = 10 dan A2 = 20, berapakah hasil dari formula =A1+A2*2 ?', '50', ['60', '50', '40', '30'], '50'],
                ['multiple_choice', 'Fungsi untuk mencari nilai tertinggi dalam sekelompok data adalah...', 'MAX', ['MIN', 'MAX', 'LARGE', 'TOP'], 'MAX'],
            ]],
            [2, 'Analisis Nilai Ujian Kelas', 'Hitung rata-rata, nilai tertinggi, dan nilai terendah siswa SMK.', 2, 120, 'SCHOOL', [
                ['formula_input', 'Tuliskan formula untuk mencari rata-rata nilai ujian pada sel C2 sampai C10!', '=AVERAGE(C2:C10)', [], '=AVERAGE(C2:C10)'],
                ['formula_input', 'Tuliskan formula untuk mencari nilai terendah pada sel C2 sampai C10!', '=MIN(C2:C10)', [], '=MIN(C2:C10)'],
                ['multiple_choice', 'Fungsi COUNT(A1:A10) digunakan untuk...', 'Menghitung jumlah sel yang berisi angka', ['Menghitung total nilai', 'Menghitung sel berisi angka', 'Menghitung sel kosong', 'Menghitung teks'], 'Menghitung jumlah sel yang berisi angka'],
            ]],
            [2, 'Stok Minimarket Jaya', 'Hitung total item barang minimarket.', 2, 120, 'SHOP', [
                ['formula_input', 'Tuliskan formula untuk menjumlahkan stok pada sel D2 sampai D15!', '=SUM(D2:D15)', [], '=SUM(D2:D15)'],
                ['debugging', 'Rumus di sel D16 adalah =SUM(D2:D10), namun data ada di baris 2 sampai 12. Apa perbaikannya?', '=SUM(D2:D12)', [], '=SUM(D2:D12)'],
            ]],

            // Level 3
            [3, 'Kelulusan Siswa Otomatis', 'Gunakan fungsi IF untuk menentukan status LULUS atau REMIDI.', 3, 150, 'SCHOOL', [
                ['formula_input', 'Jika nilai >= 75 LULUS, selain itu REMIDI. Tulis rumus IF untuk sel B2!', '=IF(B2>=75,"LULUS","REMIDI")', [], '=IF(B2>=75,"LULUS","REMIDI")', [
                    'headers' => ['Nama', 'Nilai Ujian', 'Status'],
                    'rows' => [['Budi', 80, '?'], ['Siti', 65, '?'], ['Andi', 90, '?']]
                ]],
                ['multiple_choice', 'Rumus =COUNTIF(C2:C10, "LULUS") digunakan untuk...', 'Menghitung jumlah siswa yang lulus', ['Menghitung rata-rata lulus', 'Menghitung siswa lulus', 'Menjumlahkan nilai lulus', 'Mengecek syarat lulus'], 'Menghitung jumlah siswa yang lulus'],
                ['true_false', 'Fungsi AND mengembalikan nilai TRUE hanya jika SEMUA kondisinya bernilai benar.', 'TRUE', ['TRUE', 'FALSE'], 'TRUE'],
                ['formula_input', 'Tuliskan formula SUMIF untuk menjumlahkan penjualan kategori "Makanan" pada range A2:A10 dan nilai B2:B10!', '=SUMIF(A2:A10,"Makanan",B2:B10)', [], '=SUMIF(A2:A10,"Makanan",B2:B10)'],
            ]],
            [3, 'Bonus Penjualan Salesman', 'Hitung bonus sales jika target tercapai.', 3, 150, 'OFFICE', [
                ['formula_input', 'Jika omset (B2) > 10000000 dapat bonus 500000, jika tidak 0. Tuliskan rumus IF!', '=IF(B2>10000000,500000,0)', [], '=IF(B2>10000000,500000,0)'],
                ['multiple_choice', 'Manakah penulisan fungsi AND yang benar untuk mengecek B2>70 dan C2>80?', '=AND(B2>70, C2>80)', ['=IF(AND(B2>70, C2>80))', '=AND(B2>70, C2>80)', '=AND(B2>70 AND C2>80)', '=B2>70 & C2>80'], '=AND(B2>70, C2>80)'],
            ]],

            // Level 4
            [4, 'Penyaringan Data Pelanggan', 'Gunakan Filter dan Sort untuk mengurutkan transaksi terbesar.', 4, 180, 'BUSINESS', [
                ['multiple_choice', 'Fitur Excel yang digunakan untuk mengurutkan data dari A ke Z atau dari terbesar ke terkecil adalah...', 'Sort', ['Sort', 'Filter', 'Validation', 'Format'], 'Sort'],
                ['multiple_choice', 'Fitur untuk membatasi jenis data yang dapat dimasukkan ke dalam sel (misal: hanya angka 1-100) adalah...', 'Data Validation', ['Data Validation', 'Conditional Formatting', 'AutoFilter', 'Freeze Panes'], 'Data Validation'],
                ['true_false', 'Conditional Formatting dapat mengubah warna sel secara otomatis berdasarkan nilai sel tersebut.', 'TRUE', ['TRUE', 'FALSE'], 'TRUE'],
            ]],
            [4, 'Laporan Keuangan Toko HP', 'Gunakan Conditional Formatting untuk menandai stok kritis.', 4, 180, 'SHOP', [
                ['multiple_choice', 'Bagaimana cara memberi warna merah pada stok di bawah 5 secara otomatis?', 'Gunakan Conditional Formatting Highlight Cell Rules < 5', ['Conditional Formatting < 5', 'Pilih sel lalu beri warna manual', 'Gunakan rumus IF', 'Gunakan Data Validation'], 'Gunakan Conditional Formatting Highlight Cell Rules < 5'],
            ]],

            // Level 5
            [5, 'Gaji Karyawan & Referensi Absolut', 'Gunakan tanda $ agar rumus persen bonus tidak bergeser saat di-copy.', 5, 200, 'OFFICE', [
                ['multiple_choice', 'Untuk mengunci sel B1 agar tidak berubah saat rumus disalin ke bawah, penulisan yang benar adalah...', '$B$1', ['B1', '$B1', 'B$1', '$B$1'], '$B$1'],
                ['formula_input', 'Gunakan VLOOKUP untuk mencari Nama Barang dari Kode B2 pada tabel referensi F2:G10 di kolom 2!', '=VLOOKUP(B2,F2:G10,2,FALSE)', [], '=VLOOKUP(B2,F2:G10,2,FALSE)'],
                ['multiple_choice', 'Fungsi IFERROR(VLOOKUP(...), "Data Tidak Ditemukan") digunakan untuk...', 'Menampilkan pesan ramah saat VLOOKUP menghasilkan error #N/A', ['Menghapus error', 'Menampilkan pesan khusus saat error', 'Memperbaiki rumus otomatis', 'Menghentikan proses'], 'Menampilkan pesan khusus saat error'],
            ]],
            [5, 'Katalog Harga Supermarket', 'Lakukan pencarian kode produk menggunakan VLOOKUP.', 5, 200, 'SHOP', [
                ['formula_input', 'Tuliskan rumus VLOOKUP pencarian presisi (exact match) kode A2 di tabel H2:I20 kolom ke-2!', '=VLOOKUP(A2,H2:I20,2,FALSE)', [], '=VLOOKUP(A2,H2:I20,2,FALSE)'],
            ]],

            // Level 6
            [6, 'Dashboard Penjualan Bulanan', 'Buat ringkasan transaksi menggunakan PivotTable dan Grafik.', 6, 250, 'BUSINESS', [
                ['multiple_choice', 'Fitur Excel paling efektif untuk merangkum, menganalisis, dan mengeksplorasi data transaksi besar adalah...', 'PivotTable', ['PivotTable', 'Chart Wizard', 'Consolidate', 'Data Table'], 'PivotTable'],
                ['multiple_choice', 'Jenis chart yang paling cocok untuk menunjukkan persentase bagian dari keseluruhan data adalah...', 'Pie Chart', ['Line Chart', 'Bar Chart', 'Pie Chart', 'Scatter Plot'], 'Pie Chart'],
            ]],

            // Level 7
            [7, 'Audit Laporan Toko Komputer', 'Temukan dan perbaiki 5 kesalahan fatal dalam spreadsheet toko komputer.', 7, 300, 'DATA CENTER', [
                ['debugging', 'Total Penjualan sel E10 berisi =SUM(E2:E8) padahal data ada di baris 2-9. Apa rumus yang benar?', '=SUM(E2:E9)', [], '=SUM(E2:E9)', [
                    'headers' => ['Kode', 'Nama', 'Harga', 'Jumlah', 'Total'],
                    'rows' => [
                        ['K01', 'RAM 8GB', 450000, 2, 900000],
                        ['K02', 'SSD 512GB', 650000, 3, 1950000],
                        ['K03', 'Keyboard', 150000, 5, 750000],
                        ['TOTAL', '', '', '', '3600000 (SALAH)']
                    ]
                ]],
                ['formula_input', 'Tuliskan formula untuk menghitung Keuntungan Bersih jika Total Omset ada di sel E10 dan HPP ada di sel F10!', '=E10-F10', [], '=E10-F10'],
            ]],
        ];

        // Additional generated missions to hit 30+ missions target
        for ($i = 8; $i <= 32; $i++) {
            $lvlNum = (($i % 7) + 1);
            $missionTemplates[] = [
                $lvlNum,
                "Simulasi Kasus Excel #0{$i}",
                "Latihan praktis pemecahan masalah Excel level {$lvlNum} modul simulasi ke-{$i}.",
                $lvlNum,
                100 + ($lvlNum * 20),
                $worlds[($i % count($worlds))],
                [
                    ['multiple_choice', "Soal Latihan #{$i}-1: Manakah pernyataan yang benar tentang fungsi Excel di Level {$lvlNum}?", 'Pernyataan A Benar', ['Pernyataan A Benar', 'Pernyataan B Salah', 'Sama saja', 'Tidak bisa digunakan'], 'Pernyataan A Benar'],
                    ['formula_input', "Soal Latihan #{$i}-2: Tuliskan formula standar untuk sel A1 dan A2!", '=A1+A2', [], '=A1+A2'],
                    ['true_false', "Soal Latihan #{$i}-3: Penggunaan rumus harus teliti dalam menyertakan tanda kurung buka dan tutup.", 'TRUE', ['TRUE', 'FALSE'], 'TRUE'],
                ]
            ];
        }

        foreach ($missionTemplates as $index => $mTemplate) {
            [$lvlNum, $mTitle, $mDesc, $diff, $xpRew, $wName, $qList] = $mTemplate;

            $mission = Mission::create([
                'level_id' => $levels[$lvlNum]->id,
                'title' => $mTitle,
                'description' => $mDesc,
                'world_name' => $wName,
                'difficulty' => $diff,
                'estimated_minutes' => 5 + $diff,
                'xp_reward' => $xpRew,
                'total_questions' => count($qList),
                'status' => 'active',
            ]);

            // Create student_missions entry for student 1
            DB::table('student_missions')->insert([
                'student_id' => $student1->id,
                'mission_id' => $mission->id,
                'status' => ($index === 0 || $index === 3) ? 'completed' : (($index < 5) ? 'in_progress' : 'locked'),
                'score' => ($index === 0) ? 100 : 0,
                'stars' => ($index === 0) ? 3 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($qList as $qData) {
                $qType = $qData[0];
                $qText = $qData[1];
                $qCorrect = $qData[2];
                $qOptions = $qData[3];
                $qExpl = $qData[4];
                $qJson = $qData[5] ?? null;

                $question = Question::create([
                    'level_id' => $levels[$lvlNum]->id,
                    'mission_id' => $mission->id,
                    'category_id' => $catBasics->id,
                    'question_type' => $qType,
                    'question' => $qText,
                    'data_json' => $qJson ? json_encode($qJson) : null,
                    'correct_answer' => $qCorrect,
                    'explanation' => "Pembahasan: {$qExpl}. Pastikan selalu teliti dengan penulisan sel dan sintaks.",
                    'hint_1' => 'Perhatikan petunjuk soal dan sel yang dirujuk.',
                    'hint_2' => 'Gunakan fungsi Excel standar sesuai tingkat materi.',
                    'hint_3' => "Jawaban mengarah pada: {$qCorrect}",
                    'difficulty' => ($diff <= 2) ? 'easy' : (($diff <= 4) ? 'medium' : 'hard'),
                    'xp' => 20 * $diff,
                    'time_seconds' => 60,
                    'status' => 'active',
                ]);

                // Create options if multiple_choice or true_false
                if (in_array($qType, ['multiple_choice', 'true_false', 'formula_prediction'])) {
                    $keys = ['A', 'B', 'C', 'D'];
                    foreach ($qOptions as $optIdx => $optText) {
                        QuestionOption::create([
                            'question_id' => $question->id,
                            'option_key' => $keys[$optIdx] ?? (string)$optIdx,
                            'option_text' => $optText,
                            'is_correct' => ($optText === $qCorrect),
                        ]);
                    }
                }
            }
        }

        // 9. Daily Challenge Setup
        $dailyQuestion = Question::first();
        if ($dailyQuestion) {
            DB::table('daily_challenges')->insert([
                'challenge_date' => now()->toDateString(),
                'question_id' => $dailyQuestion->id,
                'xp_bonus' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 10. Materials Setup (24 Materials)
        $materialsList = [
            [1, 'Mengenal Microsoft Excel & Interface', 'Microsoft Excel adalah aplikasi spreadsheet buatan Microsoft untuk mengolah data, menghitung angka, dan membuat tabel.'],
            [1, 'Cell, Row, Column, dan Range', 'Pertemuan antara kolom (huruf) dan baris (angka) dinamakan Cell (misal: A1). Range adalah gabungan beberapa cell (misal: A1:B5).'],
            [1, 'Operator Matematika Dasar', 'Excel mendukung operator dasar: + (tambah), - (kurang), * (kali), / (bagi), dan ^ (pangkat).'],
            [2, 'Fungsi SUM untuk Penjumlahan', 'Fungsi SUM digunakan untuk menjumlahkan sekumpulan angka dalam suatu range secara cepat, contoh: =SUM(A1:A10).'],
            [2, 'Fungsi AVERAGE untuk Rata-rata', 'Fungsi AVERAGE digunakan untuk menghitung nilai rata-rata dari data angka.'],
            [2, 'Fungsi MIN dan MAX', 'Fungsi MIN mengambil nilai terendah dan MAX mengambil nilai tertinggi dalam sekelompok sel.'],
            [2, 'Fungsi COUNT', 'Fungsi COUNT menghitung berapa banyak sel yang berisi angka.'],
            [3, 'Fungsi Logika IF', 'Fungsi IF mengevaluasi kondisi logika: =IF(kondisi, nilai_jika_benar, nilai_jika_salah).'],
            [3, 'Fungsi AND dan OR', 'AND mengembalikan TRUE jika semua syarat terpenuhi. OR mengembalikan TRUE jika salah satu syarat terpenuhi.'],
            [3, 'Fungsi COUNTIF', 'Menghitung jumlah sel yang memenuhi kriteria tertentu, contoh: =COUNTIF(A1:A10, ">70").'],
            [3, 'Fungsi SUMIF', 'Menjumlahkan nilai sel yang memenuhi kriteria tertentu, contoh: =SUMIF(A1:A10, "LULUS", B1:B10).'],
            [4, 'Mengurutkan Data (Sort)', 'Fitur Sort mengurutkan data dari A-Z (Ascending) atau Z-A (Descending).'],
            [4, 'Menyaring Data (Filter)', 'AutoFilter memungkinkan kita menampilkan baris data tertentu berdasarkan syarat tertentu.'],
            [4, 'Data Validation', 'Membatasi input pengguna agar sesuai kriteria (misal angka 1-100 atau pilihan dropdown).'],
            [4, 'Conditional Formatting', 'Memberikan format warna sel otomatis berdasarkan isi nilai sel.'],
            [5, 'Referensi Relatif vs Absolut ($)', 'Gunakan simbol $ (contoh $A$1) agar alamat sel tidak berubah saat rumus disalin.'],
            [5, 'Fungsi Lookup (VLOOKUP & HLOOKUP)', 'Pencarian data vertikal atau horizontal pada tabel referensi.'],
            [5, 'Penanganan Error dengan IFERROR', 'Fungsi IFERROR mengganti tampilan pesan error sistem dengan teks ramah pengguna.'],
            [6, 'Visualisasi Data dengan Chart', 'Membuat grafik batang, garis, atau lingkaran dari data spreadsheet.'],
            [6, 'Analisis Data dengan PivotTable', 'Merangkum ribuan baris data menjadi tabel interaktif dalam hitungan detik.'],
            [6, 'Analisis Tren & Statistik', 'Melihat kecenderungan data penjualan atau perkembangan hasil belajar.'],
            [7, 'Studi Kasus Pengelolaan Barang SMK', 'Simulasi nyata mengelola stok, transaksi kasir, dan laporan keuangan toko.'],
            [7, 'Debugging dan Audit Spreadsheet', 'Mencari kesalahan rumus, circular reference, dan data invalid dalam file Excel.'],
            [7, 'Proyek Akhir Excel Master', 'Proyek integrasi seluruh kemampuan spreadsheet dari level 1 hingga level 6.'],
        ];

        foreach ($materialsList as [$lvlNum, $title, $content]) {
            Material::create([
                'level_id' => $levels[$lvlNum]->id,
                'category_id' => $catBasics->id,
                'title' => $title,
                'content' => $content . "\n\nPraktikkan langsung materi ini dalam Game Misi untuk mendapatkan XP dan Badge!",
                'summary' => substr($content, 0, 100) . '...',
                'reading_time_minutes' => 3,
            ]);
        }
    }
}
