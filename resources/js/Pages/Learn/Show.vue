<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ArrowLeft, BookOpen, Clock, Target, Play } from 'lucide-vue-next'

defineProps<{
  material: any
  related_materials: any[]
}>()
</script>

<template>
  <AuthenticatedLayout>
    <Head :title="`${material.title} — Materi EXCELVERSE`" />

    <div class="max-w-4xl mx-auto space-y-6">
      <Link href="/learn" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-black text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <ArrowLeft class="w-4 h-4" />
        <span>Kembali ke Daftar Modul</span>
      </Link>

      <article class="relative overflow-hidden bg-slate-900/90 border border-slate-800 rounded-[2rem] p-6 sm:p-10 shadow-2xl space-y-8 backdrop-blur-xl">
        <div class="absolute -top-32 -right-32 w-64 h-64 bg-cyan-500/10 blur-[80px] rounded-full pointer-events-none"></div>

        <div class="relative z-10 space-y-4 border-b border-slate-800/80 pb-8">
          <div class="flex items-center gap-3">
            <span class="px-3 py-1.5 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 font-black text-xs shadow-[0_0_15px_rgba(34,211,238,0.1)]">
              LEVEL {{ String(material.level.level_number).padStart(2, '0') }} — {{ material.level.title }}
            </span>
            <span class="text-xs text-slate-400 font-bold flex items-center gap-1.5 bg-slate-950/50 px-3 py-1.5 rounded-xl border border-slate-800">
              <Clock class="w-3.5 h-3.5 text-cyan-500" />
              {{ material.reading_time_minutes }} Menit Baca
            </span>
          </div>
          <h1 class="text-3xl sm:text-5xl font-black text-white leading-tight tracking-tight">
            {{ material.title }}
          </h1>
        </div>

        <div class="relative z-10 prose prose-invert prose-slate max-w-none prose-headings:font-black prose-headings:text-white prose-a:text-cyan-400 hover:prose-a:text-cyan-300 prose-strong:text-cyan-100 prose-code:text-cyan-300 prose-code:bg-slate-800/80 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-pre:bg-slate-950 prose-pre:border prose-pre:border-slate-800 text-slate-300 leading-relaxed font-medium text-base whitespace-pre-line">
          {{ material.content }}
        </div>

        <div class="relative z-10 pt-8 border-t border-slate-800/80 flex items-center justify-between">
          <Link
            href="/missions"
            class="px-8 py-4 rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-400 hover:to-blue-400 text-white font-black text-sm shadow-[0_0_20px_rgba(34,211,238,0.3)] hover:shadow-[0_0_30px_rgba(34,211,238,0.5)] transition-all flex items-center gap-3 hover:-translate-y-1 transform"
          >
            <Play class="w-5 h-5 fill-white" />
            <span>PRAKTIKKAN DI MISI GAME</span>
          </Link>
        </div>
      </article>
    </div>
  </AuthenticatedLayout>
</template>
