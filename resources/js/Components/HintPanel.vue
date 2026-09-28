<script setup lang="ts">
import { ref } from 'vue'
import { Lightbulb, ChevronRight } from 'lucide-vue-next'
import axios from 'axios'

const props = defineProps<{
  questionId: number
}>()

const emit = defineEmits(['hintUsed'])

const hintLevel = ref(0)
const hints = ref<string[]>([])
const loading = ref(false)

const fetchHint = async () => {
  if (hintLevel.value >= 3 || loading.value) return
  loading.value = true
  try {
    const nextLevel = hintLevel.value + 1
    const res = await axios.get(`/api/game/hint/${props.questionId}?level=${nextLevel}`)
    hints.value.push(res.data.hint)
    hintLevel.value = nextLevel
    emit('hintUsed', hintLevel.value)
  } catch (err) {
    console.error('Error fetching hint', err)
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="bg-amber-500/10 border border-amber-500/20 rounded-xl p-4 transition-all">
    <div class="flex items-center justify-between mb-2">
      <div class="flex items-center gap-2 font-bold text-amber-500">
        <Lightbulb class="w-5 h-5 fill-amber-400 text-amber-500" />
        <span>PETUNJUK (HINT)</span>
      </div>
      <button
        v-if="hintLevel < 3"
        @click="fetchHint"
        :disabled="loading"
        class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1.5 rounded-lg bg-amber-500 text-slate-900 hover:bg-amber-400 disabled:opacity-50 transition"
      >
        <span>Petunjuk {{ hintLevel + 1 }}</span>
        <ChevronRight class="w-3.5 h-3.5" />
      </button>
    </div>

    <div v-if="hints.length > 0" class="space-y-2 mt-3 text-sm text-slate-700 dark:text-slate-300">
      <div v-for="(h, idx) in hints" :key="idx" class="p-2.5 bg-white/60 dark:bg-slate-800/60 rounded-lg border border-amber-500/10">
        <span class="font-bold text-amber-500 mr-2">#{{ idx + 1 }}</span> {{ h }}
      </div>
    </div>
    <div v-else class="text-xs text-slate-500 dark:text-slate-400 italic">
      Gunakan petunjuk jika mengalami kesulitan. Hadiah XP berkurang ringan saat menggunakan petunjuk.
    </div>
  </div>
</template>
