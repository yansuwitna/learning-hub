<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import { Home, Target, BookOpen, Zap, Trophy, User } from 'lucide-vue-next'

const page = usePage()
const url = page.url

const navItems = [
  { name: 'Home', href: '/student/dashboard', icon: Home },
  { name: 'Misi', href: '/missions', icon: Target },
  { name: 'Materi', href: '/learn', icon: BookOpen },
  { name: 'Challenge', href: '/challenge', icon: Zap },
  { name: 'Rank', href: '/leaderboard', icon: Trophy },
  { name: 'Profil', href: '/profile', icon: User },
]
</script>

<template>
  <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-t border-slate-200 dark:border-slate-800 px-2 py-1.5 flex justify-around items-center">
    <Link
      v-for="item in navItems"
      :key="item.name"
      :href="item.href"
      class="flex flex-col items-center gap-1 px-3 py-1 rounded-xl text-[10px] font-bold transition-all"
      :class="url.startsWith(item.href)
        ? 'text-emerald-500 scale-105'
        : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'"
    >
      <component :is="item.icon" class="w-5 h-5" />
      <span>{{ item.name }}</span>
    </Link>
  </nav>
</template>
