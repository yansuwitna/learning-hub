<script setup lang="ts">
import { ref, onMounted, onUnmounted, watch } from 'vue'
import { Clock } from 'lucide-vue-next'

const props = defineProps<{
  initialSeconds: number
  autostart?: boolean
}>()

const emit = defineEmits(['timeout', 'tick'])

const secondsLeft = ref(props.initialSeconds)
let timerId: any = null

const startTimer = () => {
  stopTimer()
  timerId = setInterval(() => {
    if (secondsLeft.value > 0) {
      secondsLeft.value--
      emit('tick', secondsLeft.value)
    } else {
      stopTimer()
      emit('timeout')
    }
  }, 1000)
}

const stopTimer = () => {
  if (timerId) {
    clearInterval(timerId)
    timerId = null
  }
}

onMounted(() => {
  if (props.autostart !== false) {
    startTimer()
  }
})

onUnmounted(() => {
  stopTimer()
})

watch(() => props.initialSeconds, (newVal) => {
  secondsLeft.value = newVal
  startTimer()
})
</script>

<template>
  <div
    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg font-mono font-bold shadow-sm transition-colors duration-300"
    :class="{
      'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20': secondsLeft > 15,
      'bg-amber-500/10 text-amber-500 border border-amber-500/20': secondsLeft <= 15 && secondsLeft > 5,
      'bg-rose-500/20 text-rose-500 border border-rose-500/30 animate-pulse': secondsLeft <= 5
    }"
  >
    <Clock class="w-4 h-4" />
    <span>{{ String(Math.floor(secondsLeft / 60)).padStart(2, '0') }}:{{ String(secondsLeft % 60).padStart(2, '0') }}</span>
  </div>
</template>
