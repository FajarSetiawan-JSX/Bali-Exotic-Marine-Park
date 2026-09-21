<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, Sparkles } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror,succes } from '@/Helper/Toast';

const emit = defineEmits(['close', 'success']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    month: '',
});
const err = ref({});
async function generate() {
    try{
        err.value = {}
        loading.value = true;
        const response = await axios.post(route('specific.months.generate'), form.value);
        console.log(response?.data);
        succes('Success', 'Succes generate date in month');
        emit('success', response?.data?.month);
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
                <div class="flex items-start justify-between">
                    <div>
                        <p class="mt-1 text-sm text-slate-500">
                            Open the calendar for the new month.
                        </p>
                    </div>

                    <button type="button" @click="emit('close')" class="rounded-lg p-2 transition hover:bg-slate-100">
                        <X size="20" />
                    </button>
                </div>
            </div>

            <form @submit.prevent="generate" class="flex flex-1 flex-col overflow-hidden font-second">
                <div class="flex-1 overflow-y-auto max-h-max p-6">
                    <div>
                        <p class="text-slate-900 font-second text-md">Select Month</p>
                        <input type="month" name="" id="" v-model="form.month" class="rounded-lg w-full border-2 border-slate-400 focus:border-sky-500">
                        <p v-if="err?.month" class="mt-1.5 text-xs text-red-500">{{ err?.month[0] }}</p>
                    </div>
                </div>
                <div class="flex-shrink-0 border-t border-slate-200 bg-white px-6 py-4">
                    <Transition name="zoom">
                        <button v-if="show" type="submit" :disabled="loading" class="mt-4 flex w-full items-center justify-center gap-2 rounded-lg bg-emerald-400 py-2 text-white transition hover:bg-emerald-500 disabled:cursor-not-allowed">
                            <template v-if="!loading">
                                <Sparkles size="20" />
                                <span>Generate</span>
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