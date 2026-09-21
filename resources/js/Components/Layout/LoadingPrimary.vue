<script setup>
import { computed } from 'vue'

const props = defineProps({
    text: {
        type: String,
        default: 'Loading',
    },
    size: {
        type: String,
        default: 'md',
        validator: (value) => ['sm', 'md', 'lg'].includes(value),
    },
})

const sizeClasses = computed(() => {
    return {
        sm: {
            text: 'text-sm',
            bar: 'h-[2px] w-24',
            wrapper: 'gap-2',
        },
        md: {
            text: 'text-base',
            bar: 'h-[3px] w-32',
            wrapper: 'gap-3',
        },
        lg: {
            text: 'text-lg',
            bar: 'h-[3px] w-40',
            wrapper: 'gap-3',
        },
    }[props.size]
})

const letters = computed(() => props.text.split(''))
</script>

<template>
    <div
        class="generating-loader-wrapper flex flex-col items-center justify-center"
        :class="sizeClasses.wrapper"
        role="status"
        aria-live="polite"
    >
        <div
            class="generating-loader-text flex items-center font-medium tracking-wide text-slate-700"
            :class="sizeClasses.text"
            aria-hidden="true"
        >
            <span
                v-for="(letter, index) in letters"
                :key="`${letter}-${index}`"
                class="generating-loader-letter inline-block"
                :style="{ animationDelay: `${index * 0.08}s` }"
            >
                {{ letter }}
            </span>
        </div>

        <div
            class="generating-loader-bar relative overflow-hidden rounded-full bg-slate-200"
            :class="sizeClasses.bar"
            aria-hidden="true"
        >
            <span
                class="absolute inset-y-0 w-1/2 rounded-full bg-slate-700"
            />
        </div>

        <span class="sr-only">{{ text }}...</span>
    </div>
</template>

<style scoped>
.generating-loader-letter {
    opacity: 0;
    transform: translateY(20px) rotateX(-90deg);
    text-shadow: 0 0 0 rgba(15, 23, 42, 0);
    animation: generating-loader-letter-anim 2s ease-in-out infinite;
    transform-origin: center bottom;
}

.generating-loader-bar > span {
    left: -50%;
    animation: generating-loader-bar-anim 1.8s ease-in-out infinite;
}

@keyframes generating-loader-letter-anim {
    0% {
        opacity: 0;
        transform: translateY(20px) rotateX(-90deg);
        text-shadow: 0 0 0 rgba(15, 23, 42, 0);
    }

    10% {
        opacity: 1;
        transform: translateY(0) rotateX(0deg);
        text-shadow: 0 0 8px rgba(15, 23, 42, 0.2);
    }

    30% {
        opacity: 1;
        transform: translateY(0) rotateX(0deg);
        text-shadow: 0 0 8px rgba(15, 23, 42, 0.2);
    }

    50% {
        opacity: 0;
        transform: translateY(-20px) rotateX(90deg);
        text-shadow: 0 0 0 rgba(15, 23, 42, 0);
    }

    100% {
        opacity: 0;
        transform: translateY(-20px) rotateX(90deg);
    }
}

@keyframes generating-loader-bar-anim {
    0% {
        left: -50%;
    }

    50% {
        left: 100%;
    }

    100% {
        left: -50%;
    }
}

@media (prefers-reduced-motion: reduce) {
    .generating-loader-letter,
    .generating-loader-bar > span {
        animation: none;
    }

    .generating-loader-letter {
        opacity: 1;
        transform: none;
    }

    .generating-loader-bar > span {
        left: 25%;
    }
}
</style>