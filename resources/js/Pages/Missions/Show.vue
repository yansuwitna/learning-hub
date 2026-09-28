<script setup lang="ts">
import { ref, computed } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Timer from '@/Components/Timer.vue'
import ComboCounter from '@/Components/ComboCounter.vue'
import HintPanel from '@/Components/HintPanel.vue'
import ResultModal from '@/Components/ResultModal.vue'
import XpBadge from '@/Components/XpBadge.vue'
import { ArrowLeft, Check, X, Send, Sparkles, AlertTriangle, Table } from 'lucide-vue-next'
import axios from 'axios'

const props = defineProps<{
  mission: any
  student_mission: any
  student: any
}>()

const currentIndex = ref(0)
const selectedOption = ref('')
const formulaInput = ref('')
const currentCombo = ref(0)
const hintUsedCount = ref(0)

const isSubmitting = ref(false)
const feedbackMessage = ref('')
const feedbackStatus = ref<'correct' | 'incorrect' | null>(null)
const xpEarnedTotal = ref(0)

const showResultModal = ref(false)
const finalScore = ref(100)
const finalStars = ref(3)

const currentQuestion = computed(() => props.mission.questions[currentIndex.value] || null)

const parsedSpreadsheetData = computed(() => {
  if (!currentQuestion.value || !currentQuestion.value.data_json) return null
  try {
    return typeof currentQuestion.value.data_json === 'string'
      ? JSON.parse(currentQuestion.value.data_json)
      : currentQuestion.value.data_json
  } catch (e) {
    return null
  }
})

const handleAnswerSubmit = async () => {
  if (!currentQuestion.value || isSubmitting.value) return

  const answer = currentQuestion.value.question_type === 'formula_input' || currentQuestion.value.question_type === 'debugging'
    ? formulaInput.value
    : selectedOption.value

  if (!answer.trim()) return

  isSubmitting.value = true
  feedbackMessage.value = ''

  try {
    const res = await axios.post('/api/game/submit-answer', {
      question_id: currentQuestion.value.id,
      user_answer: answer,
      time_taken: 10,
      hint_used_count: hintUsedCount.value,
      current_combo: currentCombo.value,
    })

    const data = res.data

    if (data.is_correct) {
      feedbackStatus.value = 'correct'
      currentCombo.value += 1
      xpEarnedTotal.value += data.xp_gained
      feedbackMessage.value = data.feedback
    } else {
      feedbackStatus.value = 'incorrect'
      currentCombo.value = 0
      feedbackMessage.value = data.feedback
    }
  } catch (err) {
    feedbackStatus.value = 'incorrect'
    feedbackMessage.value = 'Terjadi kesalahan saat memeriksa jawaban.'
  } finally {
    isSubmitting.value = false
  }
}

const nextQuestion = async () => {
  feedbackStatus.value = null
  selectedOption.value = ''
  formulaInput.value = ''
  hintUsedCount.value = 0

  if (currentIndex.value + 1 < props.mission.questions.length) {
    currentIndex.value += 1
  } else {
    // Mission completed
    finalScore.value = Math.round((xpEarnedTotal.value / (props.mission.total_questions * 20)) * 100)
    finalStars.value = finalScore.value >= 80 ? 3 : (finalScore.value >= 50 ? 2 : 1)
    
    try {
      await axios.post('/api/game/complete-mission', {
        mission_id: props.mission.id,
        score: finalScore.value,
        stars: finalStars.value,
      })
    } catch (e) {}

    showResultModal.value = true
  }
}

const restartMission = () => {
  showResultModal.value = false
  currentIndex.value = 0
  selectedOption.value = ''
  formulaInput.value = ''
  currentCombo.value = 0
  xpEarnedTotal.value = 0
  feedbackStatus.value = null
}
</script>

