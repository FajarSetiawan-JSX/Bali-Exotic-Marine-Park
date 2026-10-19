<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, Plus } from 'lucide-vue-next';
import { computed, onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';
import FullScreenLoading from '@/Components/FullScreenLoading.vue';
import LoadingPrimary from '../../LoadingPrimary.vue';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['programcategories', 'bookingmethodes', 'basic']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    basic: props?.basic?.id,
    name: '',
    qty: '',
    whatsapp: '',
    email: '',
    date: '',
    booking: '',
    payment: '',
    guide: '',
    order: []
});
const quantitas = computed(() => Number(form.value.qty) || 0);
const order = computed(() => {
    while (form.value.order.length < quantitas.value) {
        form.value.order.push({
            program: '',
            session: ''
        });
    }
    if (form.value.order.length > quantitas.value) {
        form.value.order.splice(quantitas.value);
    }
    return form.value.order;
});
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.post(route('specific.booking.store'), form.value);
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
                            Create new booking
                        </h2>
                        <p class="text-sm text-slate-500">Add a new booking.</p>
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
                            <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                            <input v-model="form.name" type="text" name="name" id="name" placeholder="Guest name" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.name" class="mt-2 text-red-500 text-xs">{{ err.name[0] }}</p>
                        </div>
                        <div>
                            <label for="qty" class="block text-sm font-medium text-slate-700">Quantity</label>
                            <input v-model="form.qty" type="number" min="1" id="qty" placeholder="1 person" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.qty" class="mt-2 text-red-500 text-xs">{{ err.qty[0] }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="wa" class="block text-sm font-medium text-slate-700">WhatsApp</label>
                            <input v-model="form.whatsapp" type="text" id="wa" placeholder="081325...." class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.whatsapp" class="mt-2 text-red-500 text-xs">{{ err.whatsapp[0] }}</p>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                            <input v-model="form.email" type="email" id="email" placeholder="guest@gmail.com" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.email" class="mt-2 text-red-500 text-xs">{{ err.email[0] }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="booking" class="block text-sm font-medium text-slate-700">Booking Methode</label>
                            <select name="" id="booking" v-model="form.booking" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                <option selected disabled value="">Select Booking</option>
                                <option :value="methode?.id" v-for="methode in props?.bookingmethodes">{{ methode?.name }}</option>
                            </select>
                            <p v-if="err.booking" class="mt-2 text-red-500 text-xs">{{ err.booking[0] }}</p>
                        </div>
                        <div>
                            <label for="payment" class="block text-sm font-medium text-slate-700">Payment</label>
                            <select name="" id="payment" v-model="form.payment" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                <option selected disabled value="">Select Payment</option>
                                <option :value="'NETT'">NETT</option>
                                <option :value="'OTA'">OTA</option>
                                <option :value="'50%'">50%</option>
                                <option :value="'100%'">100%</option>
                            </select>
                            <p v-if="err.payment" class="mt-2 text-red-500 text-xs">{{ err.payment[0] }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="date" class="block text-sm font-medium text-slate-700">Date Activity</label>
                            <input v-model="form.date" type="date" id="date" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.date" class="mt-2 text-red-500 text-xs">{{ err.date[0] }}</p>
                        </div>
                        <div>
                            <label for="guide" class="block text-sm font-medium text-slate-700">Guide</label>
                            <input v-model="form.guide" type="text" name="guide" id="guide" placeholder="Guide name" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <p v-if="err.guide" class="mt-2 text-red-500 text-xs">{{ err.guide[0] }}</p>
                        </div>
                    </div>
                    <div v-if="quantitas" class="mt-4">
                        <div v-for="(item, index) in order" :key="index" class="my-2">
                            <span class="text-black font-semibold">Person {{ index + 1 }}</span>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 ml-3">
                                <div class="md:col-span-2">
                                    <label for="program" class="block text-sm font-medium text-slate-700">Program</label>
                                    <select name="" id="program" v-model="item.program" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                        <option selected disabled value="">Select Program</option>
                                        <option :value="program?.id" v-for="program in props?.programcategories">{{ program?.program?.name }} {{ program?.category }}</option>
                                    </select>
                                    <p v-if="err[`order.${index}.program`]" class="mt-2 text-red-500 text-xs">{{ err[`order.${index}.program`][0] }}</p>
                                </div>
                                <div>
                                    <label for="time" class="block text-sm font-medium text-slate-700">Time session</label>
                                    <select name="" id="time" v-model="item.session" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                        <option selected disabled value="">Select Session</option>
                                        <option :value="'09:30'">09:30</option>
                                        <option :value="'10:00'">10:00</option>
                                        <option :value="'10:30'">10:30</option>
                                        <option :value="'11:30'">11:30</option>
                                        <option :value="'12:00'">12:00</option>
                                        <option :value="'13:00'">13:00</option>
                                        <option :value="'14:00'">14:00</option>
                                        <option :value="'15:00'">15:00</option>
                                        <option :value="'16:00'">16:00</option>
                                    </select>
                                    <p v-if="err[`order.${index}.session`]" class="mt-2 text-red-500 text-xs">{{ err[`order.${index}.session`][0] }}</p>
                                </div>
                            </div>
                        </div>
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