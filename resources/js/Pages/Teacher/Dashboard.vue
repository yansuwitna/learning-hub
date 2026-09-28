<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import XpBadge from '@/Components/XpBadge.vue'
import { Users, BookOpen, AlertTriangle, TrendingUp, CheckCircle2 } from 'lucide-vue-next'

defineProps<{
  classes: any[]
  students: any[]
  stats: {
    total_students: number
    active_students: number
    avg_xp: number
    total_completed_missions: number
  }
  most_failed_questions: any[]
}>()
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Dashboard Guru — EXCELVERSE" />

    <div class="space-y-8">
      <div>
        <h1 class="text-3xl font-black text-slate-900 dark:text-white">DASHBOARD GURU & ANALISIS KELAS</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Memantau perkembangan belajar siswa, tingkat kesalahan soal, dan statistik penguasaan materi Excel.</p>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm space-y-1">
          <div class="text-xs font-bold text-slate-400 uppercase">TOTAL SISWA</div>
          <div class="text-3xl font-black text-slate-900 dark:text-white">{{ stats.total_students }}</div>
        </div>
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm space-y-1">
          <div class="text-xs font-bold text-slate-400 uppercase">SISWA AKTIF</div>
          <div class="text-3xl font-black text-emerald-500">{{ stats.active_students }}</div>
        </div>
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm space-y-1">
          <div class="text-xs font-bold text-slate-400 uppercase">RATA-RATA XP</div>
          <div class="text-3xl font-black text-amber-500">{{ stats.avg_xp.toLocaleString('id-ID') }}</div>
        </div>
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm space-y-1">
          <div class="text-xs font-bold text-slate-400 uppercase">MISI TERSELESAIKAN</div>
          <div class="text-3xl font-black text-cyan-500">{{ stats.total_completed_missions }}</div>
        </div>
      </div>

      <!-- Learning Analytics Section: Most Failed Questions -->
      <div class="p-6 rounded-3xl bg-rose-500/5 border border-rose-500/20 space-y-4">
        <div class="flex items-center gap-2 text-rose-500 font-black text-lg">
          <AlertTriangle class="w-6 h-6" />
          <h2>SOAL DENGAN TINGKAT KESALAHAN TERTINGGI (PERLU EVALUASI)</h2>
        </div>
        <p class="text-xs text-slate-500 dark:text-slate-400">Guru dapat menggunakan data ini untuk menjelaskan ulang materi terkait di depan kelas.</p>

        <div class="space-y-3">
          <div
            v-for="item in most_failed_questions"
            :key="item.question_id"
            class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-between gap-4"
          >
            <div class="space-y-1">
              <span class="px-2 py-0.5 rounded bg-rose-500/10 text-rose-500 font-bold text-[10px] uppercase">
                {{ item.question?.question_type }}
              </span>
              <p class="text-sm font-bold text-slate-900 dark:text-white">{{ item.question?.question }}</p>
            </div>
            <div class="text-right shrink-0">
              <span class="text-sm font-black text-rose-500">{{ item.fail_count }}x Salah</span>
            </div>
          </div>
          <div v-if="most_failed_questions.length === 0" class="text-xs text-slate-400 italic">
            Belum ada catatan kesalahan soal yang signifikan.
          </div>
        </div>
      </div>

      <!-- Student Progress Table -->
      <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-xl space-y-4 p-6">
        <h2 class="text-xl font-black text-slate-900 dark:text-white">DAFTAR SISWA & PERKEMBANGAN</h2>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-slate-50 dark:bg-slate-800/60 text-slate-500 dark:text-slate-400 text-xs uppercase font-bold tracking-wider border-b border-slate-200 dark:border-slate-800">
                <th class="p-3">NAMA SISWA</th>
                <th class="p-3">KELAS</th>
                <th class="p-3">LEVEL</th>
                <th class="p-3">MISI SELESAI</th>
                <th class="p-3 text-right">TOTAL XP</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm font-semibold">
              <tr v-for="st in students" :key="st.id" class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                <td class="p-3 font-bold text-slate-900 dark:text-white">{{ st.user.name }}</td>
                <td class="p-3 text-xs text-slate-500">{{ st.school_class?.name || '-' }}</td>
                <td class="p-3 text-xs">Level {{ st.level?.level_number }} — {{ st.level?.title }}</td>
                <td class="p-3 font-bold text-emerald-500">{{ st.completed_missions }} Misi</td>
                <td class="p-3 text-right">
                  <XpBadge :amount="st.xp" size="sm" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
