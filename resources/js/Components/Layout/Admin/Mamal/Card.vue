<script setup>
import { ref } from 'vue'
import { EllipsisVertical, Pencil, Trash2 } from 'lucide-vue-next'

const emit = defineEmits(['update', 'close']);
const props = defineProps(['mamal']);
const open = ref(false);

</script>

<template>
    <article @click="open = false" class="relative w-full rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-all duration-300">
        <div class="relative h-64 overflow-hidden rounded-t-2xl">
            <img :src="props?.mamal?.img ? `storage/${props?.mamal?.img}` : '/assets/animal.png'" alt="Mamal" class="max-w-96 mx-auto object-cover" />
            <button type="button" @click.stop="open = !open" class="absolute right-4 top-4 flex h-11 w-11 items-center justify-center rounded-xl text-slate-900 backdrop-blur-sm transition-colors hover:bg-sky-200" :class="open ? 'bg-sky-200' : 'bg-white/85'">
                <EllipsisVertical class="h-5 w-5" />
            </button>
            <Transition
                enter-active-class="transition duration-150 ease-out"
                enter-from-class="opacity-0 scale-95 -translate-y-1"
                enter-to-class="opacity-100 scale-100 translate-y-0"
                leave-active-class="transition duration-100 ease-in"
                leave-from-class="opacity-100 scale-100"
                leave-to-class="opacity-0 scale-95"
                >
                <div @click.stop v-if="open" class="absolute right-4 top-16 z-10 w-40 rounded-xl border border-slate-200 bg-white p-1.5 shadow-xl">
                    <button type="button" @click="emit('update', props?.mamal)"
                        class="w-full px-3 py-2.5 flex items-center gap-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                        <Pencil :size="15" />
                        <span>Edit</span>
                    </button>

                    <button type="button" @click="emit('delete', props?.mamal)" class="w-full px-3 py-2.5 flex items-center gap-2 text-sm text-red-600 hover:bg-red-50 transition">
                        <Trash2 :size="15" />
                        <span>Hapus</span>
                    </button>
                </div>
            </Transition>
        </div>
        <div class="p-6">
            <h2 class="mb-3 text-xl font-semibold text-slate-900">{{ props?.mamal?.name }}</h2>
            <p class="text-base leading-7 text-slate-500">
                {{ props?.mamal?.description }}
            </p>
        </div>
    </article>
</template>
