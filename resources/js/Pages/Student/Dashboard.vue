<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import ProgressBar from '@/Components/ProgressBar.vue'
import XpBadge from '@/Components/XpBadge.vue'
import { Trophy, Flame, Target, Zap, ArrowRight, ShieldCheck, Award, Star, Compass, Sparkles, BookOpen, Layers, Lock, Play } from 'lucide-vue-next'

const props = defineProps<{
  student: any
  next_level: any
  active_missions?: any[]
  daily_challenge: any
  subjects: any[]
  stats: {
    completed_missions: number
    total_badges: number
    streak: number
  }
}>()

const calculatePercent = (currentXp: number, nextXp: number) => {
  if (!nextXp) return 100
  return Math.min(100, Math.round((currentXp / nextXp) * 100))
}
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Lobby Belajar — ACADEMY" />

    <div class="space-y-8">
      <!-- Gamer Profile Banner with Glowing Glassmorphism -->
      <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-slate-900 via-slate-900 to-indigo-950/80 p-6 sm:p-10 border border-indigo-500/30 shadow-2xl shadow-indigo-500/10 backdrop-blur-xl">
        <!-- Ambient Radial Glow -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
          <div class="flex items-center gap-6">
            <!-- Player Avatar Circle with Neon Ring -->
            <div class="relative group">
              <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-3xl bg-gradient-to-tr from-emerald-500 via-indigo-500 to-cyan-400 p-[3px] shadow-[0_0_20px_rgba(99,102,241,0.4)] group-hover:shadow-[0_0_30px_rgba(99,102,241,0.6)] transition-shadow">
                <div class="w-full h-full rounded-[21px] bg-slate-950 flex items-center justify-center font-black text-4xl text-white">
                  {{ student.user.name.charAt(0) }}
                </div>
              </div>
              <span class="absolute -bottom-2 -right-2 px-3 py-1 rounded-xl bg-amber-400 text-slate-950 font-black text-xs shadow-lg border-2 border-slate-900">
                PRO PLAYER
              </span>
            </div>

            <!-- Player Info -->
            <div class="space-y-1.5">
              <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-800/80 text-slate-300 font-bold text-[10px] border border-slate-700">
                <ShieldCheck class="w-3.5 h-3.5 text-emerald-400" /> {{ student.school_class?.name || 'Siswa Akademi' }}
              </div>
              <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">{{ student.user.name }}</h1>
              <p class="text-sm text-slate-400 font-medium">Selamat datang di Lobby Pembelajaran. Pilih misi untuk hari ini!</p>
            </div>
          </div>

          <!-- Streak & Total XP Floating Pill -->
          <div class="flex flex-col items-end gap-3 bg-slate-900/80 p-4 rounded-3xl border border-slate-800 shadow-xl backdrop-blur-md">
            <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-orange-500/10 to-amber-500/10 text-orange-400 border border-orange-500/20 font-black text-sm w-full justify-between shadow-inner">
              <div class="flex items-center gap-2">
                <Flame class="w-5 h-5 fill-amber-400 text-orange-400 animate-pulse" />
                <span>Global Streak</span>
              </div>
              <span class="text-lg">{{ stats.streak }} Hari</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Total XP</span>
              <XpBadge :amount="student.xp" size="lg" />
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Stats Grid Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-5 rounded-3xl bg-slate-900/90 border border-slate-800 shadow-xl flex items-center gap-4 hover:border-indigo-500/40 transition duration-300">
          <div class="p-3.5 rounded-2xl bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
            <Layers class="w-6 h-6" />
          </div>
          <div>
            <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">MATERI DIIKUTI</div>
            <div class="text-2xl font-black text-white">1 <span class="text-xs text-slate-500 font-normal">Pelajaran</span></div>
          </div>
        </div>

        <div class="p-5 rounded-3xl bg-slate-900/90 border border-slate-800 shadow-xl flex items-center gap-4 hover:border-emerald-500/40 transition duration-300">
          <div class="p-3.5 rounded-2xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
            <Target class="w-6 h-6" />
          </div>
          <div>
            <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">MISI SELESAI</div>
            <div class="text-2xl font-black text-white">{{ stats.completed_missions }} <span class="text-xs text-slate-500 font-normal">Misi</span></div>
          </div>
        </div>

        <div class="p-5 rounded-3xl bg-slate-900/90 border border-slate-800 shadow-xl flex items-center gap-4 hover:border-amber-500/40 transition duration-300">
          <div class="p-3.5 rounded-2xl bg-amber-500/10 text-amber-400 border border-amber-500/20">
            <Award class="w-6 h-6" />
          </div>
          <div>
            <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">KOLEKSI BADGE</div>
            <div class="text-2xl font-black text-white">{{ stats.total_badges }} <span class="text-xs text-slate-500 font-normal">Lencana</span></div>
          </div>
        </div>
      </div>

      <!-- Daily Challenge Widget Banner -->
      <div v-if="daily_challenge" class="relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-amber-500/20 via-orange-500/15 to-amber-500/10 border border-amber-500/40 shadow-xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
        <div class="flex items-center gap-4 z-10">
          <div class="p-4 rounded-2xl bg-gradient-to-tr from-amber-400 to-yellow-300 text-slate-950 font-black shadow-lg shadow-amber-500/20">
            <Zap class="w-8 h-8 fill-slate-950" />
          </div>
          <div class="space-y-1">
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 font-black text-[10px] uppercase tracking-widest border border-amber-500/30">
              <Sparkles class="w-3 h-3" /> TANTANGAN HARIAN GLOBAL
            </div>
            <h3 class="text-xl font-black text-white">Selesaikan Challenge Hari Ini!</h3>
            <p class="text-xs text-slate-300">Dapatkan ekstra bonus <span class="text-amber-400 font-bold">+{{ daily_challenge.xp_bonus }} XP</span> untuk mendongkrak peringkatmu.</p>
          </div>
        </div>

        <Link
          href="/challenge"
          class="z-10 px-6 py-3.5 rounded-2xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-black text-sm shadow-xl shadow-amber-500/20 hover:scale-105 active:scale-95 transition flex items-center gap-2 shrink-0"
        >
          <span>MAIN CHALLENGE</span>
          <ArrowRight class="w-4 h-4" />
        </Link>
      </div>

      <!-- MATA PELAJARAN / SUBJECTS LOBBY GRID -->
      <div class="space-y-6 pt-4">
        <div class="flex items-end justify-between">
          <div class="space-y-1">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-indigo-500/10 text-indigo-400 font-black text-[10px] uppercase tracking-widest border border-indigo-500/20 mb-2">
              <BookOpen class="w-3.5 h-3.5" /> KATALOG KELAS
            </div>
            <h2 class="text-3xl font-black text-white tracking-tight">Pilih Mata Pelajaran</h2>
            <p class="text-sm text-slate-400 font-medium">Lanjutkan progres belajarmu di berbagai materi keahlian.</p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div
            v-for="subject in subjects"
            :key="subject.id"
            class="relative group rounded-[2rem] border overflow-hidden transition-all duration-500 flex flex-col justify-between"
            :class="subject.is_active 
              ? `bg-slate-900/90 border-${subject.theme}-500/40 shadow-[0_0_30px_rgba(0,0,0,0.2)] hover:border-${subject.theme}-400 hover:shadow-[0_0_40px_var(--tw-shadow-color)] hover:-translate-y-1`
              : 'bg-slate-950/60 border-slate-800/80 grayscale-[30%]'"
            :style="subject.is_active ? (subject.theme === 'emerald' ? '--tw-shadow-color: rgba(52,211,153,0.15)' : '--tw-shadow-color: rgba(251,191,36,0.15)') : ''"
          >
            <!-- Background Glow -->
            <div v-if="subject.is_active" class="absolute top-0 right-0 w-48 h-48 rounded-full blur-[80px] pointer-events-none transition-opacity duration-500 opacity-50 group-hover:opacity-100"
              :class="`bg-${subject.theme}-500/20`"></div>

            <div class="p-8 space-y-6 relative z-10">
              <div class="flex items-start justify-between">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl shadow-lg"
                  :class="subject.is_active 
                    ? `bg-gradient-to-br from-${subject.theme}-400 to-${subject.theme}-600 text-slate-950 shadow-${subject.theme}-500/30`
                    : 'bg-slate-800 text-slate-500 border border-slate-700'">
                  <!-- Using an emoji/text fallback since dynamic lucide icons are complex in Vue without a wrapper, though we have Zap/Table in context -->
                  <span v-if="subject.icon === 'Table'">📊</span>
                  <span v-if="subject.icon === 'Zap'">⚡</span>
                </div>
                
                <div v-if="subject.is_active" class="px-4 py-1.5 rounded-xl bg-slate-950/50 border shadow-inner flex flex-col items-end"
                  :class="`border-${subject.theme}-500/30`">
                  <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">PROGRES</div>
                  <div class="font-black text-lg" :class="`text-${subject.theme}-400`">{{ subject.progress_percent }}%</div>
                </div>
                <div v-else class="px-3 py-1.5 rounded-lg bg-slate-800/80 border border-slate-700 text-slate-400 text-xs font-bold flex items-center gap-1.5">
                  <Lock class="w-3.5 h-3.5" /> BELUM MULAI
                </div>
              </div>

              <div class="space-y-2">
                <h3 class="text-2xl font-black text-white" :class="subject.is_active ? `group-hover:text-${subject.theme}-400 transition-colors` : ''">{{ subject.name }}</h3>
                <p class="text-sm text-slate-400 font-medium leading-relaxed">{{ subject.description }}</p>
              </div>

              <!-- Level Info Box -->
              <div v-if="subject.is_active" class="p-4 rounded-2xl bg-slate-950/50 border border-slate-800 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center font-black text-xl border"
                  :class="`bg-${subject.theme}-500/10 border-${subject.theme}-500/20 text-${subject.theme}-400`">
                  {{ String(subject.current_level).padStart(2, '0') }}
                </div>
                <div>
                  <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-0.5">LEVEL SAAT INI</div>
                  <div class="text-sm font-bold text-white">{{ subject.level_title }}</div>
                </div>
              </div>
            </div>

            <!-- Action Area -->
            <div class="px-8 py-5 border-t relative z-10 flex items-center justify-between"
              :class="subject.is_active ? `border-${subject.theme}-500/20 bg-slate-900/50` : 'border-slate-800 bg-slate-950/50'">
              <div v-if="subject.is_active" class="flex items-center gap-2">
                <span class="text-xs font-bold text-slate-400">Total XP:</span>
                <XpBadge :amount="subject.xp" size="sm" />
              </div>
              <div v-else class="text-xs font-bold text-slate-500">
                0 XP
              </div>

              <Link
                v-if="subject.is_active"
                href="/missions"
                class="px-6 py-3 rounded-xl font-black text-xs shadow-lg transition-transform hover:scale-105 flex items-center gap-2"
                :class="`bg-${subject.theme}-500 hover:bg-${subject.theme}-400 text-slate-950 shadow-${subject.theme}-500/20`"
              >
                <span>LANJUT BELAJAR</span>
                <Play class="w-4 h-4 fill-slate-950" />
              </Link>
              <button
                v-else
                class="px-6 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-black text-xs transition-colors flex items-center gap-2 border border-slate-700 hover:border-slate-600"
              >
                <Zap class="w-4 h-4" />
                <span>MULAI MATERI</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
