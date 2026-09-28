<script setup lang="ts">
import AppHeader from '@/Components/AppHeader.vue'
import AppSidebar from '@/Components/AppSidebar.vue'
import MobileBottomNav from '@/Components/MobileBottomNav.vue'
</script>

<template>
  <div class="min-h-screen bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 flex flex-col font-sans transition-colors duration-300">
    <AppHeader />
    <div class="flex-1 flex max-w-7xl w-full mx-auto">
      <AppSidebar />
      <main class="flex-1 p-4 sm:p-6 lg:p-8 pb-24 lg:pb-8 overflow-y-auto">
        <slot />
      </main>
    </div>
    <MobileBottomNav />
  </div>
</template>
