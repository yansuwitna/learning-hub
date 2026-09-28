<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import XpBadge from '@/Components/XpBadge.vue'
import { Lock, CheckCircle2, Play, Star, Sparkles, Map } from 'lucide-vue-next'

const props = defineProps<{
  levels: any[]
  student: any
}>()
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Peta Misi — EXCELVERSE" />

    <div class="space-y-10 max-w-7xl mx-auto">
      <!-- Header Banner -->
      <div class="relative overflow-hidden p-8 sm:p-10 rounded-[2rem] bg-gradient-to-br from-indigo-900 via-slate-900 to-emerald-950 border border-slate-800 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/20 blur-[100px] rounded-full pointer-events-none"></div>
        
        <div class="relative z-10 space-y-4 max-w-2xl">
          <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 font-black text-xs uppercase tracking-widest border border-emerald-500/20">
            <Map class="w-4 h-4" /> EKSPLORASI DUNIA
          </div>
          <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight">
            Peta Petualangan <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400">Excelverse</span>
          </h1>
          <p class="text-slate-400 font-medium text-base md:text-lg">
            Selesaikan misi di setiap level untuk membuka dunia baru. Taklukkan tantangan, kumpulkan XP, dan jadilah Master Excel!
          </p>
        </div>
      </div>

      <!-- Levels Sections -->
      <div class="space-y-12">
        <div v-for="level in levels" :key="level.id" class="space-y-6 relative">
          <!-- Connector Line (visual map element) -->
          <div class="absolute left-10 top-24 bottom-0 w-0.5 bg-slate-800/80 -z-10 hidden md:block"></div>

          <!-- Level Header -->
          <div
            class="relative z-10 p-5 rounded-3xl flex items-center justify-between border shadow-xl backdrop-blur-md transition-all duration-500"
            :class="student && student.level.level_number >= level.level_number
              ? 'bg-slate-900/90 border-emerald-500/30 text-white'
              : 'bg-slate-950/80 border-slate-800/80 text-slate-500'"
          >
            <div class="flex items-center gap-5">
              <div
                class="w-16 h-16 rounded-2xl flex items-center justify-center font-black text-2xl border transition-all duration-500"
                :class="student && student.level.level_number >= level.level_number
                  ? 'bg-gradient-to-br from-emerald-400 to-teal-500 text-slate-950 border-emerald-400 shadow-[0_0_20px_rgba(52,211,153,0.3)]'
                  : 'bg-slate-900 text-slate-600 border-slate-800'"
              >
                {{ String(level.level_number).padStart(2, '0') }}
              </div>
              <div class="space-y-1">
                <h2 class="text-xl md:text-2xl font-black tracking-tight" :class="{'text-emerald-50': student && student.level.level_number >= level.level_number}">
                  {{ level.title }}
                </h2>
                <p class="text-xs md:text-sm font-medium" :class="{'text-emerald-200/70': student && student.level.level_number >= level.level_number, 'text-slate-500': !(student && student.level.level_number >= level.level_number)}">
                  {{ level.subtitle }}
                </p>
              </div>
            </div>
            
            <!-- Unlock Status / Reqs -->
            <div class="hidden sm:flex flex-col items-end gap-1">
              <div v-if="student && student.level.level_number >= level.level_number" class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-bold text-xs">
                <CheckCircle2 class="w-4 h-4" /> TERBUKA
              </div>
              <div v-else class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-800/50 border border-slate-700/50 text-slate-400 font-bold text-xs">
                <Lock class="w-4 h-4" /> TERKUNCI
              </div>
              <div class="text-[10px] font-black tracking-widest uppercase opacity-70">
                Min. {{ level.min_xp }} XP
              </div>
            </div>
          </div>

          <!-- Mission Cards Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:pl-28">
            <div
              v-for="(mission, index) in level.missions"
              :key="mission.id"
              class="relative group p-6 rounded-3xl bg-slate-900/80 border border-slate-800 shadow-xl flex flex-col justify-between space-y-5 transition-all duration-300 backdrop-blur-md"
              :class="{'hover:border-emerald-500/50 hover:shadow-[0_0_20px_rgba(52,211,153,0.1)] hover:-translate-y-1': student && student.level.level_number >= level.level_number}"
            >
              <!-- Mission Number Badge -->
              <div class="absolute -top-3 -left-3 w-8 h-8 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center font-black text-xs text-slate-400 shadow-lg z-10 group-hover:bg-emerald-500 group-hover:text-slate-950 group-hover:border-emerald-400 transition-colors">
                {{ index + 1 }}
              </div>

              <div class="space-y-3 z-10 pt-2">
                <div class="flex items-center justify-between">
                  <span class="text-[10px] font-black px-2.5 py-1 rounded-xl bg-emerald-500/10 text-emerald-400 uppercase tracking-widest border border-emerald-500/20">
                    {{ mission.world_name }}
                  </span>
                  <XpBadge :amount="mission.xp_reward" size="sm" />
                </div>
                <h3 class="font-black text-lg text-white group-hover:text-emerald-400 transition-colors">{{ mission.title }}</h3>
                <p class="text-xs text-slate-400 leading-relaxed line-clamp-2 font-medium">{{ mission.description }}</p>
              </div>

              <div class="pt-4 border-t border-slate-800/80 flex items-center justify-between z-10">
                <div class="flex items-center gap-1">
                  <Star v-for="s in mission.difficulty" :key="s" class="w-3.5 h-3.5 fill-amber-400 text-amber-400" />
                </div>

                <Link
                  v-if="student && student.level.level_number >= level.level_number"
                  :href="`/missions/${mission.id}`"
                  class="px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-xs shadow-lg shadow-emerald-500/20 hover:scale-105 transition-all flex items-center gap-2"
                >
                  <Play class="w-3.5 h-3.5 fill-slate-950" />
                  <span>MAINKAN</span>
                </Link>
                <div v-else class="inline-flex items-center gap-1.5 text-xs font-black text-slate-500 px-4 py-2.5 rounded-xl bg-slate-800/50 border border-slate-800">
                  <Lock class="w-3.5 h-3.5" />
                  <span>TERKUNCI</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
