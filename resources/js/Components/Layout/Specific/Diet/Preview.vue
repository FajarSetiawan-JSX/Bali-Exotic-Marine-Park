<script setup>
import { X, CircleCheck, Pickaxe } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import { formatDate } from '@/Helper/FormatDate';

const emit = defineEmits(['close']);
const props = defineProps(['diet']);
const show = ref(false);
const err = ref({});
onMounted(()=>{
    setTimeout(()=>{
        show.value = true;
    },500)
})
</script>

<template>
    <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-gradient-to-br from-indigo-950/95 via-violet-900/85 to-fuchsia-900/90 backdrop-blur-sm p-4">
        <div data-aos="zoom-in" class="flex max-h-max w-full max-w-lg flex-col overflow-hidden rounded-3xl bg-white shadow-2xl">
            <div class="border-b border-slate-200 px-6 py-5 flex-shrink-0">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">
                            Diet plan preview
                        </h2>
                        <p class="text-sm text-slate-500">Base diet plan & intake diet plan.</p>
                    </div>
                    <button type="button" @click="emit('close')" class="rounded-lg p-2 transition hover:bg-slate-100">
                        <X size="20" />
                    </button>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto max-h-80 px-6 py-2 space-y-2">
                <div class="grid grid-cols-3 gap-5 font-second">
                    <div>
                        <h1 class="text-md">Mamal</h1>
                        <p class="text-slate-500 text-sm">{{ props?.diet?.mamal }}</p>
                    </div>
                    <div>
                        <h1 class="text-md">Date</h1>
                        <p class="text-slate-500 text-sm">{{ formatDate(props?.diet?.date) }}</p>
                    </div>
                    <div>
                        <h1 class="text-md">Officer</h1>
                        <p class="text-slate-500 text-sm">{{ props?.diet?.officer }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 my-1.5">
                    <div class="w-full max-w-sm rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <h3 class="mb-4 text-base font-bold text-slate-900">Base Diet</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-base text-slate-500">Gelatin</span>
                                <span class="text-base font-semibold text-slate-900">{{ props?.diet?.gelatin }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-base text-slate-500">Selar</span>
                                <span class="text-base font-semibold text-slate-900">{{ props?.diet?.selar }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-base text-slate-500">Layang</span>
                                <span class="text-base font-semibold text-slate-900">{{ props?.diet?.layang }}</span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between border-t border-slate-200 pt-4">
                            <span class="text-base font-bold text-slate-900">Total</span>
                            <span class="text-base font-bold text-purple-700">{{ props?.diet?.total }}</span>
                        </div>
                    </div>

                    <div class="w-full max-w-sm rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <h3 class="mb-4 text-base font-bold text-slate-900">Intake Diet</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-base text-slate-500">Gelatin</span>
                                <span class="text-base font-semibold text-slate-900">{{ props?.diet?.approval?.execute?.gelatin ?? '-' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-base text-slate-500">Selar</span>
                                <span class="text-base font-semibold text-slate-900">{{ props?.diet?.approval?.execute?.selar ?? '-' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-base text-slate-500">Layang</span>
                                <span class="text-base font-semibold text-slate-900">{{ props?.diet?.approval?.execute?.layang ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between border-t border-slate-200 pt-4">
                            <span class="text-base font-bold text-slate-900">Total</span>
                            <span class="text-base font-bold text-purple-700">{{ props?.diet?.approval?.execute?.total ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="flex flex-col gap-2 border-t border-slate-200 px-5 md:px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Approve</p>
                        <template v-if="props?.diet?.approval">
                            <div class="flex items-center justify-start gap-x-1 text-sm">
                                <CircleCheck size="12" class="text-emerald-500 text-sm" />{{ props?.diet?.approval?.officer }}
                            </div>
                            <p class="text-xs text-slate-500">{{ formatDate(props?.diet?.approval?.date) ?? '' }}</p>
                        </template>
                        <template v-else>
                            <p class="text-sm">Waiting Approval</p>
                        </template>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Execute</p>
                        <p class="text-sm">{{ props?.diet?.approval?.execute?.officer ?? 'Not Yet' }}</p>
                        <p class="text-xs text-slate-500">{{ formatDate(props?.diet?.approval?.execute?.date) ?? '' }}</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>

<style scoped>
.zoom-enter-active,
.zoom-leave-active {
    transition: opacity 0.5s ease, transform .35s ease;
}

.zoom-enter-from,
.zoom-leave-to {
    opacity: 0;
    transform: scale(.8);
}

.zoom-enter-to,
.zoom-leave-from {
    opacity: 1;
    transform: scale(1);
}
</style>