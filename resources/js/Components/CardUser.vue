<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { MoreVertical, Pencil, Trash2 } from 'lucide-vue-next'

const props = defineProps({
    user: Object
})

const showMenu = ref(false)

const menu = ref(null)

function toggleMenu() {
    showMenu.value = !showMenu.value
}

function clickOutside(e) {
    if (!menu.value) return

    if (!menu.value.contains(e.target)) {
        showMenu.value = false
    }
}

onMounted(() => {
    document.addEventListener('click', clickOutside)
})

onUnmounted(() => {
    document.removeEventListener('click', clickOutside)
})
</script>

<template>
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
        <!-- Header -->
        <div class="flex justify-between">
            <div class="flex gap-4">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name=Alex+Rivera&background=2563EB&color=ffffff&rounded=true" class="h-16 w-16 rounded-2xl object-cover">
                    <span class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-emerald-500"/>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-slate-800">
                        Alex
                    </h2>
                    <span class="mt-1 inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-700">
                        Owner
                    </span>
                </div>
            </div>
            <!-- Menu -->
            <div ref="menu" class="relative">
                <button @click="toggleMenu" class="rounded-lg p-2 hover:bg-slate-100">
                    <MoreVertical :size="18"/>
                </button>
                <Transition name="zoom">
                    <div v-if="showMenu" class="absolute right-0 top-10 z-20 w-40 overflow-hidden rounded-xl border bg-white shadow-xl">
                        <button type="button" class="flex w-full items-center gap-3 px-4 py-3 text-sm hover:bg-slate-50">
                            <Pencil :size="16"/>
                            Edit
                        </button>
                        <button type="button" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50">
                            <Trash2 :size="16"/>
                            Delete
                        </button>
                    </div>
                </Transition>
            </div>
        </div>
        <!-- Info -->
        <div class="mt-6 grid grid-cols-2 gap-y-4 text-sm">
            <span class="text-slate-400">
                Division
            </span>
            <span class="text-right font-medium">
                HC
            </span>
            <span class="text-slate-400">
                Priority
            </span>
            <span class="text-right font-medium">
                1
            </span>
            <span class="text-slate-400">
                Joined
            </span>
            <span class="text-right font-medium">
                1/2/2026
            </span>
        </div>
        <hr class="my-6">
        <!-- Footer -->
        <div class="flex items-center justify-between">
            <span class="font-medium text-emerald-600">
                Active
            </span>
            <label class="relative inline-flex cursor-pointer">
                <input type="checkbox" class="peer sr-only">
                <div class="peer h-7 w-12 rounded-full bg-slate-300 transition peer-checked:bg-emerald-600"/>
                <div class="absolute left-1 top-1 h-5 w-5 rounded-full bg-white transition peer-checked:translate-x-5"/>
            </label>
        </div>
    </div>
</template>

<style scoped>

.zoom-enter-active,
.zoom-leave-active{
    transition:.18s;
}

.zoom-enter-from,
.zoom-leave-to{
    opacity:0;
    transform:scale(.9);
}

.zoom-enter-to,
.zoom-leave-from{
    opacity:1;
    transform:scale(1);
}

</style>