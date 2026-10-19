<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, Plus } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['pool']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    name: '',
    length: '',
    width: '',
    height: ''
});
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.patch(route('super.admin.pool.update', props?.pool?.id), form.value);
        emit('success', response?.data?.data);
    }catch(error){
        if(error?.response?.status == 422){
            err.value = error?.response?.data?.errors;
        }
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
onMounted(()=>{
    form.value.name = props?.pool?.name;
    form.value.height = props?.pool?.height;
    form.value.length = props?.pool?.length;
    form.value.width = props?.pool?.width;
    setTimeout(()=>{
        show.value = true;
    },500)
})
</script>

<template>
    <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-gradient-to-br from-indigo-950/95 via-violet-900/85 to-fuchsia-900/90 backdrop-blur-sm p-4">
        <div data-aos="zoom-in" class="flex max-h-max w-full max-w-lg flex-col overflow-hidden rounded-3xl bg-white shadow-2xl">
            <div class="border-b border-slate-200 px-6 py-5 flex-shrink-0">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">
                            Create new pool
                        </h2>
                        <p class="text-sm text-slate-500">Add a new pool.</p>
                    </div>
                    <button type="button" @click="emit('close')" class="rounded-lg p-2 transition hover:bg-slate-100">
                        <X size="20" />
                    </button>
                </div>
            </div>

            <form @submit.prevent="create" class="flex flex-1 flex-col overflow-hidden font-second">
                <div class="flex-1 overflow-y-auto max-h-max p-6 space-y-2">
                    <div class="col-span-2">
                        <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                        <input v-model="form.name" type="text" name="desc" id="desc" placeholder="Dolphine pool" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.name" class="mt-2 text-red-500 text-xs">{{ err.name[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="length" class="block text-sm font-medium text-slate-700">Length</label>
                        <input v-model="form.length" type="number" id="length" placeholder="1200 cm" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.length" class="mt-2 text-red-500 text-xs">{{ err.length[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="width" class="block text-sm font-medium text-slate-700">Width</label>
                        <input v-model="form.width" type="number" id="width" placeholder="1200 cm" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.width" class="mt-2 text-red-500 text-xs">{{ err.width[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="height" class="block text-sm font-medium text-slate-700">Height</label>
                        <input v-model="form.height" type="number" id="height" placeholder="1200 cm" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.height" class="mt-2 text-red-500 text-xs">{{ err.height[0] }}</p>
                    </div>
                </div>
                <div class="flex-shrink-0 border-t border-slate-200 bg-white px-6 py-4">
                    <Transition name="zoom">
                        <button v-if="show" type="submit" :disabled="loading" class="mt-4 flex w-full items-center justify-center gap-2 rounded-lg bg-emerald-400 py-2 text-white transition hover:bg-emerald-500 disabled:cursor-not-allowed">
                            <template v-if="!loading">
                                <Plus size="20" />
                                <span>Create</span>
                            </template>
                            <template v-else>
                                <FormLoading color="bg-white my-3" />
                            </template>
                        </button>
                    </Transition>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
.zoom-enter-active,
.zoom-leave-active {
    transition: opacity 0.5s ease, transform .35s ease;
}

.zoom-enter-from,
.zoom-leave-to {
    opacity: 0;
    transform: scale(.8);
}

.zoom-enter-to,
.zoom-leave-from {
    opacity: 1;
    transform: scale(1);
}
</style>