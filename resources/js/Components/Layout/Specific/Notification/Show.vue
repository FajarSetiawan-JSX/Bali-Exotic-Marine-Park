<script setup>
import { X, Bell, BadgeCheck, CalendarDays } from 'lucide-vue-next';
import { onMounted } from 'vue';
import { formatDateTime } from '@/Helper/FormatDateTime';

const emit = defineEmits(['close']);
const props = defineProps(['notification']);

onMounted(()=>{
})
</script>

<template>
    <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-gradient-to-br from-indigo-950/95 via-violet-900/85 to-fuchsia-900/90 backdrop-blur-sm p-4">
        <div data-aos="zoom-in" class="flex flex-col w-full max-w-sm md:max-w-md max-h-[90vh] rounded-2xl md:rounded-3xl bg-slate-50 shadow-2xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-200 px-5 md:px-6 py-4 md:py-5">
                <div class="flex items-center gap-x-3">
                    <div class="flex items-center justify-center size-10 rounded-xl bg-sky-100 text-sky-500"><Bell :size="18" /></div>
                    <div>
                        <p class="text-xs font-semibold uppercase text-sky-500">Broadcast Message</p>
                        <h2 class="text-base md:text-lg font-bold text-slate-900">Detail Notification</h2>
                    </div>
                </div>
                <button type="button" @click="emit('close')" class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                    <X :size="18" />
                </button>
            </div>
            <div class="space-y-4 px-5 md:px-6 py-5 max-h-80 overflow-y-auto font-second">
                <div class="flex items-center gap-x-3">
                    <img :src="notification?.avatar ? `storage/${notification?.avatar}` : `https://ui-avatars.com/api/?background=2DD4BF&color=fff&name=${notification?.name}`" alt="" class="rounded-full size-12 object-cover border-2 border-white ring-1 ring-slate-200">
                    <div class="font-second">
                        <div class="flex items-center gap-x-2">
                            <h1 class="text-sm font-bold text-slate-900">{{ notification?.name }}</h1>
                            <span class="flex items-center gap-x-1 text-xs font-medium text-emerald-700"><BadgeCheck :size="14" />{{ notification?.position }}</span>
                        </div>
                        <p class="flex items-center gap-x-1.5 mt-0.5 text-xs text-slate-500"><CalendarDays :size="14" />{{ formatDateTime(notification?.date) }}</p>
                    </div>
                </div>
                <h3 class="text-base font-bold text-slate-900">Notification</h3>
                <p class="text-sm leading-relaxed text-slate-600">{{ notification?.notification }}</p>
                <img v-if="notification?.img" :src="`storage/${notification?.img}`" alt="" class="w-full max-w-80 max-h-60 mx-auto rounded-2xl border border-slate-200 object-cover">
            </div>
        </div>
    </div>
</template>