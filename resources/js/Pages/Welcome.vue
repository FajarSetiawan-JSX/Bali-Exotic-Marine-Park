<script setup>
import Footer from '@/Components/footer.vue';
import Navbar from '@/Components/Navbar.vue';
import Feature from '@/Components/Welcome/Feature.vue';
import Hero from '@/Components/Welcome/Hero.vue';
import Work from '@/Components/Welcome/Work.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
const letters = [
    ...'Bali Exotic ',
    ...'Marine',
    ...' Park'
]
function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('hidden!');
    document.getElementById('docs-card')?.classList.add('row-span-1!');
    document.getElementById('docs-card-content')?.classList.add('flex-row!');
    document.getElementById('background')?.classList.add('hidden!');
}
const top = ref(false);
const btm = ref(false);
const bounce = ref(false);
onMounted(()=>{
    top.value = true;
    btm.value = true;
    bounce.value = true;
})
</script>

<template>
    <Head title="Welcome" />
    <Navbar />
    <!-- Hero Section -->
    <div class="flex flex-col items-center justify-center text-center bg-[url('/assets/hero-section-dot-image.png')] bg-cover bg-no-repeat bg-sky-100">
        <Transition name="slide-b">
            <a href="#" v-if="top" class="flex items-center gap-2 rounded-full p-1 pr-3 mt-44 text-indigo-600 bg-indigo-50">
                <span class="bg-indigo-600 text-white text-xs px-3.5 py-1 rounded-full">
                    NEW
                </span>
                <p class="flex items-center gap-1">
                    <span>Saas for easier management</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
                </p>
            </a>
        </Transition>
        <Transition name="slide-t">
            <h1 v-if="btm" class="text-4xl md:text-6xl font-semibold mt-4 inline-block max-w-max">
                <span
                    v-for="(letter, index) in letters"
                    :key="index"
                    class="letter inline-block font-title"
                >
                    {{ letter === ' ' ? '\u00A0' : letter }}
                </span>
            </h1>
        </Transition>
        <p data-aos="flip-up" class="text-base text-slate-600 max-w-lg mt-5 font-primary">Workflows that never miss. automation that helps your team do more, effortlessly.</p>
        <div class="flex items-center gap-4 mt-6">
            <button data-aos="fade-right" class="bg-indigo-600 hover:bg-indigo-700 transition px-8 py-3 rounded-md text-white">
                <span>Get Started</span>
            </button>
            <button data-aos="fade-left" class="flex items-center justify-center gap-2 border border-indigo-400 px-5 py-3 rounded-md text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles-icon lucide-sparkles"><path d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z"/><path d="M20 2v4"/><path d="M22 4h-4"/><circle cx="4" cy="20" r="2"/></svg>
                <span>AI Features</span>
            </button>
        </div>
        <Transition name="bounce">
            <Hero v-if="bounce" />
        </Transition>
        
    </div>

    <Feature id="fitur" />
    <Work id="cara" />

    <Footer />
</template>

<style scoped>
.letter {
    transition: all 0.1s ease;
}

.letter:hover {
    cursor: pointer;
    transform: translateY(-8px);
    color: #6366f1;
}

/*
  bawah ke atas
*/
.slide-b-enter-active {
  transition: all 0.8s ease-out;
}

.slide-b-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-b-enter-from,
.slide-b-leave-to {
  transform: translateY(40px);
  opacity: 0;
}

/*
  atas ke bawah
*/
.slide-t-enter-active {
  transition: all 0.8s ease-out;
}

.slide-t-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-t-enter-from,
.slide-t-leave-to {
  transform: translateY(-40px);
  opacity: 0;
}


.bounce-enter-active {
  animation: bounce-in 1s;
}
.bounce-leave-active {
  animation: bounce-in 1s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.10);
  }
  100% {
    transform: scale(1);
  }
}
</style>