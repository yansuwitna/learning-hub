<script setup lang="ts">
import { ref } from 'vue'
import { Trophy, Star, ArrowRight, RotateCcw } from 'lucide-vue-next'
import confetti from 'canvas-confetti'
import axios from 'axios'

const props = defineProps<{
  show: boolean
  missionTitle: string
  score: number
  stars: number
  xpEarned: number
  missionId: number
}>()

const emit = defineEmits(['close', 'restart'])

const reflectionText = ref('')
const reflectionSaved = ref(false)

if (props.show && props.stars >= 2) {
  confetti({ particleCount: 100, spread: 70, origin: { y: 0.6 } })
}

const saveReflection = async () => {
  if (!reflectionText.value.trim()) return
  try {
    await axios.post('/api/game/reflection', {
      mission_id: props.missionId,
      reflection_notes: reflectionText.value,
    })
    reflectionSaved.value = true
  } catch (e) {
    console.error(e)
  }
}
</script>

<template>
  <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm animate-fade-in">
    <div class="w-full max-w-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-2xl space-y-6">
      <div class="text-center space-y-2">
        <div class="inline-flex p-4 rounded-full bg-emerald-500/10 text-emerald-500 mb-2">
          <Trophy class="w-12 h-12 stroke-[1.5]" />
        </div>
        <h2 class="text-2xl font-black text-slate-900 dark:text-white">MISI SELESAI!</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400">{{ missionTitle }}</p>
      </div>

      <!-- Stars -->
      <div class="flex justify-center gap-2">
        <Star
          v-for="s in 3"
          :key="s"
          class="w-8 h-8 transition-transform duration-300"
          :class="s <= stars ? 'fill-amber-400 text-amber-400 scale-110' : 'text-slate-300 dark:text-slate-700'"
        />
      </div>

      <!-- Stats Box -->
      <div class="grid grid-cols-2 gap-4 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl text-center">
        <div>
          <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">SKOR AKHIR</div>
          <div class="text-2xl font-black text-emerald-500">{{ score }}%</div>
        </div>
        <div>
          <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">HADIAH XP</div>
          <div class="text-2xl font-black text-amber-500">+{{ xpEarned }} XP</div>
        </div>
      </div>

      <!-- Reflection Box -->
      <div class="space-y-2">
        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Refleksi Belajar (Opsional)</label>
        <textarea
          v-model="reflectionText"
          rows="2"
          placeholder="Apa strategi atau rumus baru yang kamu pelajari dari misi ini?"
          class="w-full text-sm rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:ring-emerald-500 focus:border-emerald-500"
        ></textarea>
        <button
          v-if="!reflectionSaved && reflectionText.trim()"
          @click="saveReflection"
          class="text-xs font-bold text-emerald-500 hover:underline"
        >
          Simpan Refleksi
        </button>
        <span v-else-if="reflectionSaved" class="text-xs text-emerald-500 font-bold">✓ Refleksi tersimpan!</span>
      </div>

      <!-- Action buttons -->
      <div class="flex gap-3">
        <button
          @click="$emit('restart')"
          class="flex-1 py-3 px-4 rounded-xl border border-slate-300 dark:border-slate-700 font-bold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition flex items-center justify-center gap-2"
        >
          <RotateCcw class="w-4 h-4" /> Ulangi
        </button>
        <button
          @click="$emit('close')"
          class="flex-1 py-3 px-4 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold shadow-lg shadow-emerald-500/20 transition flex items-center justify-center gap-2"
        >
          <span>Lanjut Misi</span>
          <ArrowRight class="w-4 h-4" />
        </button>
      </div>
    </div>
  </div>
</template>
