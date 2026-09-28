<script setup lang="ts">
import { ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import { Sun, Moon, Volume2, VolumeX, Shield, User as UserIcon, LogOut } from 'lucide-vue-next'
import XpBadge from '@/Components/XpBadge.vue'

const page = usePage()
const user = page.props.auth?.user as any

const isDarkMode = ref(document.documentElement.classList.contains('dark'))
const soundEnabled = ref(true)

const toggleDarkMode = () => {
  isDarkMode.value = !isDarkMode.value
  if (isDarkMode.value) {
    document.documentElement.classList.add('dark')
    localStorage.setItem('theme', 'dark')
  } else {
    document.documentElement.classList.remove('dark')
    localStorage.setItem('theme', 'light')
  }
}

const toggleSound = () => {
  soundEnabled.value = !soundEnabled.value
}
</script>

<template>
  <header class="sticky top-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <!-- Logo & Brand -->
      <Link href="/dashboard" class="flex items-center gap-3 group">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center font-black text-slate-900 shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform">
          EX
        </div>
        <div>
          <span class="font-black text-lg tracking-wider text-slate-900 dark:text-white group-hover:text-emerald-500 transition-colors">EXCEL<span class="text-emerald-500">VERSE</span></span>
          <span class="block text-[10px] text-slate-400 dark:text-slate-500 font-semibold tracking-widest uppercase">Gamified Learning</span>
        </div>
      </Link>

      <!-- Right Action Controls -->
      <div class="flex items-center gap-3">
        <!-- XP Counter for Student -->
        <XpBadge v-if="user?.student" :amount="user.student.xp" size="md" />

        <!-- Sound Toggle -->
        <button
          @click="toggleSound"
          class="p-2 rounded-xl text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition"
          :title="soundEnabled ? 'Matikan Suara' : 'Aktifkan Suara'"
        >
          <Volume2 v-if="soundEnabled" class="w-5 h-5 text-emerald-500" />
          <VolumeX v-else class="w-5 h-5" />
        </button>

        <!-- Dark/Light Theme Switcher -->
        <button
          @click="toggleDarkMode"
          class="p-2 rounded-xl text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition"
          :title="isDarkMode ? 'Mode Terang' : 'Mode Gelap'"
        >
          <Sun v-if="isDarkMode" class="w-5 h-5 text-amber-400" />
          <Moon v-else class="w-5 h-5 text-slate-700" />
        </button>

        <!-- User Menu Link -->
        <div class="flex items-center gap-2 pl-2 border-l border-slate-200 dark:border-slate-800">
          <Link href="/profile" class="flex items-center gap-2 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:text-emerald-500 transition">
            <div class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-800 flex items-center justify-center font-bold text-slate-700 dark:text-slate-300">
              {{ user?.name?.charAt(0) || 'U' }}
            </div>
            <span class="hidden md:inline">{{ user?.name }}</span>
          </Link>
          <Link
            method="post"
            href="/logout"
            as="button"
            class="p-2 text-slate-400 hover:text-rose-500 transition"
            title="Keluar / Logout"
          >
            <LogOut class="w-4 h-4" />
          </Link>
        </div>
      </div>
    </div>
  </header>
</template>
