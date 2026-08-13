```vue
<script setup>
import { computed, useAttrs } from 'vue'
import { Search, LoaderCircle, User } from 'lucide-vue-next'
import { ref, watch } from 'vue'

const internalLoading = ref(false);
let timer
const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
    placeholder: {
        type: String,
        default: 'Search name',
    },
    loading: {
        type: Boolean,
        default: false,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    error: {
        type: Boolean,
        default: false,
    },
})

const emit = defineEmits([
    'update:modelValue',
    'focus',
    'blur',
    'enter',
])

const attrs = useAttrs()

const value = computed({
    get() {
        return props.modelValue
    },
    set(val) {
        emit('update:modelValue', val)
    },
})

function onEnter() {
    emit('enter')
}


watch(value, (val) => {
    clearTimeout(timer)

    if (!val) {
        internalLoading.value = false
        return
    }

    internalLoading.value = true

    timer = setTimeout(() => {
        internalLoading.value = false
    }, 500)
})
</script>

<template>
    <div class="relative">
        <!-- Left Icon -->
        <div
            class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"
        >
            <LoaderCircle
                v-if="loading || internalLoading"
                class="animate-spin"
                :size="18"
                role="status"
            />

            <Search
                v-else
                :size="18"
                aria-hidden="true"
            />
        </div>

        <!-- Input -->
        <input
            v-bind="attrs"
            v-model="value"
            :placeholder="placeholder"
            :disabled="disabled"
            class="
                rounded-xl
                border
                border-slate-200
                bg-white
                pl-10
                pr-10
                text-sm
                text-slate-700
                placeholder:text-slate-400
                shadow-sm
                transition-all
                duration-200
                outline-none

                hover:border-slate-300

                focus:border-indigo-500
                focus:ring-4
                focus:ring-indigo-500/15

                disabled:cursor-not-allowed
                disabled:bg-slate-100
                disabled:text-slate-400
            "
            :class="{
                'border-red-500 focus:border-red-500 focus:ring-red-500/15': error,
            }"
            @focus="emit('focus', $event)"
            @blur="emit('blur', $event)"
            @keyup.enter="onEnter"
        />

        <!-- Right Icon -->
        <div
            class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400"
        >
            <User
                :size="18"
                aria-hidden="true"
            />
        </div>
    </div>
</template>