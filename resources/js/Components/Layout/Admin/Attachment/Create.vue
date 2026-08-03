<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { Paperclip, ClipboardList } from 'lucide-vue-next';
import { ref } from 'vue';

const emit = defineEmits(['close']);
const props = defineProps(['divisions', 'users'])
const loading = ref(false);
async function attach() {
    try{
        loading.value = true;
    }catch(error){
        console.log(error?.response);
    }finally{
        loading.value = false;
    }
}
</script>

<template>
    <div @click="emit('close')" class="fixed inset-0 z-[9999] flex justify-center items-center bg-gradient-to-br from-indigo-950/95 via-violet-900/85 to-fuchsia-900/90 backdrop-blur-sm">
        <section @click.stop data-aos="zoom-in" class="p-3 rounded-lg border-2 border-slate-300 bg-white mx-3 max-w-lg">
            <h1 data-aos="fade-up" data-aos-delay="500" class="text-sky-800 font-second text-lg text-center">Supervisor Assignment</h1>
            <p data-aos="fade-down" data-aos-delay="500" class="font-primary text-black">Manage and allocate supervisors to their respective regional divisions.</p>
            <form action="" @submit.prevent="attach" class="grid grid-cols-1 gap-y-2">
                <div class="w-full">
                    <h1 class="font-second mb-2">Select Supervisor</h1>
                    <label for="spv" class="p-3 rounded-lg bg-slate-100 border-1 border-slate-200 flex justify-between items-center font-second">
                        <div class="flex items-center justify-start gap-x-2">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=S1&background=3567FF&color=FFFFFF" alt="" class="w-10 h-10 rounded-full">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse duration-500 absolute bottom-0 right-0" />
                            </div>
                            <div>
                                <h1 class="text-sm">Supervisor</h1>
                                <h2 class="text-xs">User Priority 2</h2>
                            </div>
                        </div>
                        <input type="radio" name="" id="spv">
                    </label>
                </div>
                <h1 class="font-second my-2">Select Division</h1>
                <div class="flex items-center gap-x-2 scroll-premium w-full">
                    <label v-for="division in props.divisions" :key="division.id" :for="division.name" class="cursor-pointer shrink-0 rounded-2xl w-80 border border-slate-200 bg-slate-100 p-4 transition-all duration-300 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50 hover:border-indigo-300">
                        <input type="checkbox" :id="division.name" :value="division.id" class="hidden peer"/>
                        <div class="flex items-center justify-between w-full">
                            <div class="flex items-center gap-4">
                                <div class="grid h-14 w-14 place-items-center rounded-xl bg-indigo-100">
                                    <ClipboardList class="h-7 w-7 text-indigo-600" />
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-800">
                                        {{ division.name }}
                                    </h3>
                                    <p class="text-sm text-slate-500">
                                        {{ division.description }}
                                    </p>
                                </div>
                            </div>
                            <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-600">
                                Priority {{ division.level }}
                            </span>
                        </div>
                        <div class="mt-6">
                            <div class="mb-2 flex justify-between text-sm text-slate-500">
                                <span>Users: {{ division.user }} / {{ props.users }}</span>
                                <span>{{ division.percentage }}%</span>
                            </div>
                            <div class="h-2 overflow-hidden rounded-full bg-slate-200">
                                <div class="h-full rounded-full bg-gradient-to-r from-violet-500 to-indigo-500" :style="{ width: `${division.percentage}%` }"/>
                            </div>
                        </div>
                    </label>
                </div>
                <button type="submit" :disabled="loading" :class="loading ? 'opacity-50' : 'opacity-100'" class="bg-indigo-900 text-white py-2.5 rounded-2xl">
                    <div v-if="!loading" class="flex items-center justify-center gap-x-2">
                        <Paperclip size="20" class="text-white" />
                        Attach
                    </div>
                    <FormLoading v-else color="bg-white my-3" />
                </button>
            </form>
        </section>
    </div>
</template>

<style scoped>
/* Premium Scrollbar */
.scroll-premium {
    overflow: auto;
    scrollbar-width: thin;
    scrollbar-color: transparent transparent;
    scroll-behavior: smooth;
    transition: scrollbar-color .25s ease;
}

/* Firefox */
.scroll-premium:hover {
    scrollbar-color: #b9c5d8 transparent;
}

/* Chrome, Edge, Safari */
.scroll-premium::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.scroll-premium::-webkit-scrollbar-track {
    background: transparent;
}

.scroll-premium::-webkit-scrollbar-thumb {
    background: transparent;
    border-radius: 999px;
    border: 2px solid transparent;
    background-clip: content-box;
    transition: background .25s ease;
}

.scroll-premium:hover::-webkit-scrollbar-thumb {
    background: linear-gradient(
        180deg,
        #9db8ff,
        #6e8cff
    );
    background-clip: content-box;
}

.scroll-premium::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(
        180deg,
        #7f9cff,
        #4f73ff
    );
    background-clip: content-box;
}
</style>