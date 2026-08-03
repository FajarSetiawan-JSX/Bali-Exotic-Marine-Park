<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const mounted = ref(false)
const activeTagline = ref(0)

const taglines = [
    'Empower your workforce with smarter scheduling.',
    'Monitor daily operations in real time.',
    'One platform. Complete workforce control.',
    'Built for modern workforce management.'
]

const chips = [
    'Smart Scheduling',
    'Live Reports',
    'Multi-Department',
    'Cloud-Based'
]

let interval = null

onMounted(() => {

    mounted.value = true

    interval = setInterval(() => {
        activeTagline.value =
            (activeTagline.value + 1) % taglines.length
    }, 3800)

})

onUnmounted(() => clearInterval(interval))

const date = new Date().toLocaleDateString('id-ID', {
    weekday: 'long',
    day: 'numeric',
    month: 'long',
    year: 'numeric'
})
</script>

<template>
    <div class="relative overflow-hidden bg-[#100E2E] text-white min-h-[330px] lg:min-h-screen">
        <!-- Noise -->
        <div class="noise"/>
        <!-- Glow -->
        <div class="glow"/>
        <!-- Circle -->
        <div class="circle circle-1"/>
        <div class="circle circle-2"/>
        <!-- Border -->
        <div class="hidden lg:block absolute right-0 top-0 bottom-0 w-px bg-white/10"/>
        <div class="relative z-10 flex h-full flex-col px-7 py-8 lg:px-14 lg:py-10">
            <!-- Top -->
            <div class="flex justify-between items-center">
                <div class="rounded-full border border-white/10 bg-white/5 px-3 py-1.5 flex items-center gap-2">
                    <span class="size-2 rounded-full bg-green-400 shadow-[0_0_10px_#4ade80]"/>
                    <span class="font-mono text-[10px] uppercase tracking-[.18em] text-white/50">
                        System active
                    </span>
                </div>
            </div>
            <!-- Center -->
            <div class="flex flex-1 flex-col justify-center py-10">
                <img src="/EXOTIC.png" class="w-36 lg:w-52 mb-8 brightness-0 invert transition duration-700" :class="mounted ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                <div class="transition duration-700 delay-100" :class="mounted ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <p class="font-exotic1 uppercase tracking-[.32em] text-cyan-400 text-[10px]">
                        Bali Exotic <span class="font-exotic2 text-white">Marine Park</span> 
                    </p>
                    <div class="mt-5 h-px w-10 bg-white/20"/>
                    <div class="relative mt-7 h-20">
                        <TransitionGroup name="fade">
                            <h2 v-for="(item,index) in taglines" v-show="activeTagline==index" :key="item" class="absolute left-0 top-0 max-w-md text-3xl italic leading-tight text-white/90 lg:text-4xl font-serif">
                                {{ item }}
                            </h2>
                        </TransitionGroup>
                    </div>
                    <!-- Dots -->
                    <div class="mt-6 flex gap-2">
                        <div v-for="(_,index) in taglines" :key="index" class="h-1 rounded-full transition-all duration-300" :class="activeTagline==index ?'w-6 bg-white/80' :'w-2 bg-white/20'"/>
                    </div>
                </div>
                <!-- Chips -->
                <div class="mt-10 flex flex-wrap gap-2">
                    <span v-for="(chip, index) in chips" :key="chip" data-aos="zoom-in" :data-aos-delay="index * 200" data-aos-offset="0" class="rounded-md border border-white/10 bg-white/5 px-3 py-1.5 text-[11px] font-mono tracking-wide text-white/50 transition hover:bg-white/10">
                        {{ chip }}
                    </span>
                </div>
            </div>
            <!-- Footer -->
            <div class="mt-10 flex flex-col gap-3 text-[11px] text-white/25 lg:flex-row lg:items-end lg:justify-between">
                <span class="font-mono">
                    {{ date }}
                </span>
                <span class="font-mono">
                    © 2026 BALI EXOTIC MARINE PARK
                </span>
            </div>
        </div>
    </div>
</template>

<style scoped>

.noise{
position:absolute;
inset:0;
opacity:.03;
background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
background-size:180px;
}

.glow{
position:absolute;
width:520px;
height:520px;
left:-180px;
top:-180px;
border-radius:9999px;
background:radial-gradient(circle,rgba(99,80,220,.18),transparent 70%);
}

.circle{
position:absolute;
border-radius:9999px;
border:1px solid rgba(255,255,255,.05);
}

.circle-1{
width:520px;
height:520px;
right:-220px;
bottom:-220px;
}

.circle-2{
width:360px;
height:360px;
right:-120px;
bottom:-120px;
border-color:rgba(255,255,255,.04);
}

.fade-enter-active,
.fade-leave-active{
transition:.5s;
}

.fade-enter-from,
.fade-leave-to{
opacity:0;
transform:translateY(10px);
}

</style>