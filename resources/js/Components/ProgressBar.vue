<script setup lang="ts">
defineProps<{
  value: number
  max: number
  color?: string
  height?: string
}>()
</script>

<template>
  <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden shadow-inner" :class="height || 'h-3.5'">
    <div
      class="h-full transition-all duration-500 ease-out rounded-full bg-gradient-to-r"
      :class="color || 'from-emerald-500 to-teal-400'"
      :style="{ width: `${Math.min(100, Math.max(0, (value / max) * 100))}%` }"
    ></div>
  </div>
</template>
