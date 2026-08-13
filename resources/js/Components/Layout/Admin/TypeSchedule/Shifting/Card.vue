<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Clock3, MoreVertical, Pencil, Trash2 } from 'lucide-vue-next'
import { formatTime } from '@/Helper/FormatTime.js';

const props = defineProps(['time', 'bg', 'icon' ,'border']);
const emit = defineEmits(['update', 'delete'])

const showMenu = ref(false)

const toggleMenu = () => {
    showMenu.value = !showMenu.value
}

const handleUpdate = () => {
    showMenu.value = false
    emit('update', props?.time)
}

const handleDelete = () => {
    showMenu.value = false
    emit('delete', props?.time)
}

const handleClickOutside = (event) => {
    if (!event.target.closest('.time-card-menu')) {
        showMenu.value = false
    }
}

onMounted(() => {
    document.addEventListener('click', handleClickOutside)
})

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
    <div :class="props?.border" class="w-full rounded-xl border-l-[3px] bg-white px-6 py-6 shadow-sm font-second">
        <div class="flex items-start justify-between gap-4">
            <div class="flex min-w-0 items-start gap-4">
                <div :class="props?.bg" class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl">
                    <Clock3 :size="26" :stroke-width="2" :class="props?.icon"/>
                </div>
                <div class="min-w-0">
                    <h3 class="truncate text-lg text-slate-900">
                        {{ props?.time?.name }}
                    </h3>

                    <p class="mt-0.5 text-sm text-slate-400">
                        {{ formatTime(props?.time?.start) }} - {{ formatTime(props?.time?.end) }}
                    </p>
                </div>
            </div>
            <div class="time-card-menu relative shrink-0">
                <button type="button" @click.stop="toggleMenu" class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                    <MoreVertical :size="21" />
                </button>
                <Transition
                    enter-active-class="transition duration-150 ease-out"
                    enter-from-class="scale-95 opacity-0"
                    enter-to-class="scale-100 opacity-100"
                    leave-active-class="transition duration-100 ease-in"
                    leave-from-class="scale-100 opacity-100"
                    leave-to-class="scale-95 opacity-0"
                >
                    <div v-if="showMenu" class="absolute right-0 top-10 z-50 w-36 overflow-hidden rounded-xl border border-slate-100 bg-white p-1.5 shadow-lg">
                        <button type="button" @click="handleUpdate" class="flex w-full items-center gap-2.5 rounded-lg px-3 py-2.5 text-sm text-slate-700 transition hover:bg-slate-50">
                            <Pencil :size="16" :stroke-width="2"/>
                            <span>Update</span>
                        </button>

                        <button type="button" @click="handleDelete" class="flex w-full items-center gap-2.5 rounded-lg px-3 py-2.5 text-sm text-red-500 transition hover:bg-red-50">
                            <Trash2 :size="16" :stroke-width="2"/>
                            <span>Delete</span>
                        </button>
                    </div>
                </Transition>
            </div>
        </div>
        <p class="mt-5 text-sm leading-7 text-slate-600">
            These working hours include a break from
            <span class="font-medium text-slate-900">{{ formatTime(props?.time?.break_start) }}</span>
            to
            <span class="font-medium text-slate-900">{{ formatTime(props?.time?.break_end) }}</span>.
        </p>
    </div>
</template>