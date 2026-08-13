<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Crown, MoreVertical, ChessPawn, Pencil, Trash2 } from 'lucide-vue-next'

const emit = defineEmits([ 'update', 'delete'])
const props = defineProps(['position']);
const showMenu = ref(false)

const toggleMenu = () => {
    showMenu.value = !showMenu.value
}

const closeMenu = () => {
    showMenu.value = false
}

const handleEdit = () => {
    closeMenu()
    emit('update', props?.position)
}

const handleDelete = () => {
    closeMenu()
    emit('delete', props?.position)
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
    <div class="w-full rounded-xl bg-white border border-gray-100 shadow-sm p-4 hover:shadow-lg transition-all duration-300">
        <div class="flex items-start justify-between">
            <div class="flex justify-start items-center gap-x-3">
                <template v-if="props?.position?.position == 'Head'">
                    <div class="p-1.5 rounded-lg bg-red-200 flex items-center justify-center">
                        <Crown :size="30" class="text-red-400"/>
                    </div>
                </template>
                <template v-else>
                    <div class="p-1.5 rounded-lg bg-yellow-200 flex items-center justify-center">
                        <ChessPawn :size="30" class="text-yellow-400"/>
                    </div>
                </template>
                <div class="font-second">
                    <h1 class="text-slate-900 font-semibold text-md">{{ props?.position?.position?.name }}</h1>
                    <p class="text-slate-500 text-xs">{{ props?.position?.division }}</p>
                </div>
            </div>
            <div class="relative position-card-menu">
                <button type="button" @click.stop="toggleMenu" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition">
                    <MoreVertical :size="18" />
                </button>
                <Transition
                    enter-active-class="transition duration-150 ease-out"
                    enter-from-class="opacity-0 scale-95 -translate-y-1"
                    enter-to-class="opacity-100 scale-100 translate-y-0"
                    leave-active-class="transition duration-100 ease-in"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-95"
                >
                    <div v-if="showMenu" class="absolute right-0 top-9 z-50 w-32 rounded-lg border border-gray-200 bg-white shadow-lg overflow-hidden">
                        <button type="button" @click="handleEdit"
                            class="w-full px-3 py-2.5 flex items-center gap-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                            <Pencil :size="15" />
                            <span>Edit</span>
                        </button>

                        <button type="button" @click="handleDelete" class="w-full px-3 py-2.5 flex items-center gap-2 text-sm text-red-600 hover:bg-red-50 transition">
                            <Trash2 :size="15" />
                            <span>Hapus</span>
                        </button>
                    </div>
                </Transition>
            </div>
        </div>
        <div class="mt-4">

            <h3 class="text-sm font-semibold text-gray-900 leading-snug">
                {{ props?.position?.name }}
            </h3>

            <p class="mt-1 text-xs text-gray-400">
                ⚒ 
            </p>

        </div>
        <div class="mt-7 flex items-center justify-between">
            <span class="text-xs text-gray-500">
                1 User
            </span>
        </div>
    </div>
</template>