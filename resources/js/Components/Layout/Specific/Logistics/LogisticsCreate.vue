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
    unit: '',
    supplier: '',
    item: '',
    pcs: '',
    price: '',
    receipt: '',
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
                            Create new logistic
                        </h2>
                        <p class="text-sm text-slate-500">Add a new logistic.</p>
                    </div>
                    <button type="button" @click="emit('close')" class="rounded-lg p-2 transition hover:bg-slate-100">
                        <X size="20" />
                    </button>
                </div>
            </div>

            <form @submit.prevent="create" class="flex flex-1 flex-col overflow-hidden font-second">
                <div class="flex-1 overflow-y-auto max-h-max p-6 space-y-2">
                    <div class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="unit" class="block text-sm font-medium text-slate-700">Unit</label>
                            <select name="" id="unit" v-model="form.unit" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                <option selected disabled value="">Select Unit</option>
                                <option :value="'10:00'">10:00</option>
                            </select>
                            <p v-if="err.unit" class="mt-2 text-red-500 text-xs">{{ err.unit[0] }}</p>
                        </div>
                        <div>
                            <label for="supplier" class="block text-sm font-medium text-slate-700">Suppliers</label>
                            <select name="" id="supplier" v-model="form.supplier" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                <option selected disabled value="">Select Supplier</option>
                                <option :value="'10:00'">10:00</option>
                            </select>
                            <p v-if="err.supplier" class="mt-2 text-red-500 text-xs">{{ err.supplier[0] }}</p>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="item" class="block text-sm font-medium text-slate-700">Item</label>
                        <input v-model="form.item" type="text" name="item" id="item" placeholder="Item name" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.item" class="mt-2 text-red-500 text-xs">{{ err.item[0] }}</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="psc" class="block text-sm font-medium text-slate-700">PCS</label>
                            <input v-model="form.pcs" type="number" id="psc" placeholder="1 pcs" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.pcs" class="mt-2 text-red-500 text-xs">{{ err.pcs[0] }}</p>
                        </div>
                        <div>
                            <label for="price" class="block text-sm font-medium text-slate-700">Price</label>
                            <input v-model="form.price" type="number" id="price" placeholder="98000" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.price" class="mt-2 text-red-500 text-xs">{{ err.price[0] }}</p>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="receipt" class="block text-sm font-medium text-slate-700">Receipt</label>
                        <input v-model="form.receipt" type="text" name="receipt" id="receipt" placeholder="Receipt name" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <p v-if="err.receipt" class="mt-2 text-red-500 text-xs">{{ err.receipt[0] }}</p>
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