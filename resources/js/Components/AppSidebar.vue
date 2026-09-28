<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import {
  Home,
  Target,
  BookOpen,
  Zap,
  Award,
  Trophy,
  User,
  Users,
  ShieldCheck,
} from 'lucide-vue-next'

const page = usePage()
const user = page.props.auth?.user as any
const url = page.url

const studentNav = [
  { name: 'Dashboard', href: '/student/dashboard', icon: Home },
  { name: 'Misi Game', href: '/missions', icon: Target },
  { name: 'Materi Belajar', href: '/learn', icon: BookOpen },
  { name: 'Daily Challenge', href: '/challenge', icon: Zap },
  { name: 'Pencapaian', href: '/achievements', icon: Award },
  { name: 'Leaderboard', href: '/leaderboard', icon: Trophy },
  { name: 'Profil Saya', href: '/profile', icon: User },
]

const teacherNav = [
  { name: 'Dashboard Guru', href: '/teacher/dashboard', icon: Home },
  { name: 'Misi Game', href: '/missions', icon: Target },
  { name: 'Materi Belajar', href: '/learn', icon: BookOpen },
  { name: 'Leaderboard Kelas', href: '/leaderboard', icon: Trophy },
  { name: 'Profil', href: '/profile', icon: User },
]

const adminNav = [
  { name: 'Dashboard Admin', href: '/admin/dashboard', icon: ShieldCheck },
  { name: 'Kelola Pengguna', href: '/admin/dashboard', icon: Users },
  { name: 'Misi Game', href: '/missions', icon: Target },
  { name: 'Materi', href: '/learn', icon: BookOpen },
  { name: 'Profil', href: '/profile', icon: User },
]

const navItems = user?.role?.slug === 'admin'
  ? adminNav
  : (user?.role?.slug === 'teacher' ? teacherNav : studentNav)
</script>

<template>
  <aside class="hidden lg:block w-64 shrink-0 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 p-4 space-y-6">
    <div class="px-3 py-2 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
      MENU UTAMA
    </div>
    <nav class="space-y-1.5">
      <Link
        v-for="item in navItems"
        :key="item.name"
        :href="item.href"
        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200"
        :class="url.startsWith(item.href)
          ? 'bg-emerald-500/10 text-emerald-500 font-bold border border-emerald-500/20 shadow-sm'
          : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/60 hover:text-slate-900 dark:hover:text-white'"
      >
        <component :is="item.icon" class="w-5 h-5" />
        <span>{{ item.name }}</span>
      </Link>
    </nav>
  </aside>
</template>
