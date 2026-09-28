<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { Gamepad2, Sparkles, BookOpen, Trophy, Cpu, ArrowRight, ShieldCheck, Zap, Table, Layers } from 'lucide-vue-next'

defineProps<{
  canLogin?: boolean
  canRegister?: boolean
}>()
</script>

<template>
  <Head title="SKILLVERSE — Belajar Multi-Skill Rasa Game." />

  <div class="min-h-screen bg-slate-950 text-white selection:bg-indigo-500 selection:text-white font-sans overflow-x-hidden">
    <!-- Navbar -->
    <nav class="max-w-7xl mx-auto px-6 h-24 flex items-center justify-between border-b border-slate-800/60">
      <div class="flex items-center gap-4">
        <div class="relative group cursor-pointer">
          <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-emerald-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
          <div class="relative w-12 h-12 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center shadow-2xl">
            <Layers class="w-6 h-6 text-indigo-400" />
          </div>
        </div>
        <span class="font-black text-2xl tracking-wider text-white">SKILL<span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">VERSE</span></span>
      </div>
      <div class="flex items-center gap-4">
        <Link
          href="/login"
          class="px-5 py-2.5 rounded-xl font-bold text-sm bg-slate-800/50 hover:bg-slate-800 text-slate-300 border border-slate-700/50 transition backdrop-blur-md"
        >
          Masuk
        </Link>
        <Link
          href="/register"
          class="px-6 py-2.5 rounded-xl font-bold text-sm bg-indigo-500 hover:bg-indigo-400 text-white shadow-[0_0_15px_rgba(99,102,241,0.3)] transition"
        >
          Daftar Gratis
        </Link>
      </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative max-w-7xl mx-auto px-6 pt-20 pb-28 text-center space-y-10">
      <!-- Background Ambient -->
      <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[30rem] bg-indigo-500/10 blur-[120px] rounded-full pointer-events-none"></div>

      <div class="relative z-10 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-bold uppercase tracking-widest">
        <Sparkles class="w-4 h-4 animate-pulse" />
        Gamified Learning Platform
      </div>
      
      <h1 class="relative z-10 text-5xl sm:text-6xl lg:text-7xl font-black tracking-tight max-w-5xl mx-auto leading-[1.1]">
        Kuasai Berbagai Keahlian Baru <br class="hidden sm:block" />
        Rasa <span class="bg-gradient-to-r from-indigo-400 via-cyan-400 to-emerald-400 bg-clip-text text-transparent drop-shadow-sm">Main Game Modern</span>
      </h1>
      
      <p class="relative z-10 text-lg sm:text-xl text-slate-400 max-w-3xl mx-auto leading-relaxed">
        Dari meracik rumus <strong>Microsoft Excel</strong> yang rumit hingga memahami instalasi <strong>Kelistrikan Rumah Tangga</strong>. Selesaikan misi nyata, dapatkan XP, klaim badge, dan naik level!
      </p>

      <div class="relative z-10 flex flex-col sm:flex-row gap-5 justify-center items-center pt-6">
        <Link
          href="/register"
          class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 hover:from-indigo-400 hover:to-cyan-400 text-white font-black text-lg shadow-[0_0_30px_rgba(99,102,241,0.3)] hover:shadow-[0_0_40px_rgba(99,102,241,0.5)] transition-all flex items-center justify-center gap-3 hover:-translate-y-1 transform"
        >
          <Gamepad2 class="w-6 h-6" />
          <span>MULAI BERMAIN SEKARANG</span>
        </Link>
        <Link
          href="/login"
          class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-slate-900 border border-slate-700/50 text-slate-300 font-bold hover:bg-slate-800 hover:text-white transition flex items-center justify-center gap-3"
        >
          <span>Akses Demo Akun (Siswa & Guru)</span>
          <ArrowRight class="w-4 h-4" />
        </Link>
      </div>

      <!-- Preview Game Cards Grid -->
      <div class="relative z-10 pt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-left max-w-6xl mx-auto">
        <!-- Feature 1 -->
        <div class="p-8 rounded-[2rem] bg-slate-900/60 border border-slate-800 backdrop-blur-xl shadow-2xl hover:border-emerald-500/50 hover:shadow-[0_0_30px_rgba(52,211,153,0.1)] hover:-translate-y-1 transition-all duration-300 group space-y-5">
          <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold border border-emerald-500/20 group-hover:scale-110 transition-transform">
            <Table class="w-7 h-7" />
          </div>
          <div class="space-y-2">
            <h3 class="text-xl font-black text-white group-hover:text-emerald-400 transition-colors">Master Excelverse</h3>
            <p class="text-sm text-slate-400 leading-relaxed">Belajar Microsoft Excel lewat studi kasus interaktif. Validasi rumus VLOOKUP, logika IF, dan Charting secara *real-time*.</p>
          </div>
        </div>
        
        <!-- Feature 2 -->
        <div class="p-8 rounded-[2rem] bg-slate-900/60 border border-slate-800 backdrop-blur-xl shadow-2xl hover:border-amber-500/50 hover:shadow-[0_0_30px_rgba(251,191,36,0.1)] hover:-translate-y-1 transition-all duration-300 group space-y-5">
          <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center font-bold border border-amber-500/20 group-hover:scale-110 transition-transform">
            <Zap class="w-7 h-7" />
          </div>
          <div class="space-y-2">
            <h3 class="text-xl font-black text-white group-hover:text-amber-400 transition-colors">Electroverse (Coming Soon)</h3>
            <p class="text-sm text-slate-400 leading-relaxed">Pahami instalasi listrik, hukum Ohm, hitung beban Watt, dan merangkai kabel virtual dengan aman layaknya profesional.</p>
          </div>
        </div>

        <!-- Feature 3 -->
        <div class="p-8 rounded-[2rem] bg-slate-900/60 border border-slate-800 backdrop-blur-xl shadow-2xl hover:border-indigo-500/50 hover:shadow-[0_0_30px_rgba(99,102,241,0.1)] hover:-translate-y-1 transition-all duration-300 group space-y-5">
          <div class="w-14 h-14 rounded-2xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center font-bold border border-indigo-500/20 group-hover:scale-110 transition-transform">
            <Trophy class="w-7 h-7" />
          </div>
          <div class="space-y-2">
            <h3 class="text-xl font-black text-white group-hover:text-indigo-400 transition-colors">RPG Progression</h3>
            <p class="text-sm text-slate-400 leading-relaxed">Tinggalkan cara belajar lama. Dapatkan XP setiap menyelesaikan misi, pertahankan *Streak*, koleksi lencana, dan bersaing di Leaderboard!</p>
          </div>
        </div>
      </div>
    </header>

    <!-- Teacher & Admin Section -->
    <section class="border-t border-slate-800 bg-slate-950 py-24 relative overflow-hidden">
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl h-64 bg-cyan-500/5 blur-[100px] rounded-full pointer-events-none"></div>
      
      <div class="max-w-7xl mx-auto px-6 text-center space-y-8 relative z-10">
        <div class="w-20 h-20 mx-auto rounded-3xl bg-cyan-500/10 flex items-center justify-center border border-cyan-500/20 shadow-[0_0_20px_rgba(34,211,238,0.2)]">
          <ShieldCheck class="w-10 h-10 text-cyan-400" />
        </div>
        <h2 class="text-4xl font-black text-white tracking-tight">Dirancang Khusus untuk Sekolah & Akademi</h2>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg leading-relaxed">
          Guru memiliki *dashboard* manajemen kelas (*Learning Management System*). Pantau performa setiap siswa secara langsung, ketahui topik mana yang paling sulit bagi kelas, dan berikan bimbingan tepat sasaran.
        </p>
        <div class="pt-6">
          <Link href="/login" class="inline-flex items-center gap-3 px-6 py-3 rounded-xl bg-slate-900 border border-slate-700 text-cyan-400 font-bold hover:bg-slate-800 hover:border-cyan-500/50 hover:text-cyan-300 transition-all shadow-lg">
            Masuk ke Portal Pengajar <ArrowRight class="w-4 h-4" />
          </Link>
        </div>
      </div>
    </section>

    <footer class="max-w-7xl mx-auto px-6 py-10 border-t border-slate-800/80 text-center flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-2">
        <Layers class="w-5 h-5 text-indigo-500" />
        <span class="font-black text-white text-lg tracking-wide">SKILL<span class="text-indigo-500">VERSE</span></span>
      </div>
      <p class="text-xs text-slate-500 font-medium">
        © 2026 Gamified Multi-Subject Learning Platform. All rights reserved.
      </p>
    </footer>
  </div>
</template>
