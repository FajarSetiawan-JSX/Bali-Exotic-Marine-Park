<script setup>
import { ChevronUp, Copy, Check } from 'lucide-vue-next'
import { ref } from 'vue'

const copied = ref(false)
const props = defineProps(['api', 'baseUrl']);
const open = ref(false);
const methodStyle = {
    GET: 'bg-emerald-50 text-emerald-600',
    POST: 'bg-sky-50 text-sky-600',
    PATCH: 'bg-amber-50 text-amber-600',
    PUT: 'bg-amber-50 text-amber-600',
    DELETE: 'bg-red-50 text-red-600',
}

function copyUrl() {
    navigator.clipboard.writeText(props?.baseUrl + props?.api?.url)
    copied.value = true
    setTimeout(() => {
        copied.value = false
    }, 1500)
}
</script>

<template>
    <div class="w-full rounded-xl border border-sky-100 bg-white overflow-hidden">
        <button type="button" @click="open = !open" class="w-full flex items-start sm:items-center justify-between gap-3 px-4 sm:px-5 py-4 text-left">
            <div class="flex items-start sm:items-center gap-3 min-w-0 flex-wrap sm:flex-nowrap">
                <span class="shrink-0 rounded-md px-2.5 py-1 text-xs font-bold uppercase" :class="methodStyle[props?.api?.methode] || methodStyle.GET">
                    {{ props?.api?.methode }}
                </span>
                <div class="min-w-0">
                    <p class="text-sm sm:text-base font-semibold text-gray-800">{{ props?.api?.name }}</p>
                    <p class="text-xs sm:text-sm text-sky-500 truncate">{{ props?.api?.url }}</p>
                </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <span class="hidden sm:inline-flex rounded-md bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-500">
                    {{ props?.api?.scope }}
                </span>
                <span class="hidden sm:inline-flex rounded-md bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-500">
                    40 req / min
                </span>
                <ChevronUp class="h-4 w-4 text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': !open }"/>
            </div>
        </button>

        <Transition enter-active-class="transition-all duration-300 ease-out" enter-from-class="opacity-0 -translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition-all duration-200 ease-in" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-1">
            <div v-if="open" class="px-4 sm:px-5 pb-4 sm:pb-5">
                <div class="flex sm:hidden flex-wrap gap-2 mb-3">
                    <span class="rounded-md bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-500">
                        {{ props?.api?.scope }}
                    </span>
                    <span class="rounded-md bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-500">
                        ok
                    </span>
                </div>

                <p class="text-sm sm:text-base text-gray-600 leading-relaxed mb-3">
                    {{ props?.api?.description }}
                </p>

                <div class="flex items-center justify-between gap-2 rounded-md bg-gray-50 border border-gray-200 px-3 py-2.5">
                    <code class="text-xs sm:text-sm text-gray-600 truncate">
                        {{ props?.baseUrl }}{{ props?.api?.url }}
                    </code>
                    <button @click.stop="copyUrl" type="button" class="shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                        <Check v-if="copied" class="h-4 w-4 text-emerald-500" />
                        <Copy v-else class="h-4 w-4" />
                    </button>
                </div>
            </div>
        </Transition>
    </div>
</template>