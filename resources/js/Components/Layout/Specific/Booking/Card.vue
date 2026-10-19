<script setup>
import { Phone, Calendar, Globe, ChevronDown, ChevronUp, Info, Mail } from "lucide-vue-next";
import { ref } from "vue";
import { formatDateTime } from "@/Helper/FormatDateTime";
import { formatRupiah } from "@/Helper/Rupiah";

const props = defineProps(['booking']);
const open = ref(false);
</script>

<template>
    <div class="w-full overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm font-second">
        <button type="button" @click="open = !open" class="flex w-full flex-col gap-3 px-4 py-4 text-left sm:px-6 lg:flex-row lg:items-center lg:gap-8">
            <div class="flex items-center gap-3 lg:w-48">
                <span class="h-9 w-1.5 shrink-0 rounded-full bg-emerald-500"/>
                <div>
                    <p class="text-xs text-gray-400">Booking Name</p>
                    <p class="text-sm font-semibold">{{ props?.booking?.name }}</p>
                </div>
            </div>
            <div class="grid flex-1 grid-cols-2 gap-3 lg:gap-8">
                <div>
                    <p class="text-xs text-gray-400">Contact Number</p>
                    <p class="flex items-center gap-1.5 text-sm text-gray-600">
                        <template v-if="props?.booking?.mail">
                            <Mail class="size-4" />
                        </template>
                        <template v-else>
                            <Phone class="size-4" />
                        </template>
                        {{ props?.booking?.contact }}
                    </p>
                </div>
                <div class="col-span-2 lg:col-span-1">
                    <p class="text-xs text-gray-400">Activity Date</p>
                    <p class="flex items-center gap-1.5 text-sm text-gray-600"><Calendar class="size-4" />{{ props?.booking?.activity }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm font-medium text-blue-500">
                <Globe class="size-4" />{{ props?.booking?.methode }}
                <component :is="open ? ChevronUp : ChevronDown" class="size-4 text-gray-400" />
            </div>
        </button>

        <Transition enter-active-class="transition-all duration-200 ease-out" enter-from-class="opacity-0 -translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition-all duration-150 ease-in" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-1">
            <div v-if="open" class="border-t border-gray-100">
                <div class="grid grid-cols-1 gap-6 px-4 py-5 sm:px-6 lg:grid-cols-[minmax(0,1fr)_2fr]">
                    <div class="space-y-5 text-sm">
                        <div class="space-y-3">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Information</p>
                            <div><p class="text-xs text-gray-400">Contact</p><p>{{ props?.booking?.contact }}</p></div>
                            <div>
                                <p class="text-xs text-gray-400">Payment</p>
                                <p>{{ props?.booking?.payment }}</p>
                                <p class="text-base font-bold">{{ formatRupiah(props?.booking?.total) }}</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Officer & Guide</p>
                            <div><p class="text-xs text-gray-400">Officer</p><p>{{ props?.booking?.author }}</p></div>
                            <div><p class="text-xs font-semibold text-emerald-600">Supervisor</p><p>{{ props?.booking?.spv }}</p></div>
                            <div><p class="text-xs font-semibold text-indigo-600">Guide</p><p>{{ props?.booking?.guide?.name }}</p></div>
                        </div>
                    </div>

                    <div>
                        <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-400">Ordered Programs</p>
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="w-full min-w-[420px] text-left">
                                <thead class="bg-gray-50 text-xs uppercase text-gray-400">
                                    <tr><th class="px-4 py-3 font-semibold">Program</th><th class="px-4 py-3 font-semibold">Session</th><th class="px-4 py-3 font-semibold">Price</th></tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm">
                                    <tr v-for="order in props?.booking?.order">
                                        <td class="px-4 py-3 font-semibold">{{ order?.program }}</td>
                                        <td class="px-4 py-3"><p class="text-xs text-gray-400">{{ order?.session }}</p></td>
                                        <td class="px-4 py-3"><p class="text-xs text-gray-600">{{ formatRupiah(order?.price) }}</p></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-4 border-t border-gray-100 bg-amber-50/50 px-4 py-3 sm:px-6">
                    <p class="flex items-start gap-2 text-xs text-amber-700 sm:text-sm">
                        <Info class="mt-0.5 size-4 shrink-0" />
                        <span><b>Catatan Khusus:</b> Tamu butuh life jacket ukuran M & S, tiba 15 menit sebelum briefing.</span>
                    </p>
                    <p class="flex shrink-0 items-center gap-1.5 text-xs text-gray-500"><Calendar class="size-4" />{{ formatDateTime(props?.booking?.date) }}</p>
                </div>
            </div>
        </Transition>
    </div>
</template>