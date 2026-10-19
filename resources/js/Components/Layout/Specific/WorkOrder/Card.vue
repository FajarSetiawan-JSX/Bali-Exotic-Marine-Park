<script setup>
import { ShieldAlert, Check, CalendarDays, ArrowRight, TriangleAlert, CirclePlus, Clock, CircleX } from "lucide-vue-next";
import { formatDate } from "@/Helper/FormatDate";

const props = defineProps(['order']);
</script>

<template>
    <div class="w-full max-w-sm overflow-hidden rounded-xl border border-sky-100 bg-white shadow-sm">
        <div class="relative flex h-40 justify-center bg-sky-50 sm:h-48 lg:h-52">
            <img :src="props?.order?.img ? `/storage/${props?.order?.img}` : 'assets/emptycard.jpg'" alt="item" class="w-full object-cover" />
            <template v-if="props?.order?.status == 'Ganti'">
                <span class="absolute left-3 top-3 flex items-center gap-1.5 rounded-md bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-500 sm:text-sm">
                    <ShieldAlert class="size-3.5 sm:size-4" /> {{ props?.order?.status }}
                </span>
            </template>
            <template v-else-if="props?.order?.status == 'Maintenance'">
                <span class="absolute left-3 top-3 flex items-center gap-1.5 rounded-md bg-yellow-50 px-2.5 py-1 text-xs font-semibold text-yellow-500 sm:text-sm">
                    <TriangleAlert class="size-3.5 sm:size-4" /> {{ props?.order?.status }}
                </span>
            </template>
            <template v-else>
                <span class="absolute left-3 top-3 flex items-center gap-1.5 rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-500 sm:text-sm">
                    <CirclePlus class="size-3.5 sm:size-4" /> {{ props?.order?.status }}
                </span>
            </template>
        </div>

        <div class="p-4 sm:p-5 lg:p-6">
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500 sm:text-sm">WO-2026-024</span>
                <template v-if="props?.order?.confirm == 'waiting'">
                    <span class="flex items-center gap-1.5 rounded-md bg-orange-50 px-2.5 py-1 text-xs font-semibold text-orange-600 sm:text-sm">
                        <Clock class="size-3.5 sm:size-4" /> {{ props?.order?.confirm }}
                    </span>
                </template>
                <template v-else-if="props?.order?.confirm == 'confirmed'">
                    <span class="flex items-center gap-1.5 rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600 sm:text-sm">
                        <Check class="size-3.5 sm:size-4" /> {{ props?.order?.confirm }}
                    </span>
                </template>
                <template v-else>
                    <span class="flex items-center gap-1.5 rounded-md bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-600 sm:text-sm">
                        <CircleX class="size-3.5 sm:size-4" /> {{ props?.order?.confirm }}
                    </span>
                </template>
            </div>

            <h3 class="mt-4 text-base font-bold text-slate-800 sm:text-lg lg:text-xl">{{ props?.order?.item }}</h3>
            <p class="mt-2 text-xs leading-6 text-slate-500 sm:text-sm lg:leading-7">
                {{ props?.order?.remark ?? '' }}
            </p>

            <div class="mt-6 flex items-center gap-3 border-t border-slate-200 pt-5">
                <img :src="props?.order?.officer?.profile ? `/storage/${props?.order?.officer?.profile}` : `https://ui-avatars.com/api/?background=2DD4BF&color=fff&name=${props?.order?.officer?.name}`" class="flex size-9 shrink-0 items-center justify-center rounded-full bg-sky-100 text-xs font-bold text-sky-500 sm:size-10 sm:text-sm"/>
                <div>
                    <p class="text-xs font-semibold text-slate-800 sm:text-sm">{{ props?.order?.officer?.name }}</p>
                    <p class="text-xs text-slate-500">{{ props?.order?.officer?.position }} · {{ props?.order?.officer?.division }}</p>
                </div>
            </div>

            <div class="mt-5 flex items-center justify-between">
                <span class="flex items-center gap-1.5 text-xs text-slate-500 sm:text-sm">
                    <CalendarDays class="size-3.5 sm:size-4" /> {{ formatDate(props?.order?.officer?.date?.date) }}
                </span>
                <a href="#" class="flex items-center gap-1.5 text-xs font-semibold text-sky-500 sm:text-sm lg:text-base">
                    Lihat detail <ArrowRight class="size-4 sm:size-5" />
                </a>
            </div>
        </div>
    </div>
</template>