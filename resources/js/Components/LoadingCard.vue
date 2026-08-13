<script setup>
import { Rocket, Zap } from 'lucide-vue-next'

const props = defineProps({
    title: {
        type: String,
        default: 'Fetching data',
    },

    subtitle: {
        type: String,
        default: 'Please wait until the process is complete',
    },

    icon: {
        type: Object,
        default: () => Rocket,
    },
})

const codeLines = [
    { id: 1, width: '100%' },
    { id: 2, width: '82%' },
    { id: 3, width: '55%' },
    { id: 4, width: '92%' },
    { id: 5, width: '68%' },
    { id: 6, width: '88%' },
    { id: 7, width: '48%' },
]
</script>
<template>
    <div class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-gradient-to-br from-white via-slate-50 to-indigo-50 shadow-lg transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl">
        <!-- Glow -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 via-transparent to-sky-400/5"/>
        <div class="absolute -top-24 -right-24 size-72 rounded-full bg-indigo-500/10 blur-[120px]"/>
        <div class="absolute -bottom-24 -left-24 size-64 rounded-full bg-sky-400/10 blur-[120px]"/>
        <!-- Content -->
        <div class="relative p-6">
            <!-- Fake Editor -->
            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white/80 p-5 backdrop-blur-sm">
                <!-- Window -->
                <div class="mb-5 flex items-center gap-2">
                    <div class="size-2.5 rounded-full bg-red-400"/>

                    <div class="size-2.5 rounded-full bg-yellow-400"/>

                    <div class="size-2.5 rounded-full bg-green-400"/>

                </div>

                <!-- Code -->

                <div class="space-y-3">

                    <div
                        v-for="line in codeLines"
                        :key="line.id"
                        class="code-line"
                        :style="{ width: line.width }"
                    />

                </div>

                <!-- Icon -->

                <div class="absolute inset-0 flex items-center justify-center">

                    <div class="flex size-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 to-sky-500 ring-8 ring-white shadow-xl shadow-indigo-500/40 transition-all duration-500 group-hover:-translate-y-2 group-hover:rotate-6 group-hover:scale-110">

                        <component :is="icon" class="size-8 text-white"/>

                    </div>

                </div>

            </div>

            <!-- Footer -->

            <div class="mt-6 flex items-center justify-between">

                <div>

                    <h3 class="text-xl font-bold text-slate-900">
                        {{ title }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        {{ subtitle }}
                    </p>

                </div>

                <div class="rounded-xl bg-indigo-100 p-2 transition-all duration-300 group-hover:rotate-12 group-hover:bg-indigo-200">

                    <Zap class="size-5 text-indigo-600"/>

                </div>

            </div>

        </div>

    </div>
</template>

<style scoped>
.code-line {
    position: relative;
    height: 10px;
    overflow: hidden;
    border-radius: 9999px;

    background: linear-gradient(
        90deg,
        rgb(226 232 240),
        rgb(203 213 225),
        rgb(226 232 240)
    );

    transition: all .35s ease;
}

.code-line::after {
    content: '';

    position: absolute;
    inset: 0;

    background: linear-gradient(
        90deg,
        transparent,
        rgba(255,255,255,.9),
        transparent
    );

    transform: translateX(-100%);
    animation: shimmer 2s linear infinite;
}

.group:hover .code-line {
    background: linear-gradient(
        90deg,
        rgb(199 210 254),
        rgb(129 140 248),
        rgb(199 210 254)
    );

    transform: translateX(3px);
}

.group:hover .code-line:nth-child(odd) {
    transform: translateX(-3px);
}

.group:hover .code-line:nth-child(even) {
    transform: translateX(3px);
}

.group:hover .rounded-2xl.bg-gradient-to-br {
    animation: float 2.5s ease-in-out infinite;
}

@keyframes shimmer {

    100% {
        transform: translateX(100%);
    }

}

@keyframes float {

    0%,
    100% {
        transform: translateY(0) rotate(0deg) scale(1);
    }

    50% {
        transform: translateY(-8px) rotate(6deg) scale(1.06);
    }

}
</style>