<script setup>
import { ChevronDown, KeyRound, Globe, Shield, Clock,CircleCheck, Layers } from 'lucide-vue-next';
import { ref } from 'vue';

const open = ref(null)
const props = defineProps(['page']);
function toggle(id) {
    open.value = open.value === id ? null : id
}
</script>

<template>
    <div class="rounded-xl border border-gray-200 bg-white divide-y divide-gray-100 overflow-hidden">
        <button type="button" @click="open = !open" class="w-full flex items-center gap-3 px-4 sm:px-5 py-4 hover:bg-gray-50 transition-colors">
            <div class="shrink-0 h-9 w-9 rounded-lg flex items-center justify-center bg-emerald-100">
                <Globe class="h-4 w-4 text-emerald-400" />
            </div>
            <div class="flex-1 min-w-0 text-left">
                <p class="text-sm sm:text-base font-semibold text-gray-800">{{ props?.page?.name }}</p>
            </div>
            <ChevronDown class="h-4 w-4 text-gray-400 shrink-0 transition-transform duration-300" :class="open ? 'rotate-180' : 'rotate-0'"/>
        </button>
        <Transition enter-active-class="transition-all duration-300 ease-out" enter-from-class="opacity-0 -translate-y-1 max-h-0" enter-to-class="opacity-100 translate-y-0 max-h-96" leave-active-class="transition-all duration-200 ease-in" leave-from-class="opacity-100 translate-y-0 max-h-96" leave-to-class="opacity-0 -translate-y-1 max-h-0">
            <div v-if="open" class="overflow-hidden bg-gray-50 px-4 sm:px-5 py-4">

                <p class="text-sm text-gray-600 leading-relaxed mb-4">
                    {{ props?.page?.description }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="flex items-center gap-2 rounded-lg bg-white border border-gray-200 px-3 py-2.5">
                        <Shield class="h-4 w-4 text-gray-400 shrink-0" />
                        <div class="min-w-0">
                            <p class="text-xs text-gray-400">Method</p>
                            <p v-if="props?.page?.methode == 'GET'" class="text-sm font-medium text-emerald-600">{{ props?.page?.methode }}</p>
                            <p v-if="props?.page?.methode == 'POST'" class="text-sm font-medium text-sky-600">{{ props?.page?.methode }}</p>
                            <p v-if="props?.page?.methode == 'PATCH'" class="text-sm font-medium text-amber-600">{{ props?.page?.methode }}</p>
                            <p v-if="props?.page?.methode == 'DELETE'" class="text-sm font-medium text-red-600">{{ props?.page?.methode }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 rounded-lg bg-white border border-gray-200 px-3 py-2.5">
                        <Clock class="h-4 w-4 text-gray-400 shrink-0" />
                        <div class="min-w-0">
                            <p class="text-xs text-gray-400">Rate Limit</p>
                            <p class="text-sm font-medium text-gray-700">40 req/min</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 rounded-lg bg-white border border-gray-200 px-3 py-2.5">
                        <KeyRound v-if="props?.page?.scope == 'Super Admin'" class="h-4 w-4 text-sky-400 shrink-0" />
                        <Layers v-if="props?.page?.scope == 'General'" class="h-4 w-4 text-purple-400 shrink-0" />
                        <CircleCheck v-if="props?.page?.scope == 'Specific'" class="h-4 w-4 text-emerald-400 shrink-0" />
                        <div class="min-w-0">
                            <p class="text-xs text-gray-400">Scope</p>
                            <p class="text-sm font-medium text-gray-700 truncate">{{ props?.page?.scope }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>