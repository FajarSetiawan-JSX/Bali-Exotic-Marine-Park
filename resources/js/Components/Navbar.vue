<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const user = usePage().props.auth?.user;
</script>

<template>
    <nav class="flex items-center justify-between fixed z-50 top-0 w-full px-6 md:px-16 lg:px-24 xl:px-32 py-1.5 bg-white/40 backdrop-blur-sm">
        <a href="/" class="max-w-max flex justify-center items-center gap-x-1">
            <img class="h-9 md:h-9.5 w-auto shrink-0" src="/EXOTIC.png" alt="Logo">
            <div>
                <h1 class="font-exotic1 text-[#273A7B] text-2xl font-semibold">Bali Exotic</h1>
                <h2 class="font-exotic2 text-[#51608A] tracking-wide text-sm">Marine Park</h2>
            </div>
        </a>
        <div class="flex items-center gap-4 md:gap-6">
            <Link v-if="!user" :href="route('login')" class=" hover:bg-slate-100 transition px-4 py-2 border border-indigo-600 rounded-md">
                Sign in
            </Link>
            <!-- AMBIL ROUTE DASHBOARD DINAMIS BERDASARKAN DIVISION MELALUI MIDDLEWARE INERTIA -->
            <Link v-else :href="route($page.props.auth.dashboard)" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 transition text-white rounded-md">
                Dashboard
            </Link>
        </div>
    </nav>
</template>