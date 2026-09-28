<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { BookOpen, Clock, ArrowRight, Lightbulb, Library } from 'lucide-vue-next'

defineProps<{
  levels: any[]
}>()
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Materi Pembelajaran — EXCELVERSE" />

    <div class="space-y-10 max-w-7xl mx-auto">
      <!-- Header Banner -->
      <div class="relative overflow-hidden p-8 sm:p-10 rounded-[2rem] bg-gradient-to-br from-slate-900 via-cyan-950/40 to-slate-900 border border-slate-800 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8 backdrop-blur-xl">
        <div class="absolute -top-32 -right-32 w-[30rem] h-[30rem] bg-cyan-500/10 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="relative z-10 space-y-4 max-w-2xl">
          <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-cyan-500/10 text-cyan-400 font-black text-xs uppercase tracking-widest border border-cyan-500/20">
            <Library class="w-4 h-4" /> AKADEMI EXCEL
          </div>
          <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight">
            Modul <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">Materi & Teori</span>
          </h1>
          <p class="text-slate-400 font-medium text-base md:text-lg">
            Pelajari teori, sintaks rumus, dan contoh terapan. Bekali dirimu dengan pengetahuan sebelum terjun ke dalam game misi.
          </p>
        </div>
        
        <div class="relative z-10 hidden md:block">
          <div class="w-32 h-32 relative flex items-center justify-center">
            <div class="absolute inset-0 bg-cyan-500/20 blur-2xl rounded-full animate-pulse"></div>
            <BookOpen class="w-20 h-20 text-cyan-400 drop-shadow-[0_0_15px_rgba(34,211,238,0.6)]" />
          </div>
        </div>
      </div>

      <!-- Modules Accordion / List -->
      <div class="space-y-12">
        <div v-for="level in levels" :key="level.id" class="space-y-6">
          <div class="flex items-center gap-4 border-b border-slate-800/80 pb-4">
            <div class="px-4 py-2 rounded-xl bg-gradient-to-r from-cyan-500/20 to-blue-500/20 border border-cyan-500/30 text-cyan-400 font-black text-sm shadow-[0_0_15px_rgba(34,211,238,0.1)]">
              LEVEL {{ String(level.level_number).padStart(2, '0') }}
            </div>
            <h2 class="text-2xl font-black text-white">{{ level.title }}</h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <Link
              v-for="mat in level.materials"
              :key="mat.id"
              :href="`/learn/${mat.id}`"
              class="group relative p-6 rounded-[2rem] bg-slate-900/80 border border-slate-800 shadow-xl hover:border-cyan-500/50 hover:shadow-[0_0_30px_rgba(34,211,238,0.15)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-6 backdrop-blur-md overflow-hidden"
            >
              <!-- Hover Gradient Effect -->
              <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/5 to-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
              
              <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2 text-xs font-bold text-slate-400 bg-slate-950/50 px-3 py-1.5 rounded-lg border border-slate-800">
                    <Clock class="w-3.5 h-3.5 text-cyan-500" />
                    <span>{{ mat.reading_time_minutes }} Menit Baca</span>
                  </div>
                  <div class="w-8 h-8 rounded-full bg-cyan-500/10 flex items-center justify-center text-cyan-500">
                    <Lightbulb class="w-4 h-4" />
                  </div>
                </div>
                
                <div class="space-y-2">
                  <h3 class="text-xl font-black text-white group-hover:text-cyan-400 transition-colors leading-tight">{{ mat.title }}</h3>
                  <p class="text-sm text-slate-400 line-clamp-2 leading-relaxed">{{ mat.summary }}</p>
                </div>
              </div>

              <div class="relative z-10 pt-4 border-t border-slate-800/80 flex items-center justify-between">
                <span class="text-xs font-black text-cyan-500 tracking-wider">BACA MATERI</span>
                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-slate-950 transition-colors">
                  <ArrowRight class="w-4 h-4" />
                </div>
              </div>
            </Link>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
