<script setup>
import { ShieldCheck, Plus, CircleCheck, KeyRound, Layers } from 'lucide-vue-next';
import { useCounter } from '@/Helper/counter';
import { onMounted } from 'vue';

const props = defineProps(['total']);
const total = useCounter();
onMounted(()=>{
    total.start(props?.total, 100);
})
</script>

<template>
    <div class="w-full mx-auto rounded-2xl bg-[#0b1120] p-5 sm:p-8 font-second">
        <span data-aos="flip-up" class="inline-flex items-center gap-2 rounded-full bg-cyan-400/10 px-3 py-1 text-[11px] font-semibold tracking-wide text-cyan-300">
            <span class="h-1.5 w-1.5 rounded-full bg-cyan-400"></span>
            ENTERPRISE ACCESS
        </span>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="flex items-start gap-3">
                <div data-aos="flip-up" class="mt-1 shrink-0 h-9 w-9 rounded-lg bg-cyan-400/10 flex items-center justify-center">
                    <ShieldCheck class="h-5 w-5 text-cyan-300" />
                </div>
                <div>
                    <h1 data-aos="flip-up" class="text-2xl sm:text-3xl font-bold text-white">Access Control</h1>
                    <p class="mt-2 max-w-md text-sm sm:text-base text-slate-400 leading-relaxed">
                        This page lists all pages available in the system and manages access based on user scope to ensure security and navigation relevance.
                    </p>
                </div>
            </div>
            <div class="text-white flex items-center justify-center">
                <div>
                    <h1 class="text-5xl font-semibold text-center">{{ total.count }}</h1>
                    <p class="text-sm">Available pages</p>
                </div>
            </div>
        </div>

        <div class="mt-6 border-t border-white/10 pt-5 grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div data-aos="zoom-in" class="flex items-center gap-3 rounded-xl bg-white/5 px-4 py-3">
                <div class="h-9 w-9 shrink-0 rounded-lg bg-emerald-400/10 flex items-center justify-center">
                    <CircleCheck class="h-4 w-4 text-emerald-400" />
                </div>
                <div>
                    <p class="text-lg font-semibold text-white">Specific</p>
                    <p class="text-xs text-slate-400">Scope</p>
                </div>
            </div>

            <div data-aos="zoom-in" data-aos-delay="100" class="flex items-center gap-3 rounded-xl bg-white/5 px-4 py-3">
                <div class="h-9 w-9 shrink-0 rounded-lg bg-sky-400/10 flex items-center justify-center">
                    <KeyRound class="h-4 w-4 text-sky-400" />
                </div>
                <div>
                    <p class="text-lg font-semibold text-white">Super Admin</p>
                    <p class="text-xs text-slate-400">scope</p>
                </div>
            </div>

            <div data-aos="zoom-in" data-aos-delay="200" class="flex items-center gap-3 rounded-xl bg-white/5 px-4 py-3">
                <div class="h-9 w-9 shrink-0 rounded-lg bg-violet-400/10 flex items-center justify-center">
                    <Layers class="h-4 w-4 text-violet-400" />
                </div>
                <div>
                    <p class="text-lg font-semibold text-white">General</p>
                    <p class="text-xs text-slate-400">scope</p>
                </div>
            </div>
        </div>
    </div>
</template>