<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import XpBadge from '@/Components/XpBadge.vue'
import { Trophy, Award, Crown, Medal, TrendingUp } from 'lucide-vue-next'

defineProps<{
  top_students: any[]
  my_rank?: number
  current_student?: any
}>()
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Leaderboard Siswa — EXCELVERSE" />

    <div class="space-y-10 max-w-6xl mx-auto">
      <!-- Header Banner -->
      <div class="relative overflow-hidden p-8 sm:p-10 rounded-[2rem] bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 border border-slate-800 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8 backdrop-blur-xl">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-amber-500/20 blur-[100px] rounded-full pointer-events-none"></div>

        <div class="relative z-10 space-y-4">
          <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-500/10 text-amber-400 font-black text-xs uppercase tracking-widest border border-amber-500/20">
            <TrendingUp class="w-4 h-4" /> PERINGKAT GLOBAL
          </div>
          <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight">
            Hall of <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Fame</span>
          </h1>
          <p class="text-slate-400 font-medium text-base md:text-lg max-w-xl">
            Peringkat XP tertinggi siswa dalam menyelesaikan misi Excel. Bersainglah untuk memperebutkan posisi puncak!
          </p>
        </div>

        <div v-if="my_rank" class="relative z-10 flex flex-col items-center justify-center p-6 rounded-3xl bg-slate-900/80 border border-emerald-500/30 shadow-[0_0_30px_rgba(52,211,153,0.15)] min-w-[200px]">
          <span class="text-xs font-bold text-slate-400 mb-2 uppercase tracking-widest">Peringkat Saya</span>
          <div class="flex items-center gap-3">
            <Trophy class="w-8 h-8 fill-emerald-400 text-emerald-500" />
            <span class="text-4xl font-black text-white">#{{ my_rank }}</span>
          </div>
        </div>
      </div>

      <!-- Leaderboard Table Container -->
      <div class="relative overflow-hidden bg-slate-900/80 border border-slate-800 rounded-[2rem] shadow-2xl backdrop-blur-md">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-slate-950/50 text-slate-400 text-[10px] uppercase font-black tracking-widest border-b border-slate-800">
                <th class="p-5 pl-8">Rank</th>
                <th class="p-5">Pemain</th>
                <th class="p-5">Kelas</th>
                <th class="p-5">Title / Level</th>
                <th class="p-5 pr-8 text-right">Total XP</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/50 text-sm font-semibold">
              <tr
                v-for="(st, idx) in top_students"
                :key="st.id"
                class="hover:bg-slate-800/40 transition-colors duration-300"
                :class="current_student && current_student.id === st.id ? 'bg-emerald-500/10 hover:bg-emerald-500/20' : ''"
              >
                <!-- Rank Column -->
                <td class="p-5 pl-8 relative">
                  <!-- Current Player Indicator Line -->
                  <div v-if="current_student && current_student.id === st.id" class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-500 shadow-[0_0_10px_rgba(52,211,153,0.8)]"></div>
                  
                  <div class="flex items-center gap-2">
                    <div v-if="idx === 0" class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-300 to-orange-500 text-slate-950 font-black flex items-center justify-center text-lg shadow-[0_0_20px_rgba(251,191,36,0.4)] transform hover:scale-110 transition-transform">
                      1
                    </div>
                    <div v-else-if="idx === 1" class="w-9 h-9 rounded-xl bg-gradient-to-br from-slate-200 to-slate-400 text-slate-950 font-black flex items-center justify-center text-base shadow-[0_0_15px_rgba(203,213,225,0.3)]">
                      2
                    </div>
                    <div v-else-if="idx === 2" class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-700 to-orange-800 text-amber-100 font-black flex items-center justify-center text-base shadow-[0_0_15px_rgba(180,83,9,0.3)]">
                      3
                    </div>
                    <span v-else class="text-slate-500 font-black text-lg px-2 w-9 text-center">#{{ idx + 1 }}</span>
                  </div>
                </td>
                
                <!-- Player Column -->
                <td class="p-5">
                  <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-2xl bg-slate-800 border border-slate-700 text-emerald-400 font-black flex items-center justify-center text-sm shadow-inner"
                      :class="{'border-amber-400 text-amber-400 bg-amber-500/10': idx === 0}"
                    >
                      {{ st.user.name.charAt(0) }}
                    </div>
                    <span class="font-black text-base text-white" :class="{'text-amber-400 drop-shadow-md': idx === 0, 'text-emerald-400': current_student && current_student.id === st.id}">
                      {{ st.user.name }}
                      <span v-if="current_student && current_student.id === st.id" class="ml-2 text-[10px] bg-emerald-500 text-slate-950 px-2 py-0.5 rounded font-black uppercase tracking-wider">Anda</span>
                    </span>
                  </div>
                </td>
                
                <!-- Class Column -->
                <td class="p-5 text-xs text-slate-400 font-bold tracking-wider">
                  {{ st.school_class?.name || '-' }}
                </td>
                
                <!-- Level Column -->
                <td class="p-5">
                  <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-950/50 border border-slate-800 text-slate-300">
                    <span class="font-black text-emerald-500 text-xs">LVL {{ st.level?.level_number || 1 }}</span>
                    <span class="w-1 h-1 rounded-full bg-slate-700"></span>
                    <span class="text-xs font-bold">{{ st.level?.title || 'Rookie' }}</span>
                  </div>
                </td>
                
                <!-- XP Column -->
                <td class="p-5 pr-8 text-right">
                  <XpBadge :amount="st.xp" size="md" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
