<script setup>
import { ref } from 'vue'
import { Star, ChevronDown, Calendar, User, ShieldCheck, BadgeCheck, ScanLine } from 'lucide-vue-next'
import { formatTime } from '@/Helper/FormatTime';

const props = defineProps(['visitor']);
const showPurpose = ref(false);
const show = ref(false);
</script>

<template>
    <article class="w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
        <div class="p-4 sm:p-5 lg:p-6">
            <button type="button" @click="show = !show" class="flex items-start justify-between w-full">
                <div>
                    <h1 class="text-md font-second font-semibold">{{ props?.visitor?.name }}</h1>
                    <div class="flex items-start gap-x-2.5">
                        <div class="px-3 py-0.5 bg-slate-100 text-xs text-slate-500 rounded-sm flex items-center justify-between gap-x-2">
                            <User size="12" />
                            <span>{{ props.visitor.count ?? 1 }} person</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-start justify-center gap-x-2">
                    <div class="px-4 py-0.5 rounded-sm bg-emerald-100 text-emerald-400 text-sm">
                        {{ props?.visitor?.category }}
                    </div>
                    <div :class="show ? 'rotate-180' : ''" class="ml-3 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition">
                        <ChevronDown :size="20" />
                    </div>
                </div>
            </button>
            <Transition
                    enter-active-class="overflow-hidden transition-all duration-200"
                    enter-from-class="max-h-0 opacity-0"
                    enter-to-class="max-h-max opacity-100"
                    leave-active-class="overflow-hidden transition-all duration-150"
                    leave-from-class="max-h-max opacity-100"
                    leave-to-class="max-h-0 opacity-0"
                >
                <div v-if="show">
                    <div class="mt-5 grid grid-cols-2 gap-3 rounded-xl bg-slate-50 p-3 sm:grid-cols-3 sm:p-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Check-In Time
                            </p>
                            <p class="mt-1 text-sm font-semibold text-slate-700 sm:text-base">
                                {{ formatTime(props?.visitor?.time) }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Security Cleared
                            </p>

                            <div class="mt-1 flex items-center gap-1.5">
                                <ShieldCheck :size="14" class="text-emerald-500"/>
                                <p class="text-sm font-semibold text-emerald-600 sm:text-base">
                                    {{ props?.visitor?.user }}
                                </p>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Pass Type
                            </p>
                            <p class="mt-1 text-sm font-semibold text-slate-700 sm:text-base">
                                {{ props?.visitor?.category }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="button" @click="showPurpose = !showPurpose" class="flex w-full items-center justify-between rounded-xl border border-slate-200 bg-white px-3 py-3 text-left transition hover:bg-slate-50 sm:px-4">
                            <div class="min-w-0">
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Detail Visit Purpose
                                </p>
                            </div>
                            <div :class="showPurpose ? 'rotate-180' : ''" class="ml-3 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-50 text-slate-500 transition">
                                <ChevronDown :size="17" />
                            </div>
                        </button>
                        <Transition
                            enter-active-class="overflow-hidden transition-all duration-200"
                            enter-from-class="max-h-0 opacity-0"
                            enter-to-class="max-h-96 opacity-100"
                            leave-active-class="overflow-hidden transition-all duration-150"
                            leave-from-class="max-h-96 opacity-100"
                            leave-to-class="max-h-0 opacity-0"
                        >
                            <div v-if="showPurpose" class="mt-2 rounded-xl border border-slate-200 bg-slate-50 p-3 sm:p-4">
                                <p class="text-sm leading-6 text-slate-600">
                                    {{ props?.visitor?.information }}
                                </p>
                                <img :src="`/storage/${props?.visitor?.img}`" alt="" class="w-64 h-80 mx-auto object-contain my-5">
                            </div>
                        </Transition>
                    </div>
                </div>
            </Transition>
            <div class="mt-4 flex flex-col gap-3 border-t border-slate-100 pt-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="inline-flex w-fit items-center gap-1.5 rounded-md border border-emerald-100 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">
                    <BadgeCheck :size="14" />
                    Checked
                </div>
            </div>
        </div>
        <footer class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-4 py-3 sm:flex-row sm:items-center sm:justify-end sm:px-5">
            <div class="flex items-start justify-center gap-x-2 text-slate-500">
                <Calendar size="20" />
                {{ props?.visitor?.date }}
            </div>
        </footer>
    </article>
</template>