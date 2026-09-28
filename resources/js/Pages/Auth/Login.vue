<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Mail, Lock, LogIn, Sparkles, User, ShieldCheck } from 'lucide-vue-next'

defineProps<{
  canResetPassword?: boolean
  status?: string
}>()

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => {
      form.reset('password')
    },
  })
}

const fillDemo = (role: 'siswa' | 'guru' | 'admin') => {
  if (role === 'siswa') {
    form.email = 'siswa@excelverse.id'
    form.password = 'password123'
  } else if (role === 'guru') {
    form.email = 'guru@excelverse.id'
    form.password = 'password123'
  } else if (role === 'admin') {
    form.email = 'admin@excelverse.id'
    form.password = 'password123'
  }
}
</script>

<template>
  <GuestLayout>
    <Head title="Masuk Akun — EXCELVERSE" />

    <div class="space-y-6">
      <div class="text-center space-y-1">
        <h2 class="text-2xl font-black text-white">SELAMAT DATANG!</h2>
        <p class="text-xs text-slate-400">Masuk untuk melanjutkan petualangan & misi Excel-mu.</p>
      </div>

      <div v-if="status" class="p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-xs font-bold text-emerald-400 text-center">
        {{ status }}
      </div>

      <!-- Quick Demo Login Bar -->
      <div class="p-3 rounded-2xl bg-slate-950/60 border border-slate-800 space-y-2">
        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center flex items-center justify-center gap-1">
          <Sparkles class="w-3 h-3 text-emerald-400" />
          <span>LOGIN CEPAT DEMO (1-CLICK)</span>
        </div>
        <div class="grid grid-cols-3 gap-2">
          <button
            type="button"
            @click="fillDemo('siswa')"
            class="py-1.5 px-2 rounded-xl bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-xs font-bold transition flex items-center justify-center gap-1"
          >
            <User class="w-3.5 h-3.5" />
            <span>Siswa</span>
          </button>
          <button
            type="button"
            @click="fillDemo('guru')"
            class="py-1.5 px-2 rounded-xl bg-teal-500/10 hover:bg-teal-500/20 text-teal-400 border border-teal-500/30 text-xs font-bold transition flex items-center justify-center gap-1"
          >
            <ShieldCheck class="w-3.5 h-3.5" />
            <span>Guru</span>
          </button>
          <button
            type="button"
            @click="fillDemo('admin')"
            class="py-1.5 px-2 rounded-xl bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-xs font-bold transition flex items-center justify-center gap-1"
          >
            <ShieldCheck class="w-3.5 h-3.5" />
            <span>Admin</span>
          </button>
        </div>
      </div>

      <form @submit.prevent="submit" class="space-y-4">
        <!-- Email Input -->
        <div class="space-y-1.5">
          <label for="email" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">Email Siswa / Guru</label>
          <div class="relative">
            <Mail class="w-5 h-5 absolute left-3.5 top-3.5 text-slate-500" />
            <input
              id="email"
              type="email"
              v-model="form.email"
              required
              autofocus
              placeholder="nama@sekolah.sch.id"
              class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-950/80 border border-slate-700/80 text-white text-sm font-semibold focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
            />
          </div>
          <p v-if="form.errors.email" class="text-xs font-bold text-rose-400">{{ form.errors.email }}</p>
        </div>

        <!-- Password Input -->
        <div class="space-y-1.5">
          <div class="flex justify-between items-center">
            <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">Kata Sandi</label>
            <Link v-if="canResetPassword" :href="route('password.request')" class="text-xs font-semibold text-emerald-400 hover:underline">Lupa Password?</Link>
          </div>
          <div class="relative">
            <Lock class="w-5 h-5 absolute left-3.5 top-3.5 text-slate-500" />
            <input
              id="password"
              type="password"
              v-model="form.password"
              required
              placeholder="••••••••"
              class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-950/80 border border-slate-700/80 text-white text-sm font-semibold focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
            />
          </div>
          <p v-if="form.errors.password" class="text-xs font-bold text-rose-400">{{ form.errors.password }}</p>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-center">
          <input
            id="remember"
            type="checkbox"
            v-model="form.remember"
            class="w-4 h-4 rounded border-slate-700 bg-slate-950 text-emerald-500 focus:ring-emerald-500 focus:ring-offset-slate-900"
          />
          <label for="remember" class="ml-2 text-xs font-medium text-slate-400">Ingat saya di perangkat ini</label>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          :disabled="form.processing"
          class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-emerald-500 via-teal-400 to-emerald-500 text-slate-950 font-black text-sm shadow-lg shadow-emerald-500/20 hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 transition flex items-center justify-center gap-2"
        >
          <LogIn class="w-4 h-4" />
          <span>MASUK SEKARANG</span>
        </button>
      </form>

      <div class="pt-4 border-t border-slate-800 text-center text-xs text-slate-400">
        Belum punya akun?
        <Link :href="route('register')" class="font-bold text-emerald-400 hover:underline ml-1">Daftar Akun Siswa Baru</Link>
      </div>
    </div>
  </GuestLayout>
</template>
