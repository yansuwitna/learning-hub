<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ShieldCheck, Users, BookOpen, Target, Award, Layers } from 'lucide-vue-next'

defineProps<{
  stats: {
    total_users: number
    total_students: number
    total_teachers: number
    total_classes: number
    total_levels: number
    total_missions: number
    total_questions: number
    total_badges: number
  }
  recent_users: any[]
}>()
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Panel Administrator — EXCELVERSE" />

    <div class="space-y-8">
      <div>
        <h1 class="text-3xl font-black text-slate-900 dark:text-white">PANEL ADMINISTRATOR EXCELVERSE</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Pengelolaan pengguna, kelas, level, misi, soal, dan sistem aplikasi.</p>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm space-y-1">
          <div class="text-xs font-bold text-slate-400 uppercase">PENGGUNA</div>
          <div class="text-2xl font-black text-slate-900 dark:text-white">{{ stats.total_users }}</div>
        </div>
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm space-y-1">
          <div class="text-xs font-bold text-slate-400 uppercase">SISWA</div>
          <div class="text-2xl font-black text-emerald-500">{{ stats.total_students }}</div>
        </div>
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm space-y-1">
          <div class="text-xs font-bold text-slate-400 uppercase">TOTAL MISI</div>
          <div class="text-2xl font-black text-cyan-500">{{ stats.total_missions }}</div>
        </div>
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm space-y-1">
          <div class="text-xs font-bold text-slate-400 uppercase">TOTAL SOAL</div>
          <div class="text-2xl font-black text-amber-500">{{ stats.total_questions }}</div>
        </div>
      </div>

      <!-- Recent Users -->
      <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-xl space-y-4">
        <h2 class="text-xl font-black text-slate-900 dark:text-white">PENGGUNA TERBARU</h2>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse text-sm">
            <thead>
              <tr class="bg-slate-50 dark:bg-slate-800/60 text-slate-400 text-xs font-bold border-b border-slate-200 dark:border-slate-800">
                <th class="p-3">NAMA</th>
                <th class="p-3">EMAIL</th>
                <th class="p-3">PERAN (ROLE)</th>
                <th class="p-3">TERDAFTAR</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 font-medium">
              <tr v-for="u in recent_users" :key="u.id" class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                <td class="p-3 font-bold text-slate-900 dark:text-white">{{ u.name }}</td>
                <td class="p-3 text-slate-500">{{ u.email }}</td>
                <td class="p-3">
                  <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 text-emerald-500 font-bold text-xs uppercase">
                    {{ u.role?.name || 'User' }}
                  </span>
                </td>
                <td class="p-3 text-xs text-slate-400">{{ new Date(u.created_at).toLocaleDateString('id-ID') }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
