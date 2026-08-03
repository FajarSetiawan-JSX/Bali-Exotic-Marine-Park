<script setup>
import { computed } from 'vue'

const props = defineProps({
    bars: {
        type: Number,
        default: 5,
    },

    color: {
        type: String,
        default: 'bg-cyan-500',
    },

    size: {
        type: String,
        default: 'md',
    },

    speed: {
        type: Number,
        default: 1,
    },

    message: {
        type: String,
        default: '',
    },

    messagePlacement: {
        type: String,
        default: 'bottom',
    },
})

const sizes = {
    xs: 'w-1 h-3',
    sm: 'w-1.5 h-4',
    md: 'w-2 h-5',
    lg: 'w-3 h-7',
    xl: 'w-4 h-10',
}

const wrapperClass = computed(() => {
    switch (props.messagePlacement) {
        case 'left':
            return 'flex flex-row-reverse items-center gap-3'
        case 'right':
            return 'flex flex-row items-center gap-3'
        default:
            return 'flex flex-col items-center gap-3'
    }
})
</script>

<template>
    <div :class="wrapperClass">
        <div class="flex items-end justify-center gap-1">
            <div
                v-for="i in bars"
                :key="i"
                :class="[sizes[size], color]"
                class="rounded-full origin-bottom wave-loader"
                :style="{
                    animationDelay: `${(i - 1) * 0.1}s`,
                    animationDuration: `${speed}s`
                }"
            />
        </div>

        <p
            v-if="message"
            class="text-sm text-slate-500"
        >
            {{ message }}
        </p>
    </div>
</template>

<style scoped>
.wave-loader {
    animation: wave infinite ease-in-out;
}

@keyframes wave {
    0%,100%{
        transform:scaleY(1);
    }

    50%{
        transform:scaleY(1.8);
    }
}
</style>