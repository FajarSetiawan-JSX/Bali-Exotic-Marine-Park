<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, FileDown } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror,succes } from '@/Helper/Toast';
import FullScreenLoading from '@/Components/FullScreenLoading.vue';
import LoadingPrimary from '../../LoadingPrimary.vue';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['month']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    month: props?.month?.id,
    format: '',
});
const err = ref({});
async function download() {
    try{
        err.value = {}
        loading.value = true;
        const response = await axios.post(route('specific.schedule.download'), form.value);
        succes('Success', 'Succes generate date in month');
        emit('success');
    }catch(error){
        if(error?.response?.status == 422){
            err.value = error.response.data.errors 
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
        <div data-aos="zoom-in" class="flex max-h-max max-w-max flex-col overflow-hidden rounded-3xl bg-white shadow-2xl">
            <div class="border-b border-slate-200 px-6 py-5 flex-shrink-0">
                <div class="flex items-start justify-between gap-x-2">
                    <div>
                        <p class="mt-1 text-sm text-slate-500">
                            Download the <span class="text-slate-700">{{ props?.month?.month }}</span> schedule.
                        </p>
                    </div>

                    <button type="button" @click="emit('close')" class="rounded-lg p-2 transition hover:bg-slate-100">
                        <X size="20" />
                    </button>
                </div>
            </div>

            <form @submit.prevent="download" class="flex flex-1 flex-col overflow-hidden font-second">
                <div class="flex-1 overflow-y-auto max-h-max p-6">
                    <div>
                        <p class="text-slate-900 font-second text-md">Select Format</p>
                        <select name="" id="" v-model="form.format" class="py-1.5 px-3 w-full rounded-lg text-slate-800 bg-white hover:bg-white/90 transition-all duration-300">
                            <option value="" selected disabled>Select Format</option>
                            <option value="'pdf'">PDF</option>
                            <option value="'xlsx'">.xlsx</option>
                        </select>
                        <p v-if="err?.format" class="mt-1.5 text-xs text-red-500">{{ err?.format[0] }}</p>
                    </div>
                </div>
                <div class="flex-shrink-0 border-t border-slate-200 bg-white px-6 py-4">
                    <Transition name="zoom">
                        <button v-if="show" type="submit" :disabled="loading" class="mt-4 flex w-full items-center justify-center gap-2 rounded-lg bg-emerald-400 py-2 text-white transition hover:bg-emerald-500 disabled:cursor-not-allowed">
                            <FileDown size="20" />
                            <span>Download</span>
                        </button>
                    </Transition>
                </div>
            </form>
        </div>
    </div>
    <FullScreenLoading v-if="loading" >
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