<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, Plus } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';
import FullScreenLoading from '@/Components/FullScreenLoading.vue';
import LoadingPrimary from '../../LoadingPrimary.vue';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['units', 'suppliers']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    supplier: '',
    item: '',
    nominal: '',
    rekening: '',
    category: '',
    status: '',
    duration: '',
    remark: ''
});
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.post(route('super.admin.program.store'), form.value);
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
                            Create new Purchase Order
                        </h2>
                        <p class="text-sm text-slate-500">Add a new purchase order.</p>
                    </div>
                    <button type="button" @click="emit('close')" class="rounded-lg p-2 transition hover:bg-slate-100">
                        <X size="20" />
                    </button>
                </div>
            </div>

            <form @submit.prevent="create" class="flex flex-1 flex-col overflow-hidden font-second">
                <div class="flex-1 overflow-y-auto max-h-80 p-6 space-y-2 overflow-y-scroll">
                    <div class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="supplier" class="block text-sm font-medium text-slate-700">Supplier</label>
                            <input v-model="form.supplier" type="text" id="supplier" placeholder="Shop name" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.supplier" class="mt-2 text-red-500 text-xs">{{ err.supplier[0] }}</p>
                        </div>
                        <div>
                            <label for="item" class="block text-sm font-medium text-slate-700">Item</label>
                            <input v-model="form.item" type="text" name="item" id="item" placeholder="Item name" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.item" class="mt-2 text-red-500 text-xs">{{ err.item[0] }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="nominal" class="block text-sm font-medium text-slate-700">Nominal</label>
                            <input v-model="form.nominal" type="number" id="nominal" placeholder="100000" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.nominal" class="mt-2 text-red-500 text-xs">{{ err.nominal[0] }}</p>
                        </div>
                        <div>
                            <label for="rekening" class="block text-sm font-medium text-slate-700">Rekening</label>
                            <input v-model="form.rekening" type="text" id="rekening" placeholder="98000 /VA Number" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.rekening" class="mt-2 text-red-500 text-xs">{{ err.rekening[0] }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="category" class="block text-sm font-medium text-slate-700">Category</label>
                            <select name="" id="category" v-model="form.category" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                <option selected disabled value="">Select Category</option>
                                <option :value="'Operational'">Operational</option>
                                <option :value="'Project'">Project</option>
                                <option :value="'Loss and Break'">Loss & Break</option>
                            </select>
                            <p v-if="err.category" class="mt-2 text-red-500 text-xs">{{ err.category[0] }}</p>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                            <select name="" id="status" v-model="form.status" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                <option selected disabled value="">Select Status</option>
                                <option :value="'Normal'">Normal</option>
                                <option :value="'Urgent'">Urgent</option>
                                <option :value="'Incidental'">Incidental</option>
                            </select>
                            <p v-if="err.status" class="mt-2 text-red-500 text-xs">{{ err.status[0] }}</p>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="duration" class="block text-sm font-medium text-slate-700">Duration</label>
                        <input v-model="form.duration" type="number" name="duration" id="duration" placeholder="5 Days" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.duration" class="mt-2 text-red-500 text-xs">{{ err.duration[0] }}</p>
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