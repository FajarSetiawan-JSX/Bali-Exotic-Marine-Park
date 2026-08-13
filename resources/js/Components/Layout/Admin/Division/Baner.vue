<script setup>
import { ref, computed, onMounted } from 'vue'
import { Search } from 'lucide-vue-next'

const props = defineProps(['positions', 'division', 'Time']);
const search = ref('')
const hov = ref(null)
const menu = ref(null)
const divisi = ref(0);
const postion = ref(0);
const WorkTime = ref(0)

onMounted(()=>{
    let a = 0;
    let b = 0;
    let c = 0;
    let d = props.division;
    let p = props.positions;
    let w = props.Time;

    const countdivisi = setInterval(()=>{
        if(a >= d) return clearInterval(countdivisi)
        divisi.value++;
        a++;
    }, 80)

    const countposition = setInterval(()=>{
        if(b >= p) return clearInterval(countposition)
        postion.value++;
        b++;
    }, 80)

    const countwork = setInterval(()=>{
        if(c >= w) return clearInterval(countwork)
        WorkTime.value++;
        c++;
    }, 80)
})
</script>

<template>
    <div class="relative overflow-hidden rounded-3xl px-9 py-8 text-white" style="background:linear-gradient(135deg,#0C0C2B 0%,#1E1B4B 50%,#0A2540 100%)">
        <div class="absolute -right-16 -top-16 h-72 w-72 rounded-full border border-white/10"/>
        <div class="absolute right-10 -top-5 h-40 w-40 rounded-full border border-violet-500/20"/>
        <div class="absolute right-24 -bottom-10 h-52 w-52 rounded-full" style="background:radial-gradient(circle,rgba(99,102,241,.12),transparent 70%)"/>
        <div class="relative z-10 flex flex-wrap items-center justify-between gap-5">
            <!-- Left -->
            <div>
                <div class="mb-3 inline-flex items-center gap-2 rounded-full border border-violet-400/40 bg-violet-500/20 px-3 py-1">
                    <div class="h-1.5 w-1.5 rounded-full bg-violet-300"/>
                    <span class="text-[11px] font-bold tracking-[0.15em] text-violet-200 uppercase">
                        Management Division
                    </span>
                </div>
                <h2 class="text-3xl font-extrabold">
                    Organization structure
                </h2>
                <p class="mt-2 max-w-md text-sm text-white/60">
                    Centrally manage organizational units, access rights, and the distribution of BEMP team members.
                </p>
            </div>
            <div class="flex gap-8">
                <div class="text-center">
                    <p class="text-3xl font-bold">
                        {{ divisi }}
                    </p>

                    <p class="mt-1 text-xs text-white/50">
                        Total Division
                    </p>
                </div>

                <div class="text-center">
                    <p class="text-3xl font-bold">
                        {{ postion }}
                    </p>

                    <p class="mt-1 text-xs text-white/50">
                        Total Position
                    </p>
                </div>

                <div class="text-center">
                    <p class="text-3xl font-bold">
                        {{ WorkTime }}
                    </p>

                    <p class="mt-1 text-xs text-white/50">
                        Session work
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>