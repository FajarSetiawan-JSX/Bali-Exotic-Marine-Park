<script setup>
import { CheckSquare, Pencil, Trash2, TextInitial, PenOff } from 'lucide-vue-next'

const props = defineProps(['question', 'number']);
const emit = defineEmits(['edit', 'hapus']);
</script>

<template>
    <div class="w-full rounded-xl border border-slate-200 bg-white p-4 shadow-sm hover:shadow-lg transition-all duration-300 font-second">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-slate-400">#QST-{{ Number(props?.number) }}</span>
                <span v-if="props?.question?.part" class="rounded-md bg-sky-50 px-2 py-0.5 text-xs font-medium text-sky-600">Part {{ props?.question?.part }}</span>
            </div>
            <span class="text-xs font-medium text-emerald-400 px-3 py-0.5 bg-emerald-50 rounded-sm">
                {{ props?.question?.division }}
            </span>
        </div>
        <p class="mt-3 line-clamp-2 text-sm text-slate-800 sm:text-md">
            {{ props?.question?.question }}
        </p>
        <p v-if="props?.question?.section" class="mt-1 text-xs text-slate-400 sm:text-sm">
            {{ props?.question?.section }}
        </p>
        <div class="mt-3 flex items-center justify-between border-t border-slate-100 pt-3">
            <template v-if="props?.question?.type == 'Checklist'">
                <span class="flex gap-x-2 items-center justify-start"><CheckSquare class="inline size-3.5 text-sky-500" />
                    <span class="text-slate-500">Checklist</span>
                </span>
            </template>
            <template v-else>
                <span class="flex gap-x-2 items-center justify-start"><TextInitial class="inline size-3.5 text-emerald-500" />
                    <span class="text-slate-500">Text</span>
                </span>
            </template>
            <div class="flex items-center gap-3 text-slate-400">
                <button type="button" @click="emit('edit', props?.question)">
                    <Pencil class="size-4 cursor-pointer hover:text-slate-600" />
                </button>
                <button type="button" @click="emit('hapus', props?.question)">
                    <Trash2 class="size-4 cursor-pointer hover:text-red-500" />
                </button>
            </div>
        </div>
    </div>
</template>