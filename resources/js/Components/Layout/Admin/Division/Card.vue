<script setup>
import { onBeforeUnmount, ref } from 'vue'
import { Trash2, Building2, MoreHorizontal, Settings, Workflow} from "lucide-vue-next";
import { onMounted } from 'vue';
import NavButton from '../NavButton.vue';

const props = defineProps({
    division: Object
})

const emit = defineEmits([
    'update',
    'delete'
])

const showMenu = ref(false)

function toggleMenu() {
    showMenu.value = !showMenu.value
}

function closeMenu() {
    showMenu.value = false
}

function update() {
    closeMenu()
    emit('update', props.division)
}

function hapus() {
    closeMenu()
    emit('delete', props.division)
}
function handleClickOutside(e) {
    if (!e.target.closest('.dropdown-menu')) {
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
    <div class="relative rounded-[20px] shadow-lg bg-gradient-to-br from-violet-600 via-violet-500 to-indigo-500 overflow-hidden">
        <div class="relative overflow-visible rounded-[20px] px-6 pt-6 pb-20">
            <div class="absolute -right-10 -top-10 h-36 w-36 rounded-full bg-white/10"/>
            <div class="absolute right-8 top-0 h-24 w-24 rounded-full bg-white/5"/>
            <div class="relative flex items-start justify-between">
                <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-white/15 backdrop-blur-md">
                    <Building2 class="h-8 w-8 text-white" />
                </div>
                <div class="relative dropdown-menu">
                    <button @click.stop="toggleMenu" class="rounded-xl bg-white/15 p-2 text-white transition hover:bg-white/25">
                        <MoreHorizontal class="h-5 w-5" />
                    </button>

                    <Transition
                        enter-active-class="transition duration-150 ease-out"
                        enter-from-class="opacity-0 scale-95"
                        enter-to-class="opacity-100 scale-100"
                        leave-active-class="transition duration-100 ease-in"
                        leave-from-class="opacity-100 scale-100"
                        leave-to-class="opacity-0 scale-95"
                    >
                        <div v-if="showMenu" class="absolute right-0 top-12 z-[9999] w-60 rounded-2xl border border-slate-200 bg-white shadow-xl overflow-hidden">
                            <button type="button" @click="update" class="flex w-full items-center gap-3 px-5 py-4 text-left text-slate-700 transition hover:bg-slate-50">
                                <Settings class="h-4 w-4 text-slate-500" />
                                <span class="font-medium">
                                    Update division
                                </span>
                            </button>

                            <NavButton :href="route('super.admin.division.position', props?.division?.slug)" class="flex w-full items-center gap-3 px-5 py-4 text-left text-emerald-600 transition hover:bg-emerald-100">
                                <Workflow class="h-4 w-4 text-emerald-500" />
                                <span class="font-medium">
                                    Positions
                                </span>
                            </NavButton>

                            <!-- <button class="flex w-full items-center gap-3 px-5 py-4 text-left text-blue-600 transition hover:bg-blue-50">
                                <Users class="h-4 w-4" />
                                <span class="font-medium">
                                    Lihat Anggota
                                </span>
                            </button> -->

                            <button type="button" @click="hapus" class="flex w-full items-center gap-3 border-t border-slate-100 px-5 py-4 text-left text-red-600 transition hover:bg-red-50">
                                <Trash2 class="h-4 w-4" />
                                <span class="font-medium">
                                    Delete division
                                </span>
                            </button>
                        </div>
                    </Transition>
                </div>
            </div>

            <!-- Title -->
            <div class="relative z-10 mt-5">
                <h2 class="text-3xl font-bold text-white">
                    {{ props?.division?.name }}
                </h2>

                <div class="mt-3 flex items-center gap-2">
                    <span class="rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white">
                        {{ props?.division?.unit }}
                    </span>

                    <span class="text-sm text-white/70">
                        Level {{ props?.division?.level }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="-mt-6 rounded-t-[28px] bg-white px-7 py-6 min-h-full">
            <p class="text-[15px] leading-8 text-slate-600">
                {{ props?.division?.description }}
            </p>

            <div class="mt-8 flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex -space-x-2">
                        <template v-if="props?.division?.user?.length > 0">
                            <img v-for="user in props?.division?.user"
                            :src="user?.profile ? '' : `https://ui-avatars.com/api/?name=${user?.name}&background=0000fc&color=fff`"
                            title="title"
                            class="w-8 h-8 rounded-full border-2 border-white hover:-translate-y-1 transition-all duration-300">
                        </template>
                        <img
                        :src="`https://ui-avatars.com/api/?name=${props?.division?.user?.length}&background=7DD3fc&color=fff`"
                        class="w-8 h-8 rounded-full border-2 border-white">
                    </div>

                    <span class="ml-4 font-primary text-slate-600">
                        {{ props?.division?.total }} anggota
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>