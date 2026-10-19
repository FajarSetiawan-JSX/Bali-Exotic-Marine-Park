<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, Plus } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';
import FullScreenLoading from '@/Components/FullScreenLoading.vue';
import LoadingPrimary from '../../LoadingPrimary.vue';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['diet', 'basic']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    basic: props?.basic?.id,
    gelatin: '',
    selar: '',
    layang: '',
    total: ''
});
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.patch(route('specific.diet.execute', props?.diet?.id), form.value);
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
                            Intake diet plan
                        </h2>
                        <p class="text-sm text-slate-500">Intake the {{ props?.diet?.mamal }} diet plan</p>
                    </div>
                    <button type="button" @click="emit('close')" class="rounded-lg p-2 transition hover:bg-slate-100">
                        <X size="20" />
                    </button>
                </div>
            </div>

            <form @submit.prevent="create" class="flex flex-1 flex-col overflow-hidden font-second">
                <div class="flex-1 overflow-y-auto max-h-80 p-6 space-y-2">
                    <div class="col-span-2">
                        <label for="gelatin" class="block text-sm font-medium text-slate-700">Gelatin</label>
                        <input v-model="form.gelatin" type="number" name="gelatin" id="gelatin" placeholder="Gelatin" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.gelatin" class="mt-2 text-red-500 text-xs">{{ err.gelatin[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="selar" class="block text-sm font-medium text-slate-700">Selar</label>
                        <input v-model="form.selar" type="text" name="selar" id="selar" placeholder="Selar" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.selar" class="mt-2 text-red-500 text-xs">{{ err.selar[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="layang" class="block text-sm font-medium text-slate-700">Layang</label>
                        <input v-model="form.layang" type="text" name="layang" id="layang" placeholder="Layang" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.layang" class="mt-2 text-red-500 text-xs">{{ err.layang[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="total" class="block text-sm font-medium text-slate-700">Total</label>
                        <input v-model="form.total" type="number" name="total" id="total" placeholder="Total" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.total" class="mt-2 text-red-500 text-xs">{{ err.total[0] }}</p>
                    </div>
                </div>
                <footer class="flex flex-col gap-2 border-t border-slate-200 px-5 md:px-6 py-4">
                    <button type="submit" class="w-full rounded-lg bg-emerald-500 px-4 py-2.5 text-sm md:text-base font-semibold text-white shadow-md shadow-emerald-500/20 transition hover:bg-emerald-600">
                        Submit
                    </button>
                </footer>
            </form>
        </div>
    </div>
    <FullScreenLoading v-if="loading">
        <LoadingPrimary />
    </FullScreenLoading>
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