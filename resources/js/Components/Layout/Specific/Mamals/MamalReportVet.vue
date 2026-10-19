<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, Plus } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';
import FullScreenLoading from '@/Components/FullScreenLoading.vue';
import LoadingPrimary from '../../LoadingPrimary.vue';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['basic', 'report', 'programs']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    basic: props?.basic?.id,
    group: '',
    healthstatus: '',
    klinis: '',
    keterangan: '',
    socialstatus: '',
    recomended: '',
    status: '',
    remark: ''
});
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.post(route('specific.mammal.report.vet.store', props?.report?.id), form.value);
        emit('success', response?.data?.data);
    }catch(error){
        if(error?.response?.status == 422){
            err.value = error?.response?.data?.errors;
        }
        eror(error?.response?.status, error?.response?.data?.message);
        console.log(error?.response?.data);
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
                            Create new Mammal Report VET
                        </h2>
                        <p class="text-sm text-slate-500">Add a new mammal report VET to <span class="text-slate-800">{{ props?.report?.mamal }}</span>.</p>
                    </div>
                    <button type="button" @click="emit('close')" class="rounded-lg p-2 transition hover:bg-slate-100">
                        <X size="20" />
                    </button>
                </div>
            </div>

            <form @submit.prevent="create" class="flex flex-1 flex-col overflow-hidden font-second">
                <div class="flex-1 overflow-y-auto max-h-80 p-6 space-y-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="group" class="block text-sm font-medium text-slate-700">Group</label>
                            <select name="" id="group" v-model="form.group" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                <option selected disabled value="">Select Group</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                            </select>
                            <p v-if="err.group" class="mt-2 text-red-500 text-xs">{{ err.group[0] }}</p>
                        </div>
                        <div>
                            <label for="hs" class="block text-sm font-medium text-slate-700">Health Status</label>
                            <select name="" id="hs" v-model="form.healthstatus" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                <option selected disabled value="">Select Health Status</option>
                                <option value="FIT">FIT</option>
                                <option value="FIT RINGAN">FIT Ringan</option>
                                <option value="KURANG FIT">Kurang FIT</option>
                            </select>
                            <p v-if="err.healthstatus" class="mt-2 text-red-500 text-xs">{{ err.healthstatus[0] }}</p>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="klinis" class="block text-sm font-medium text-slate-700">Tanda Klinis</label>
                        <input v-model="form.klinis" type="text" name="faces" id="klinis" placeholder="something" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.klinis" class="mt-2 text-red-500 text-xs">{{ err.klinis[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="ket" class="block text-sm font-medium text-slate-700">Keterangan</label>
                        <input v-model="form.keterangan" type="text" name="floating" id="ket" placeholder="something" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.keterangan" class="mt-2 text-red-500 text-xs">{{ err.keterangan[0] }}</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="ss" class="block text-sm font-medium text-slate-700">Social Status</label>
                            <select name="" id="ss" v-model="form.socialstatus" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                <option selected disabled value="">Select Social Status</option>
                                <option value="STABLE">STABLE</option>
                                <option value="NOT STABLE">NOT STABLE</option>
                            </select>
                            <p v-if="err.socialstatus" class="mt-2 text-red-500 text-xs">{{ err.socialstatus[0] }}</p>
                        </div>
                        <div>
                            <label for="ra" class="block text-sm font-medium text-slate-700">Recomended Activity</label>
                            <select name="" id="ra" v-model="form.recomended" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                <option selected disabled value="">Select Health Status</option>
                                <option :value="program?.id" v-for="program in props?.programs">{{ program?.name }}</option>
                            </select>
                            <p v-if="err.recomended" class="mt-2 text-red-500 text-xs">{{ err.recomended[0] }}</p>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                        <select name="" id="status" v-model="form.status" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <option selected disabled value="">Select Status</option>
                            <option value="GO">GO</option>
                            <option value="NO GO">NO GO</option>
                        </select>
                        <p v-if="err.status" class="mt-2 text-red-500 text-xs">{{ err.status[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="remark" class="block text-sm font-medium text-slate-700">Remark</label>
                        <textarea v-model="form.remark" name="remark" id="remark" placeholder="Remark" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
                        <p v-if="err.remark" class="mt-2 text-red-500 text-xs">{{ err.remark[0] }}</p>
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