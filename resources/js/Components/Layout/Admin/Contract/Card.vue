<script setup>
import { Clock, EllipsisVertical, Pencil, Trash2 } from 'lucide-vue-next'
import { ref } from 'vue'
import { onBeforeUnmount, onMounted } from 'vue'

const props = defineProps(['contract']);
const emit = defineEmits(['update', 'delete']);

const showMenu = ref(false);
const toggleMenu = () => {
    showMenu.value = !showMenu.value
}
const closeMenu = () => {
    showMenu.value = false
}
const handleClickOutside = (event) => {
    if (!event.target.closest('.position-card-menu')) {
        closeMenu()
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
    <div class="group flex w-full cursor-pointer flex-col justify-between gap-6 rounded-2xl border border-transparent bg-white p-5 shadow-sm transition-all duration-200 hover:border-violet-300 hover:shadow-lg hover:shadow-violet-100">
        <div class="flex flex-col gap-2">
            <div class="flex items-start justify-between gap-3">
                <h3 class="text-md font-bold text-slate-900">{{ props?.contract?.name }}</h3>
                <div class="relative position-card-menu">
                    <button type="button" @click.stop="toggleMenu" class="flex size-8 shrink-0 items-center justify-center rounded-lg text-slate-500 transition-colors group-hover:bg-violet-100 group-hover:text-violet-600">
                        <EllipsisVertical class="size-4" />
                    </button>
                    <Transition
                        enter-active-class="transition duration-150 ease-out"
                        enter-from-class="opacity-0 scale-95 -translate-y-1"
                        enter-to-class="opacity-100 scale-100 translate-y-0"
                        leave-active-class="transition duration-100 ease-in"
                        leave-from-class="opacity-100 scale-100"
                        leave-to-class="opacity-0 scale-95"
                    >
                        <div v-if="showMenu" class="absolute right-0 top-9 z-50 w-52 rounded-lg border border-gray-200 bg-white shadow-lg overflow-hidden">
                            <button type="button" @click="emit('update', props?.contract)"
                                class="w-full px-3 py-2.5 flex items-center gap-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <Pencil :size="15" />
                                <span>Edit</span>
                            </button>

                            <button type="button" @click="emit('delete', props?.contract)" class="w-full px-3 py-2.5 flex items-center gap-2 text-sm text-red-600 hover:bg-red-50 transition">
                                <Trash2 :size="15" />
                                <span>Hapus</span>
                            </button>
                        </div>
                    </Transition>
                </div>
            </div>
            <p class="line-clamp-2 text-sm text-slate-500">
                {{ props?.contract?.description }}
            </p>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 rounded-lg bg-violet-100 px-3 py-2 text-xs font-medium text-slate-700">
                <Clock class="size-4 text-violet-600" />
                {{ props?.contract?.duration }} Months
            </div>
        </div>
    </div>
</template>