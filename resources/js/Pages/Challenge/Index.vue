<script setup lang="ts">
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import XpBadge from '@/Components/XpBadge.vue'
import { Zap, Flame, Check, X, Send } from 'lucide-vue-next'
import axios from 'axios'

const props = defineProps<{
  challenge: any
  student: any
}>()

const answerInput = ref('')
const isSubmitting = ref(false)
const feedbackStatus = ref<'correct' | 'incorrect' | null>(null)
const feedbackMsg = ref('')

const submitChallenge = async () => {
  if (!props.challenge || !answerInput.value.trim() || isSubmitting.value) return
  isSubmitting.value = true

  try {
    const res = await axios.post('/api/game/submit-answer', {
      question_id: props.challenge.question.id,
      user_answer: answerInput.value,
    })

    if (res.data.is_correct) {
      feedbackStatus.value = 'correct'
      feedbackMsg.value = `🎉 HARI INI TANTANGAN SELESAI! +${res.data.xp_gained + props.challenge.xp_bonus} XP (Termasuk Bonus Streak)`
    } else {
      feedbackStatus.value = 'incorrect'
      feedbackMsg.value = res.data.feedback
    }
  } catch (e) {
    feedbackStatus.value = 'incorrect'
    feedbackMsg.value = 'Terjadi kesalahan periksa koneksi.'
  } finally {
    isSubmitting.value = false
  }
}
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Daily Challenge — EXCELVERSE" />

    <div class="max-w-3xl mx-auto space-y-6">
      <div class="p-8 rounded-3xl bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 text-slate-950 shadow-xl space-y-4">
        <div class="flex items-center justify-between">
          <span class="px-3 py-1 rounded-full bg-slate-950/20 text-slate-950 font-black text-xs uppercase tracking-widest">
            DAILY STREAK CHALLENGE
          </span>
          <div class="flex items-center gap-1 font-black text-sm bg-slate-950/10 px-3 py-1 rounded-xl">
            <Flame class="w-4 h-4 fill-amber-300 text-slate-950" />
            <span>+1 STREAK FLAME</span>
          </div>
        </div>
        <h1 class="text-3xl font-black">Tantangan Harian Hari Ini</h1>
        <p class="text-sm font-medium text-slate-900/80">Selesaikan 1 soal khusus setiap hari untuk mempertahankan streak dan mendapatkan ekstra bonus XP!</p>
      </div>

      <div v-if="challenge" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
          <span class="font-bold text-xs text-slate-400">TANGGAL: {{ challenge.challenge_date }}</span>
          <XpBadge :amount="challenge.question.xp + challenge.xp_bonus" size="md" />
        </div>

        <h2 class="text-xl font-bold text-slate-900 dark:text-white leading-relaxed">
          {{ challenge.question.question }}
        </h2>

        <div class="space-y-3">
          <input
            v-model="answerInput"
            type="text"
            placeholder="Jawaban atau Formula..."
            class="w-full text-base font-bold py-3.5 px-4 rounded-xl border-2 border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-emerald-500 focus:ring-0 focus:border-emerald-500"
            @keyup.enter="submitChallenge"
          />
        </div>

        <div v-if="feedbackStatus" class="p-4 rounded-2xl border flex items-center gap-3"
          :class="feedbackStatus === 'correct' ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-500' : 'bg-rose-500/10 border-rose-500/30 text-rose-500'"
        >
          <Check v-if="feedbackStatus === 'correct'" class="w-5 h-5 shrink-0" />
          <X v-else class="w-5 h-5 shrink-0" />
          <span class="text-xs font-bold">{{ feedbackMsg }}</span>
        </div>

        <div class="flex justify-end pt-4">
          <button
            @click="submitChallenge"
            :disabled="isSubmitting || !answerInput.trim()"
            class="px-8 py-3.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm shadow-lg shadow-amber-500/20 transition flex items-center gap-2"
          >
            <Send class="w-4 h-4" />
            <span>KIRIM JAWABAN</span>
          </button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
