<script setup lang="ts">
import { ref } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { User, Mail, Lock, UserPlus, Sparkles } from 'lucide-vue-next'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => {
      form.reset('password', 'password_confirmation')
    },
  })
}
</script>

<template>
  <GuestLayout>
    <Head title="Daftar Siswa Baru — EXCELVERSE" />

    <div class="space-y-6">
      <div class="text-center space-y-1">
        <h2 class="text-2xl font-black text-white">BUAT AKUN SISWA</h2>
        <p class="text-xs text-slate-400">Daftarkan dirimu untuk mulai mengumpulkan XP & Lencana Excel.</p>
      </div>

      <form @submit.prevent="submit" class="space-y-4">
        <!-- Full Name -->
        <div class="space-y-1.5">
          <label for="name" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">Nama Lengkap Siswa</label>
          <div class="relative">
            <User class="w-5 h-5 absolute left-3.5 top-3.5 text-slate-500" />
            <input
              id="name"
              type="text"
              v-model="form.name"
              required
              autofocus
              placeholder="Ahmad Rizky"
              class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-950/80 border border-slate-700/80 text-white text-sm font-semibold focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
            />
          </div>
          <p v-if="form.errors.name" class="text-xs font-bold text-rose-400">{{ form.errors.name }}</p>
        </div>

        <!-- Email -->
        <div class="space-y-1.5">
          <label for="email" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">Email Siswa</label>
          <div class="relative">
            <Mail class="w-5 h-5 absolute left-3.5 top-3.5 text-slate-500" />
            <input
              id="email"
              type="email"
              v-model="form.email"
              required
              placeholder="ahmad@smk.sch.id"
              class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-950/80 border border-slate-700/80 text-white text-sm font-semibold focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
            />
          </div>
          <p v-if="form.errors.email" class="text-xs font-bold text-rose-400">{{ form.errors.email }}</p>
        </div>

        <!-- Password -->
        <div class="space-y-1.5">
          <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">Kata Sandi</label>
          <div class="relative">
            <Lock class="w-5 h-5 absolute left-3.5 top-3.5 text-slate-500" />
            <input
              id="password"
              type="password"
              v-model="form.password"
              required
              placeholder="Minimal 8 karakter"
              class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-950/80 border border-slate-700/80 text-white text-sm font-semibold focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
            />
          </div>
          <p v-if="form.errors.password" class="text-xs font-bold text-rose-400">{{ form.errors.password }}</p>
        </div>

        <!-- Password Confirmation -->
        <div class="space-y-1.5">
          <label for="password_confirmation" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">Konfirmasi Kata Sandi</label>
          <div class="relative">
            <Lock class="w-5 h-5 absolute left-3.5 top-3.5 text-slate-500" />
            <input
              id="password_confirmation"
              type="password"
              v-model="form.password_confirmation"
              required
              placeholder="Ulangi kata sandi"
              class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-950/80 border border-slate-700/80 text-white text-sm font-semibold focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
            />
          </div>
          <p v-if="form.errors.password_confirmation" class="text-xs font-bold text-rose-400">{{ form.errors.password_confirmation }}</p>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          :disabled="form.processing"
          class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-emerald-500 via-teal-400 to-emerald-500 text-slate-950 font-black text-sm shadow-lg shadow-emerald-500/20 hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 transition flex items-center justify-center gap-2"
        >
          <UserPlus class="w-4 h-4" />
          <span>DAFTAR AKUN SEKARANG</span>
        </button>
      </form>

      <div class="pt-4 border-t border-slate-800 text-center text-xs text-slate-400">
        Sudah memiliki akun?
        <Link :href="route('login')" class="font-bold text-emerald-400 hover:underline ml-1">Masuk di Sini</Link>
      </div>
    </div>
  </GuestLayout>
</template>
