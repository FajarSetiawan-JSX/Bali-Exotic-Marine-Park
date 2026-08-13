<script setup>
import { ChevronLeft, ChevronRight } from 'lucide-vue-next'
import { onMounted, watch } from 'vue';
import { computed } from "vue";

const props = defineProps(['pagination', 'name']);
const emit = defineEmits(['next', 'page', 'prev'])
const pages = computed(() => {
    return props?.pagination?.links?.slice(1, -1) ?? []
})
</script>

<template>
    <div class="flex flex-col gap-4 rounded-[2rem] border border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8 lg:py-5">
        <p class="text-center text-xs text-slate-600 sm:text-sm lg:text-left">
            Showing
            <span class="font-semibold text-slate-900">
                {{ props?.pagination?.from }}–{{ props?.pagination?.to }}
            </span>
            of
            <span class="font-semibold text-slate-900">
                {{ props?.pagination?.total }}
            </span>
            {{ props?.name }}
        </p>
        <div class="flex flex-wrap items-center justify-center gap-1">
            <button type="button" :disabled="props?.pagination?.current_page === 1" @click="emit('prev', props?.pagination?.current_page - 1)" :class="props?.pagination?.current_page === 1 ? 'cursor-not-allowed bg-slate-100' : 'opacity-100 text-slate-500 hover:bg-slate-100 active:scale-95'" class="flex h-8 w-8 items-center justify-center rounded-full sm:h-9 sm:w-9 lg:h-10 lg:w-10 duration-100 transition-all">
                <ChevronLeft :size="16" class="lg:h-[18px] lg:w-[18px]" />
            </button>

            <button type="button" v-for="page in pages" :key="page" @click="emit('page', page.page)" :class="page.page === props?.pagination?.current_page ? 'bg-[#0F3558] text-white' : 'text-slate-700 hover:bg-slate-100'" class="flex h-8 w-8 items-center justify-center rounded-full transition text-sm font-medium shadow-md sm:h-9 sm:w-9 lg:h-10 lg:w-10">
                {{ page?.page }}
            </button>

            <button type="button" :disabled="props?.pagination?.last_page == props?.pagination?.current_page" @click="emit('next', props?.pagination?.current_page + 1)" :class="props?.pagination?.last_page == props.pagination.current_page ? 'cursor-not-allowed bg-slate-100' : 'opacity-100 text-slate-500 hover:bg-slate-100 active:scale-95'" class="flex h-8 w-8 items-center justify-center rounded-full sm:h-9 sm:w-9 lg:h-10 lg:w-10 active:scale-95 duration-100 transition-all">
                <ChevronRight :size="16" class="lg:h-[18px] lg:w-[18px]" />
            </button>
        </div>
    </div>
</template>