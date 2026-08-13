<script setup>
import { formatTime } from "@/Helper/FormatTime.js";
import { diffHours } from "@/Helper/Hours.js";
import { Clock3, Pencil, BriefcaseBusiness, Coffee } from "lucide-vue-next";

const props = defineProps(['time']);
const emit = defineEmits(['update']);

const handleUpdate = () => {
    emit('update', props?.time);
}
</script>

<template>
    <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="flex items-start gap-4">
                <div data-aos="zoom-in" class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-950">
                    <Clock3 class="h-6 w-6 text-white" />
                </div>

                <div>
                    <h2 data-aos="fade-up" class="font-semibold text-slate-900">
                        {{ props?.time?.name }}
                    </h2>

                    <p data-aos="fade-down" class="mt-1 text-sm text-slate-500">
                        Standard <span class="text-slate-800">{{ props?.time?.name }}</span> schedule configuration for full-time employees.
                    </p>
                </div>
            </div>

            <button type="button" @click="handleUpdate" class="flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 transition hover:bg-slate-100">
                <Pencil class="h-4 w-4 text-slate-600" />
            </button>
        </div>
        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">
            <div data-aos="fade-left" class="flex items-center gap-4 rounded-xl border border-slate-200 bg-slate-50 p-5">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-sky-950">
                    <BriefcaseBusiness class="h-6 w-6 text-white" />
                </div>

                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-500">
                        Work Duration
                    </p>

                    <h3 class="text-2xl font-bold text-slate-900">
                        {{ diffHours(props?.time?.start, props?.time?.end) || 0 }} Hours
                    </h3>

                    <p class="text-xs uppercase tracking-wide text-slate-400">
                        {{ formatTime(props?.time?.start) }} - {{ formatTime(props?.time?.end) }}
                    </p>
                </div>
            </div>
            <div data-aos="fade-right" class="flex items-center gap-4 rounded-xl border border-slate-200 bg-slate-50 p-5">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-white shadow-sm">
                    <Coffee class="h-6 w-6 text-slate-700" />
                </div>

                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-500">
                        Break Duration
                    </p>

                    <h3 class="text-2xl font-bold text-slate-900">
                        {{ props?.time?.break_start && props?.time?.break_end ? diffHours(props?.time?.break_start, props?.time?.break_end) : 0 }} Hour
                    </h3>

                    <p class="text-xs uppercase tracking-wide text-slate-400">
                        {{ formatTime(props?.time?.break_start) }} - {{ formatTime(props?.time?.break_end) }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>