<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, SquarePen } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['user']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    bank: '',
    health: '',
    work: ''
});
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.patch(route('super.admin.user.update.additional', props?.user?.id), form.value);
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
    form.value.bank = props?.user?.bank;
    form.value.health = props?.user?.health;
    form.value.work = props?.user?.work;
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
                            Additional Information
                        </h2>
                        <p class="text-sm text-slate-500">Complete the additional information regarding {{ props?.user?.name }} career.</p>
                    </div>
                    <button type="button" @click="emit('close')" class="rounded-lg p-2 transition hover:bg-slate-100">
                        <X size="20" />
                    </button>
                </div>
            </div>

            <form @submit.prevent="create" class="flex flex-1 flex-col overflow-hidden font-second">
                <div class="flex-1 overflow-y-auto max-h-max p-6 space-y-2">
                    <div class="col-span-2">
                        <label for="bank" class="block text-sm font-medium text-slate-700">Bank Account</label>
                        <input v-model="form.bank" type="text" id="bank" placeholder="12345***" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.bank" class="mt-2 text-red-500 text-xs">{{ err.bank[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="health" class="block text-sm font-medium text-slate-700">Health Social Security Agency ID</label>
                        <input v-model="form.health" type="text" id="health" placeholder="12345***" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.bank" class="mt-2 text-red-500 text-xs">{{ err.bank[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="work" class="block text-sm font-medium text-slate-700">Employment Social Security Agency ID</label>
                        <input v-model="form.work" type="text" id="work" placeholder="12345***" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.work" class="mt-2 text-red-500 text-xs">{{ err.work[0] }}</p>
                    </div>
                </div>
                <div class="flex-shrink-0 border-t border-slate-200 bg-white px-6 py-4">
                    <Transition name="zoom">
                        <button v-if="show" type="submit" :disabled="loading" class="mt-4 flex w-full items-center justify-center gap-2 rounded-lg bg-emerald-400 py-2 text-white transition hover:bg-emerald-500 disabled:cursor-not-allowed">
                            <template v-if="!loading">
                                <SquarePen size="20" />
                                <span>Update</span>
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