<script setup lang="ts">
import { Flame } from 'lucide-vue-next'

defineProps<{
  combo: number
}>()
</script>

<template>
  <transition
    enter-active-class="transform transition duration-300 ease-out"
    enter-from-class="scale-50 opacity-0"
    enter-to-class="scale-100 opacity-100"
    leave-active-class="transform transition duration-200 ease-in"
    leave-from-class="scale-100 opacity-100"
    leave-to-class="scale-75 opacity-0"
  >
    <div
      v-if="combo > 1"
      class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-full shadow-lg font-black tracking-wider animate-bounce"
    >
      <Flame class="w-5 h-5 fill-yellow-300 text-yellow-300" />
      <span>COMBO ×{{ combo }}</span>
    </div>
  </transition>
</template>
