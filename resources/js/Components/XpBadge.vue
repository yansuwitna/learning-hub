<script setup lang="ts">
import { Zap } from 'lucide-vue-next'

defineProps<{
  amount: number
  size?: 'sm' | 'md' | 'lg'
}>()
</script>

<template>
  <div
    class="inline-flex items-center gap-1.5 font-bold rounded-full bg-amber-500/10 text-amber-500 border border-amber-500/20 shadow-sm"
    :class="{
      'px-2 py-0.5 text-xs': size === 'sm',
      'px-3 py-1 text-sm': !size || size === 'md',
      'px-4 py-1.5 text-base': size === 'lg'
    }"
  >
    <Zap class="w-4 h-4 fill-amber-400 text-amber-500 animate-pulse" />
    <span>{{ amount.toLocaleString('id-ID') }} XP</span>
  </div>
</template>
