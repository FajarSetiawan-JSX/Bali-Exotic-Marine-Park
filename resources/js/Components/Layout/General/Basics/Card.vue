<script setup>
import { ChevronDown, ChevronUp, Clock3, User, MapPin, X, AlertTriangle, Check, ShieldCheck, ClipboardCheck, Eye } from 'lucide-vue-next';
import { ref } from 'vue';
import { formatTime } from '@/Helper/FormatTime';
import { formatDateTime } from '@/Helper/FormatDateTime';
import Menu from '@/Components/Menu.vue';

const props = defineProps(['basic']);
const isOpen = ref(false);
</script>

<template>
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition" :class="isOpen ? 'ring-1 ring-slate-200' : ''">
        <button @click="isOpen = !isOpen" type="button" class="w-full text-left">
            <div class="flex flex-col gap-4 px-4 py-4 sm:px-5">
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-cyan-100 bg-cyan-50 text-cyan-600">
                        <Clock3 :size="18" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                            <span class="rounded-md bg-cyan-50 px-2 py-1 text-xs font-semibold text-cyan-600">
                                {{ props?.basic?.time?.name }}
                            </span>
                            <span class="hidden text-slate-300 sm:inline">
                                •
                            </span>
                            <span class="inline-flex items-center gap-1 text-xs text-slate-400">
                                <User :size="11" />
                                Officer:
                                <strong class="text-slate-600">
                                    {{ props?.basic?.user }}
                                </strong>
                            </span>
                        </div>
                        <h3 class="mt-1 text-xs font-bold text-slate-800 sm:text-sm">
                            {{ props?.basic?.division }}
                        </h3>
                    </div>
                    <div class="flex shrink-0 items-center gap-2">
                        <span class="hidden rounded-full border border-amber-200 bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-600 sm:inline-flex">
                            • 1 Issue Detected
                        </span>

                        <span class="hidden rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600 sm:inline-flex">
                            • No Issue / Clear
                        </span>

                        <span class="hidden rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600 md:inline-flex">
                            Completed
                        </span>

                        <div :class="isOpen ? 'bg-slate-100 text-slate-600' : ''" class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-50 text-slate-400 transition">
                            <ChevronUp v-if="isOpen" :size="15"/>
                            <ChevronDown v-else :size="15"/>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-2 pl-[52px] sm:hidden">
                    <span class="rounded-full border border-amber-200 bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-600">
                        • 2 Issue Detected
                    </span>
                    <span class="rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">
                        • No Issue / Clear
                    </span>
                    <span class="rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">
                        Completed
                    </span>
                </div>
            </div>
        </button>

        <!-- DROPDOWN CONTENT -->
        <Transition enter-active-class="transition-all duration-300 ease-out" enter-from-class="opacity-0 -translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition-all duration-200 ease-in" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-1" >
            <div v-if="isOpen" class="overflow-hidden border-t border-slate-100 bg-slate-50/60">
                <div class="grid gap-2 p-4 sm:p-5 lg:grid-cols-2">
                    <div class="rounded-xl border border-slate-200 bg-white p-4">
                        <div class="mb-3 flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Shift & Method
                            </span>

                            <Clock3 :size="14" class="text-slate-300"/>
                        </div>

                        <div class="space-y-2.5">
                            <div>
                                <div class="text-xs text-slate-400">
                                    Date
                                </div>
                                <div class="mt-0.5 text-xs font-medium text-slate-700">
                                    {{ formatTime(props?.basic?.date?.date) }}
                                </div>
                            </div>
                            <div>
                                <div class="text-xs text-slate-400">
                                    Shift Patrol
                                </div>
                                <div class="mt-0.5 text-xs font-medium text-slate-700">
                                    {{ formatTime(props?.basic?.time?.start) }} - {{ formatTime(props?.basic?.time?.end) }}
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="rounded-lg bg-slate-50 p-2">
                                    <div class="text-xs text-slate-400">
                                        Total Patrol Area
                                    </div>
                                    <div class="mt-0.5 flex gap-1 text-xs font-medium text-slate-700">
                                        <MapPin :size="11" class="mt-0.5 shrink-0 text-slate-400"/>
                                        0 / 5
                                    </div>
                                </div>
                                <div class="rounded-lg bg-slate-50 p-2">
                                    <div class="text-xs text-slate-400">
                                        Suprvisor
                                    </div>
                                    <div class="mt-1 flex items-center gap-1 text-xs font-semibold text-emerald-600">
                                        <User :size="10" />
                                        {{ props?.basic?.supervisor }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-xl border border-slate-200 bg-white p-4">
                        <div class="mb-3 flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Handover Received
                            </span>
                            <ShieldCheck :size="15" class="text-emerald-500"/>
                        </div>

                        <div class="space-y-2.5">
                            <div>
                                <div class="text-xs text-slate-400">
                                    Received
                                </div>
                                <template  v-if="props?.basic?.handover">
                                    <Check size="15" class="text-emerald-400 mt-0.5" />
                                </template>
                                <template v-else>
                                    <X size="15" class="text-red-500 mt-0.5" />
                                </template>
                            </div>
                            <div>
                                <div class="text-xs text-slate-400">
                                    Detail
                                </div>
                                <div class="mt-0.5 text-xs leading-4 text-slate-600">
                                    {{ props?.basic?.detail ?? '' }}
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-2 text-xs font-semibold text-emerald-600">
                                <Check :size="11" />
                                Handover Verified by Duty Supervisor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-4 mb-4 rounded-xl border border-amber-200 bg-amber-50 p-3 sm:mx-5 sm:mb-5">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex gap-2.5">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                                <AlertTriangle :size="15" />
                            </div>
                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="rounded bg-amber-200 px-1.5 py-0.5 text-xs font-bold uppercase text-amber-700">
                                        Outstanding Issue
                                    </span>
                                </div>
                                <p class="mt-1 text-xs leading-4 text-amber-800">
                                    <strong>Issue Detail:</strong>
                                    test
                                </p>
                            </div>
                        </div>
                        <button type="button" class="inline-flex shrink-0 items-center justify-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-600 shadow-sm transition hover:bg-slate-50">
                            <ClipboardCheck :size="12" />
                            View Maintenance Ticket
                        </button>
                    </div>
                </div>
                <div class="flex flex-col gap-2 border-t border-slate-200 px-4 py-3 sm:flex-row sm:items-center sm:justify-between sm:px-5">
                    <p class="text-xs font-primary text-slate-500">{{ formatDateTime(props?.basic?.tanggal) }}</p>
                    <Menu :href="route('daily.basic.detail', props?.basic?.id)" class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 active:scale-95 transition-all duration-300">
                        <Eye :size="12" />
                        View Progress
                    </Menu>
                </div>
            </div>
        </Transition>
    </div>
</template>

<style scoped>
.nested-enter-active,
.nested-leave-active {
    transition: all 0.3s ease-in-out;
}

.nested-enter-active .menu-item,
.nested-leave-active .menu-item {
    transition: all 0.3s ease-in-out;
}

/* ENTER */
.nested-enter-from .menu-item {
    opacity: 0;
    transform: translateY(20px);
}

.nested-enter-active .menu-item:nth-child(2) {
    transition-delay: 300ms;
}


/* LEAVE (dari bawah ke atas) */
.nested-leave-to .menu-item {
    opacity: 0;
    transform: translateY(20px);
}

.nested-leave-active .menu-item:nth-child(1) {
    transition-delay: 300ms;
}

.nested-leave-active .menu-item:nth-child(2) {
    transition-delay: 0ms;
}
</style>