<template>
  <AuthenticatedLayout>
    <Head :title="`${mission.title} — Game Misi`" />

    <div class="max-w-4xl mx-auto space-y-6">
      <!-- Game Top Header Bar -->
      <div class="flex items-center justify-between bg-slate-900/90 border border-slate-800 p-4 rounded-3xl shadow-xl backdrop-blur-md">
        <Link href="/missions" class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-black text-slate-400 hover:text-white hover:bg-slate-800 transition">
          <ArrowLeft class="w-4 h-4" />
          <span>Keluar Misi</span>
        </Link>

        <div class="flex items-center gap-4">
          <ComboCounter :combo="currentCombo" />
          <Timer :initial-seconds="currentQuestion ? currentQuestion.time_seconds : 60" />
        </div>
      </div>

      <!-- Question Card Container -->
      <div v-if="currentQuestion" class="relative overflow-hidden bg-slate-950/90 border border-slate-800 rounded-[2rem] p-6 sm:p-10 shadow-2xl space-y-8 backdrop-blur-xl">
        <!-- Decorative Glow -->
        <div class="absolute -top-32 -left-32 w-64 h-64 bg-emerald-500/10 blur-[80px] rounded-full pointer-events-none"></div>

        <!-- Question Meta -->
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-800/80 pb-6">
          <div class="flex flex-wrap items-center gap-3">
            <span class="px-4 py-1.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-black text-xs shadow-[0_0_15px_rgba(52,211,153,0.1)]">
              SOAL {{ currentIndex + 1 }} / {{ mission.total_questions }}
            </span>
            <span class="px-3 py-1.5 rounded-xl bg-slate-900 border border-slate-800 text-xs font-bold text-slate-400 uppercase tracking-widest">
              {{ currentQuestion.question_type.replace('_', ' ') }}
            </span>
          </div>
          <XpBadge :amount="currentQuestion.xp" size="md" class="shrink-0" />
        </div>

        <!-- Question Prompt Text -->
        <div class="relative z-10 space-y-4">
          <h2 class="text-2xl sm:text-3xl font-black text-white leading-tight tracking-tight">
            {{ currentQuestion.question }}
          </h2>
        </div>

        <!-- Spreadsheet Data Table Preview (if available) -->
        <div v-if="parsedSpreadsheetData" class="relative z-10 overflow-x-auto p-5 bg-slate-900 border border-slate-800 rounded-3xl shadow-inner">
          <div class="flex items-center gap-2 text-[10px] font-black text-emerald-500 tracking-widest mb-4">
            <Table class="w-4 h-4" />
            <span>DATA SPREADSHEET</span>
          </div>
          <table class="w-full text-sm text-left border-collapse font-mono bg-slate-950 rounded-xl overflow-hidden">
            <thead>
              <tr class="bg-slate-800 text-slate-300">
                <th v-for="(h, i) in parsedSpreadsheetData.headers" :key="i" class="p-3 border border-slate-700/50 font-bold uppercase tracking-wider text-xs">
                  {{ h }}
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(row, rIdx) in parsedSpreadsheetData.rows" :key="rIdx" class="hover:bg-emerald-500/10 transition-colors">
                <td v-for="(val, cIdx) in row" :key="cIdx" class="p-3 border border-slate-800/50 text-slate-400">
                  {{ val }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Answer Inputs Area -->
        <div class="relative z-10 space-y-5 pt-2">
          <!-- Formula Input or Debugging -->
          <div v-if="currentQuestion.question_type === 'formula_input' || currentQuestion.question_type === 'debugging'" class="space-y-3">
            <label class="block text-[10px] font-black text-cyan-500 uppercase tracking-widest">Ketikkan Formula / Rumus Excel:</label>
            <div class="relative group">
              <input
                v-model="formulaInput"
                type="text"
                placeholder="Contoh: =SUM(B2:B10)"
                class="w-full font-mono text-xl font-bold py-5 px-6 rounded-2xl border-2 border-slate-800 bg-slate-900 text-emerald-400 placeholder:text-slate-600 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 shadow-inner transition-all"
                @keyup.enter="handleAnswerSubmit"
              />
              <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none opacity-50 group-focus-within:opacity-100 transition-opacity">
                <code class="text-[10px] text-slate-400 bg-slate-800 px-2 py-1 rounded font-bold">ENTER ↵</code>
              </div>
            </div>
          </div>

          <!-- Multiple Choice or True/False -->
          <div v-else class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <button
              v-for="opt in currentQuestion.options"
              :key="opt.id"
              @click="selectedOption = opt.option_text"
              class="p-5 rounded-2xl border-2 text-left font-bold text-sm transition-all duration-300 flex items-center justify-between"
              :class="selectedOption === opt.option_text
                ? 'border-emerald-500 bg-emerald-500/10 text-emerald-400 shadow-[0_0_20px_rgba(52,211,153,0.15)] scale-[1.02] transform'
                : 'border-slate-800 bg-slate-900 text-slate-300 hover:border-slate-600 hover:bg-slate-800'"
            >
              <div class="flex items-center gap-3">
                <span class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-black" :class="selectedOption === opt.option_text ? 'bg-emerald-500 text-slate-950' : 'bg-slate-800 text-slate-500'">
                  {{ opt.option_key }}
                </span>
                <span class="text-base">{{ opt.option_text }}</span>
              </div>
              <div
                class="w-6 h-6 rounded-full border-2 flex items-center justify-center"
                :class="selectedOption === opt.option_text ? 'border-emerald-500 bg-emerald-500 text-slate-950' : 'border-slate-700'"
              >
                <Check v-if="selectedOption === opt.option_text" class="w-4 h-4 font-black" />
              </div>
            </button>
          </div>
        </div>

        <!-- Hint Panel -->
        <div class="relative z-10">
          <HintPanel :question-id="currentQuestion.id" @hint-used="hintUsedCount++" />
        </div>

        <!-- Feedback Alert Box -->
        <div v-if="feedbackStatus" class="relative z-10 p-5 rounded-2xl border-2 flex items-start gap-4 animate-fade-in shadow-lg backdrop-blur-sm"
          :class="feedbackStatus === 'correct' ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400' : 'bg-rose-500/10 border-rose-500/30 text-rose-400'"
        >
          <div class="p-2 rounded-xl" :class="feedbackStatus === 'correct' ? 'bg-emerald-500/20' : 'bg-rose-500/20'">
            <Check v-if="feedbackStatus === 'correct'" class="w-6 h-6 shrink-0" />
            <X v-else class="w-6 h-6 shrink-0" />
          </div>
          <div class="space-y-1.5 pt-1">
            <div class="font-black text-lg tracking-tight">{{ feedbackStatus === 'correct' ? 'JAWABAN BENAR!' : 'JAWABAN BELUM TEPAT' }}</div>
            <p class="text-sm font-medium leading-relaxed opacity-90">{{ feedbackMessage }}</p>
          </div>
        </div>

        <!-- Action Submit / Next Button -->
        <div class="relative z-10 pt-8 border-t border-slate-800 flex justify-end">
          <button
            v-if="!feedbackStatus"
            @click="handleAnswerSubmit"
            :disabled="isSubmitting || (!formulaInput.trim() && !selectedOption)"
            class="px-8 py-4 rounded-2xl bg-emerald-500 hover:bg-emerald-400 disabled:opacity-50 disabled:hover:bg-emerald-500 disabled:cursor-not-allowed text-slate-950 font-black text-sm shadow-[0_0_20px_rgba(52,211,153,0.3)] hover:shadow-[0_0_30px_rgba(52,211,153,0.5)] transition-all flex items-center gap-3 hover:-translate-y-1 transform"
          >
            <Send class="w-5 h-5" />
            <span>PERIKSA JAWABAN</span>
          </button>
          <button
            v-else
            @click="nextQuestion"
            class="px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-500 to-cyan-400 hover:from-emerald-400 hover:to-cyan-300 text-slate-950 font-black text-sm shadow-[0_0_20px_rgba(52,211,153,0.4)] hover:shadow-[0_0_30px_rgba(52,211,153,0.6)] transition-all flex items-center gap-3 hover:-translate-y-1 transform"
          >
            <span>{{ currentIndex + 1 < mission.questions.length ? 'SOAL BERIKUTNYA' : 'LIHAT HASIL MISI' }}</span>
            <Sparkles class="w-5 h-5 fill-slate-950" />
          </button>
        </div>
      </div>

      <!-- Result Modal Component -->
      <ResultModal
        :show="showResultModal"
        :mission-title="mission.title"
        :score="finalScore"
        :stars="finalStars"
        :xp-earned="xpEarnedTotal"
        :mission-id="mission.id"
        @close="showResultModal = false; $inertia.visit('/missions')"
        @restart="restartMission"
      />
    </div>
  </AuthenticatedLayout>
</template>
