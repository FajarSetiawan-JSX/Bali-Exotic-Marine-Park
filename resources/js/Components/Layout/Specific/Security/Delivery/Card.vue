<script setup>
import { Box,  Check,  CalendarDays,  Clock,  ArrowUpRight,  ArrowDownLeft,  ShieldCheck,  ArrowRight } from 'lucide-vue-next'
</script>

<template>
    <article class="w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="relative aspect-video w-full bg-slate-200 sm:aspect-[2/1]">
            <img src="/images/delivery.jpg" alt="Perlengkapan operasional" class="size-full object-cover"/>
            <div class="absolute inset-x-3 bottom-3 flex items-center justify-between gap-2 sm:inset-x-4 sm:bottom-4">
                <span class="inline-flex items-center gap-1.5 rounded-lg bg-white px-2.5 py-1.5 text-xs font-medium text-slate-700 shadow-sm sm:text-sm">
                    <Box class="size-3.5 sm:size-4" :stroke-width="1.75" />
                    Operasional
                </span>
                <span class="rounded-lg bg-white px-2.5 py-1.5 text-xs font-medium text-slate-700 shadow-sm sm:text-sm">
                    2 paket
                </span>
            </div>
        </div>
        <div class="p-4 sm:p-5 md:p-6">
            <div class="flex items-center justify-between gap-3">
                <p class="truncate text-xs text-slate-500 sm:text-sm">DLV-2026-0086</p>
                <span class="inline-flex shrink-0 items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 ring-1 ring-emerald-200 sm:text-sm">
                    <Check class="size-3.5 sm:size-4" :stroke-width="2.25" />
                    Diterima
                </span>
            </div>
            <h3 class="mt-3 text-base font-bold text-slate-900 sm:text-lg md:text-xl">
                Perlengkapan operasional
            </h3>
            <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-slate-500 sm:text-sm">
                <span class="inline-flex items-center gap-1.5">
                    <CalendarDays class="size-4" :stroke-width="1.75" />
                    10 Okt 2026
                </span>
                <span class="hidden text-slate-300 sm:inline">·</span>
                <span class="inline-flex items-center gap-1.5">
                    <Clock class="size-4" :stroke-width="1.75" />
                    08:24 WITA
                </span>
            </div>
            <div class="mt-5 space-y-4">
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600 sm:size-12">
                        <ArrowUpRight class="size-4 sm:size-5" :stroke-width="1.75" />
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500">Pengirim</p>
                        <p class="truncate text-sm font-semibold text-slate-900 md:text-base">
                            PT Bali Supply Indonesia
                        </p>
                        <p class="truncate text-xs text-slate-500">Supplier · Denpasar</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-teal-50 text-teal-700 sm:size-12">
                        <ArrowDownLeft class="size-4 sm:size-5" :stroke-width="1.75" />
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500">Penerima</p>
                        <p class="truncate text-sm font-semibold text-slate-900 md:text-base">
                            Ni Putu Ayu
                        </p>
                        <p class="truncate text-xs text-orange-800/70">Departemen Operasional</p>
                    </div>
                </div>
            </div>
            <div class="mt-5 flex items-center justify-between gap-3 border-t border-slate-200 pt-4">
                <div class="flex min-w-0 items-center gap-3">
                    <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-slate-100 text-xs font-semibold text-slate-500 sm:size-12 sm:text-sm">
                    MA
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500">Petugas</p>
                        <p class="flex items-center gap-1.5 text-sm font-semibold text-slate-900 md:text-base">
                            <span class="truncate">I Made Arya</span>
                            <ShieldCheck class="size-4 shrink-0 text-teal-600" :stroke-width="1.75" />
                        </p>
                    </div>
                </div>

                <button type="button" aria-label="Lihat detail pengiriman" class="flex size-10 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition hover:bg-slate-200 focus-visible:ring-2 focus-visible:ring-teal-500 focus-visible:outline-none sm:size-12">
                    <ArrowRight class="size-4 sm:size-5" :stroke-width="1.75" />
                </button>
            </div>
        </div>
    </article>
</template>
