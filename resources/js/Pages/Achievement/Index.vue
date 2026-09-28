<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Award, Lock, CheckCircle2, Sparkles, ShieldAlert } from 'lucide-vue-next'

defineProps<{
  badges: any[]
  unlocked_badge_ids: number[]
  student?: any
}>()
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Pencapaian & Badge — EXCELVERSE" />

    <div class="space-y-10 max-w-7xl mx-auto">
      <!-- Header Banner -->
      <div class="relative overflow-hidden p-8 sm:p-10 rounded-[2rem] bg-gradient-to-br from-slate-900 via-slate-900 to-amber-950/40 border border-slate-800 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8 backdrop-blur-xl">
        <div class="absolute -top-32 -left-32 w-[30rem] h-[30rem] bg-amber-500/10 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="relative z-10 space-y-4 max-w-2xl">
          <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-500/10 text-amber-400 font-black text-xs uppercase tracking-widest border border-amber-500/20">
            <Sparkles class="w-4 h-4" /> KOLEKSI LENCANA
          </div>
          <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight">
            Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-yellow-500">Pencapaian</span>
          </h1>
          <p class="text-slate-400 font-medium text-base md:text-lg">
            Tunjukkan keahlian Excel-mu dengan mengumpulkan lencana prestasi eksklusif. Setiap badge adalah bukti kemampuanmu!
          </p>
        </div>
        
        <div class="relative z-10 hidden md:block">
          <div class="w-32 h-32 relative">
            <div class="absolute inset-0 bg-amber-500/20 blur-2xl rounded-full animate-pulse"></div>
            <Award class="w-full h-full text-amber-400 drop-shadow-[0_0_15px_rgba(251,191,36,0.6)]" />
          </div>
        </div>
      </div>

      <!-- Stats Bar -->
      <div class="flex items-center gap-6 p-5 rounded-3xl bg-slate-900/80 border border-slate-800 shadow-xl backdrop-blur-md">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-amber-500 flex items-center justify-center">
            <Award class="w-6 h-6" />
          </div>
          <div>
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">TERKUMPUL</div>
            <div class="text-2xl font-black text-white">{{ unlocked_badge_ids.length }} <span class="text-sm font-bold text-slate-500">/ {{ badges.length }}</span></div>
          </div>
        </div>
        
        <div class="h-10 w-px bg-slate-800 hidden sm:block"></div>
        
        <div class="flex-1 hidden sm:block">
          <div class="flex justify-between text-xs font-bold text-slate-400 mb-2">
            <span>PROGRES KOLEKSI</span>
            <span class="text-amber-400">{{ Math.round((unlocked_badge_ids.length / badges.length) * 100) || 0 }}%</span>
          </div>
          <div class="h-2 w-full bg-slate-950 rounded-full overflow-hidden border border-slate-800/50">
            <div class="h-full bg-gradient-to-r from-amber-500 to-yellow-400 rounded-full transition-all duration-1000" :style="`width: ${(unlocked_badge_ids.length / badges.length) * 100}%`"></div>
          </div>
        </div>
      </div>

      <!-- Badges Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div
          v-for="badge in badges"
          :key="badge.id"
          class="group relative p-6 rounded-[2rem] border transition-all duration-500 flex flex-col justify-between space-y-6 backdrop-blur-sm overflow-hidden"
          :class="unlocked_badge_ids.includes(badge.id)
            ? 'bg-slate-900/90 border-amber-500/40 shadow-[0_0_30px_rgba(251,191,36,0.1)] hover:-translate-y-2 hover:shadow-[0_0_40px_rgba(251,191,36,0.2)]'
            : 'bg-slate-950/50 border-slate-800/80 grayscale-[50%] hover:grayscale-0 hover:border-slate-700'"
        >
          <!-- Shine Effect for unlocked badges -->
          <div v-if="unlocked_badge_ids.includes(badge.id)" class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 -skew-x-12 translate-x-[-100%] group-hover:translate-x-[100%]"></div>

          <div class="space-y-4 text-center z-10">
            <div class="relative inline-block">
              <!-- Glow behind badge -->
              <div v-if="unlocked_badge_ids.includes(badge.id)" class="absolute inset-0 bg-amber-500/30 blur-xl rounded-full"></div>
              
              <div
                class="relative w-20 h-20 mx-auto rounded-[1.5rem] flex items-center justify-center text-3xl font-black shadow-inner transition-transform duration-500 group-hover:scale-110"
                :class="unlocked_badge_ids.includes(badge.id)
                  ? 'bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 border-2 border-amber-200/50 shadow-[inset_0_4px_10px_rgba(255,255,255,0.4)]'
                  : 'bg-slate-800 border-2 border-slate-700 text-slate-500'"
              >
                <img v-if="badge.image_url" :src="badge.image_url" class="w-12 h-12 object-contain" />
                <Award v-else class="w-10 h-10" />
              </div>
            </div>
            
            <div class="space-y-1">
              <h3 class="font-black text-lg text-white" :class="{'text-amber-400': unlocked_badge_ids.includes(badge.id)}">{{ badge.name }}</h3>
              <p class="text-xs text-slate-400 leading-relaxed font-medium">{{ badge.description }}</p>
            </div>
          </div>

          <div class="pt-4 border-t border-slate-800/80 text-center z-10">
            <span
              v-if="unlocked_badge_ids.includes(badge.id)"
              class="inline-flex items-center gap-1.5 text-xs font-black text-amber-400 px-4 py-2 rounded-xl bg-amber-500/10 border border-amber-500/20 shadow-[0_0_10px_rgba(251,191,36,0.1)]"
            >
              <CheckCircle2 class="w-4 h-4" /> TERBUKA
            </span>
            <span v-else class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 px-4 py-2 rounded-xl bg-slate-900 border border-slate-800">
              <Lock class="w-4 h-4" /> TERKUNCI
            </span>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
