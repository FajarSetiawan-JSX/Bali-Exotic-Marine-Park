<script setup>
import NavLink from "@/Components/NavLink.vue";
import { usePage } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import { computed } from "vue";

const page = usePage();
const props = defineProps({ status: Number, message: String });
const link = computed(()=>{
    return page?.props?.auth?.user ? route('dashboard') : route('home')
});
</script>

<template>
    <section class="relative min-h-screen overflow-hidden flex flex-col items-center justify-center bg-[#090b52]">
        <!-- Background Glow -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="glow"></div>
        </div>

        <!-- Circle -->
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>

        <!-- Decorative -->
        <div class="planet planet-left"></div>
        <div class="planet planet-right"></div>

        <span class="star star-1"></span>
        <span class="star star-2"></span>
        <span class="star star-3"></span>
        <span class="star star-4"></span>

        <!-- Content -->
        <div class="relative z-20 flex flex-col items-center">
            <div class="flex flex-col items-center px-10 py-12">
                <h1 class="text-8xl md:text-9xl font-black tracking-wider bg-gradient-to-r from-pink-200 via-fuchsia-400 to-pink-600 bg-clip-text text-transparent">
                    {{ props.status }}
                </h1>
                <img src="/assets/error-page.png" class="w-72 md:w-80 my-8 animate-spin [animation-duration:8s] select-none drop-shadow-[0_20px_60px_rgba(255,255,255,.15)]" />
                <p class="text-center text-xl md:text-2xl text-slate-200 font-second max-w-md leading-relaxed">
                    {{ props.message }}
                </p>
                <a :href="link" class="mt-10 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-pink-500 to-fuchsia-600 px-8 py-3 font-semibold text-white shadow-lg transition duration-300 hover:scale-105 hover:shadow-pink-500/40 active:scale-95">
                    Back
                </a>
            </div>
        </div>
    </section>
</template>

<style scoped>
.glow{
    width:900px;
    height:900px;
    border-radius:9999px;

    background:
    radial-gradient(circle,
    rgba(180,0,255,.65) 0%,
    rgba(120,0,220,.55) 35%,
    rgba(60,0,170,.35) 55%,
    rgba(10,15,90,0) 78%);

    animation: pulseGlow 6s ease-in-out infinite;
}

@keyframes pulseGlow {
    0%, 100% {
        transform: scale(1);
        opacity: 0.9;
    }
    50% {
        transform: scale(1.08);
        opacity: 1;
    }
}

/* ================= PLANET ================= */

.planet{
    position:absolute;
    border-radius:9999px;
    filter:blur(.3px);
    animation: floatPlanet 8s ease-in-out infinite;
}

.planet-left{
    width:250px;
    height:250px;
    background:#24148f;

    left:-110px;
    top:-80px;
    animation-delay: 0s;
}

.planet-right{
    width:190px;
    height:190px;
    background:#24148f;

    right:-70px;
    top:80px;
    animation-delay: 2s;
}

@keyframes floatPlanet {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    50% {
        transform: translate(20px, -25px) scale(1.05);
    }
}

/* ================= STAR ================= */

.star{
    position:absolute;
    width:8px;
    height:8px;
    border-radius:9999px;
    background:#ff4bd6;
    box-shadow:0 0 18px #ff4bd6;

    animation: twinkle 2.5s ease-in-out infinite;
}

@keyframes twinkle {
    0%, 100% {
        opacity: 0.3;
        transform: scale(0.8);
    }
    50% {
        opacity: 1;
        transform: scale(1.4);
    }
}

/* beda-beda timing biar natural */
.star-1 { left:18%; top:18%; animation-delay: 0s; }
.star-2 { right:22%; top:25%; animation-delay: .5s; }
.star-3 { left:28%; bottom:20%; animation-delay: 1s; }
.star-4 { right:30%; bottom:18%; animation-delay: 1.5s; }
</style>