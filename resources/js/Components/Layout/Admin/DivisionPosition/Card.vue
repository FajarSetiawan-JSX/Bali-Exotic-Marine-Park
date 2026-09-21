<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Globe, MoreVertical, LockKeyhole, ShieldCheck, Trash2 } from 'lucide-vue-next'

const props = defineProps(['access']);
const emit = defineEmits(['hapus']);
const showMenu = ref(false)
const toggleMenu = () => {
    showMenu.value = !showMenu.value
}
const closeMenu = () => {
    showMenu.value = false
}
onMounted(() => {
    document.addEventListener('click', closeMenu)
})
onBeforeUnmount(() => {
    document.removeEventListener('click', closeMenu)
})
</script>

<template>
    <div class="group rounded-xl border border-gray-200 bg-white p-4 sm:p-5 transition duration-200 hover:border-gray-300 hover:shadow-sm">
        <div class="flex items-start justify-between gap-3 font-second">
            <div class="min-w-0 flex-1">
                <div class="flex items-center gap-2">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-sky-50 text-sky-600">
                        <Globe class="h-4 w-4" />
                    </div>

                    <h3 class="truncate text-sm sm:text-base font-semibold text-gray-800">
                        {{ props?.access?.name }}
                    </h3>
                </div>

                <div class="mt-2 inline-block max-w-full truncate rounded bg-gray-100 px-2 py-1 font-mono text-[10px] sm:text-xs text-gray-500">
                    {{ props?.access?.route }}
                </div>
            </div>
            <div class="relative shrink-0">
                <button type="button" @click.stop="toggleMenu" class="rounded-md p-1.5 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700" aria-label="More options">
                    <MoreVertical class="h-4 w-4" />
                </button>
                <div v-if="showMenu" @click.stop class="absolute right-0 top-9 z-20 w-36 overflow-hidden rounded-lg border border-gray-200 bg-white py-1 shadow-lg">
                    <button type="button" @click="emit('hapus', props?.access)" class="flex w-full items-center gap-2 px-3 py-2 text-left text-xs font-medium text-red-600 transition hover:bg-red-50">
                        <Trash2 class="h-3.5 w-3.5" />
                        Hapus
                    </button>
                </div>
            </div>
        </div>

        <p class="mt-4 line-clamp-2 text-xs sm:text-sm leading-relaxed text-gray-500">
            {{ props?.access?.description }}
        </p>

        <div class="mt-4 flex flex-wrap items-center gap-1.5">
            <span class="inline-flex items-center rounded px-2 py-1 text-[9px] sm:text-[10px] font-semibold uppercase">
                {{ props?.access?.methode }}
            </span>
            <span class="inline-flex items-center gap-1 rounded bg-indigo-50 px-2 py-1 text-[9px] sm:text-[10px] font-semibold uppercase text-indigo-600">
                <LockKeyhole class="h-3 w-3" />
                Scope: {{ props?.access?.scope }}
            </span>

            <span class="inline-flex items-center gap-1 rounded bg-gray-100 px-2 py-1 text-[9px] sm:text-[10px] font-semibold uppercase text-gray-500">
                <ShieldCheck class="h-3 w-3" />
                Type: {{ props?.access?.type }}
            </span>
        </div>
    </div>
</template>