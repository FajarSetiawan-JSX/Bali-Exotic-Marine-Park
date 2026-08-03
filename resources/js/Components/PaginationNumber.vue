<script setup>
import {
    ChevronLeft,
    ChevronRight,
} from 'lucide-vue-next'
</script>

<template>
    <div class="flex flex-col gap-4 rounded-[2rem] border border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8 lg:py-5">
        <p class="text-center text-xs text-slate-600 sm:text-sm lg:text-left">
            Showing
            <span class="font-semibold text-slate-900">
                1–3
            </span>
            of
            <span class="font-semibold text-slate-900">
                124
            </span>
            users
        </p>
        <div class="flex flex-wrap items-center justify-center gap-1">
            <button class="flex h-8 w-8 items-center justify-center rounded-full text-slate-500 transition hover:bg-slate-100 sm:h-9 sm:w-9 lg:h-10 lg:w-10">
                <ChevronLeft :size="16" class="lg:h-[18px] lg:w-[18px]" />
            </button>

            <button class="flex h-8 w-8 items-center justify-center rounded-full bg-[#0F3558] text-sm font-medium text-white shadow-md sm:h-9 sm:w-9 lg:h-10 lg:w-10">
                1
            </button>

            <button class="flex h-8 w-8 items-center justify-center rounded-full text-sm font-medium text-slate-700 transition hover:bg-slate-100 sm:h-9 sm:w-9 lg:h-10 lg:w-10">
                2
            </button>

            <button class="flex h-8 w-8 items-center justify-center rounded-full text-sm font-medium text-slate-700 transition hover:bg-slate-100 sm:h-9 sm:w-9 lg:h-10 lg:w-10">
                3
            </button>

            <span class="px-1 text-sm text-slate-400 sm:px-2">
                ...
            </span>

            <button class="flex h-8 w-8 items-center justify-center rounded-full text-sm font-medium text-slate-700 transition hover:bg-slate-100 sm:h-9 sm:w-9 lg:h-10 lg:w-10">
                42
            </button>

            <button class="flex h-8 w-8 items-center justify-center rounded-full text-slate-500 transition hover:bg-slate-100 sm:h-9 sm:w-9 lg:h-10 lg:w-10">
                <ChevronRight :size="16" class="lg:h-[18px] lg:w-[18px]" />
            </button>
        </div>
    </div>
</template>