<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Gamepad2, Sparkles } from 'lucide-vue-next';
</script>

<template>
  <div class="min-h-screen bg-slate-950 text-slate-100 flex flex-col justify-center items-center p-4 relative overflow-hidden font-sans selection:bg-emerald-500 selection:text-slate-950">
    <!-- Ambient Background Glows -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-emerald-600/20 via-teal-500/10 to-cyan-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Header Logo & Title -->
    <div class="mb-6 text-center z-10 space-y-2">
      <Link href="/" class="inline-flex items-center gap-3 group">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-500 via-teal-400 to-cyan-400 flex items-center justify-center font-black text-slate-950 text-xl shadow-lg shadow-emerald-500/25 group-hover:scale-105 transition-transform duration-300">
          EX
        </div>
        <div class="text-left">
          <span class="font-black text-2xl tracking-wider text-white">EXCEL<span class="text-emerald-500">VERSE</span></span>
          <span class="block text-[10px] text-emerald-400 font-bold uppercase tracking-widest flex items-center gap-1">
            <Sparkles class="w-3 h-3" /> Educational Game Platform
          </span>
        </div>
      </Link>
    </div>

    <!-- Card Wrapper -->
    <div class="w-full max-w-md z-10 bg-slate-900/90 border border-slate-800/80 backdrop-blur-xl rounded-3xl p-6 sm:p-8 shadow-2xl shadow-emerald-950/40">
      <slot />
    </div>

    <!-- Footer Copyright -->
    <div class="mt-8 text-center text-xs text-slate-500 z-10">
      © 2026 EXCELVERSE — Gamified Excel Learning Platform untuk Siswa SMK.
    </div>
  </div>
</template>
