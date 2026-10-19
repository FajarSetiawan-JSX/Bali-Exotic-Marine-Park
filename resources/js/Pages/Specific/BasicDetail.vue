<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import { ShoppingCart, Calendar, Clock, Plus, UserPlus, Truck, MapPin, TriangleAlert, ArrowRight, CircleCheck, User, ClipboardCheck, FolderCheck, ConciergeBell, Forklift, Cat, FishOff, WavesLadder, FolderKanban, Syringe, CalendarCheck, SquareChartGantt, Settings } from "lucide-vue-next";
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import Card from '@/Components/Layout/Specific/Booking/Card.vue';
import SearchAnimation from '@/Components/SearchAnimation.vue';
import { formatTime } from '@/Helper/FormatTime';
import FullScreenLoading from '@/Components/FullScreenLoading.vue';
import Create from '@/Components/Layout/Specific/Security/Visitor/Create.vue';
import Alert from '@/Components/Layout/Specific/Security/Visitor/Alert.vue';
import Menu from '@/Components/Menu.vue';
import CreateDelevery from '@/Components/Layout/Specific/Security/Delivery/CreateDelevery.vue';
import BookingCreate from '@/Components/Layout/Specific/Booking/BookingCreate.vue';
import LogisticsCreate from '@/Components/Layout/Specific/Logistics/LogisticsCreate.vue';
import OrderCreate from '@/Components/Layout/Specific/Order/OrderCreate.vue';
import PoolCreate from '@/Components/Layout/Specific/Pool/PoolCreate.vue';
import MamalReportCreate from '@/Components/Layout/Specific/Mamals/MamalReportCreate.vue';
import MamalDietCreate from '@/Components/Layout/Specific/Mamals/MamalDietCreate.vue';
import WorkOrderCreate from '@/Components/Layout/Specific/WorkOrder/WorkOrderCreate.vue';
import Table from '@/Components/Layout/Specific/Diet/Table.vue';
import PoolPlanCreate from '@/Components/Layout/Specific/Pool/PoolPlanCreate.vue';
import MamalReportVet from '@/Components/Layout/Specific/Mamals/MamalReportVet.vue';
import ReportMamalToday from '@/Components/Layout/Specific/Mamals/ReportMamalToday.vue';

const user = usePage().props?.auth;
const props = defineProps(['basic', 'bookingmethodes', 'programcategories', 'suppliers', 'mamals', 'pools', 'programs']);
const basic = ref({});
const search = ref('');
const modaldelivery = ref(false);
const tipe = ref('');
const modalalert = ref(false)
const modalvisitor = ref(false);
const modalbooking = ref(false);
const modallogistic = ref(false);
const modalorder = ref(false);
const modalpool = ref(false);
const modalmamal = ref(false);
const modalmamalvet = ref(false);
const modaldiet = ref(false);
const modalblood = ref(false);
const modalplan = ref(false);
const modalworkorder = ref(false);
const record = ref({});
const pagination = ref({});
const loading = ref(false);
const loadingbooking = ref(false);
const modalopeningcheckgear = ref(false);
const modalclosecheckgear = ref(false);
const bookingtoday = ref([]);
async function done() {
    try{
        loading.value = true;
        const response = await axios.patch(route('specific.basics.information.daily.done', basic?.value.id));
        basic.value.done = true;
        succes('Success', 'Progress complete!');
    }catch(error){
        console.log(error?.response);
        eror(error?.response?.status, error?.response?.statusText);
    }finally{
        loading.value = false;
    }
}

async function getbooking(page = 1) {
    try{
        loadingbooking.value = true;
        const response = await axios.get(route('specific.booking.index'), {
            params: {
                page: page,
                today: true,
                basic: props?.basic?.id,
                search: search.value
            }
        });
        bookingtoday.value = response?.data?.data ?? [];
        pagination.value = response?.data?.meta ?? {};
        console.log(bookingtoday?.value);
    }catch(error){
        console.log(error.response);
        eror(error?.response?.status, error?.response?.statusText);
    }finally{
        loadingbooking.value = false;
    }
}
function next(page){
    if(page){
        getbooking(page)
    }
}
function page(page){
    if(page){
        getbooking(page)
    }
}
function prev(page){
    if(page){
        getbooking(page)
    }
}

watch(()=>search.value, ($newsearch)=>{
    if($newsearch){
        setTimeout(() => {
            get()
        }, 1000);
    }
},{ immediate: true });
function handlesuccesscreatevisitor (data){
    console.log('MASUK KE SINI : ', data)
    modalvisitor.value = false;
    tipe.value = data;
    succes('Success', 'Success create new visitor');
    setTimeout(() => {
        modalalert.value = true;
    }, 500);
}
function handleclosealert (){
    modalalert.value = false;
    tipe.value = '';
}
function handlesuccesscreatebooking(){
    modalbooking.value = false;
    succes('Success', 'Success create new booking');
    window.location.reload();
}
function handlesuccesscreatedietplan(){
    modaldiet.value = false;
    succes('Success', 'Success create new diet plan');
    window.location.reload();
}
function handlesuccesscreatepoolplan(){
    modalplan.value = false;
    succes('Success', 'Success create new pool plan');
    window.location.reload();
}
function handlesuccesscreatemamalvet(){
    modalmamalvet.value = false;
    succes('Success', 'Success create new mamal report VET');
    window.location.reload();
}
function handlesuccesscreatemamalreport(){
    modalmamal.value = false;
    succes('Success', 'Success create new mamal report');
    window.location.reload();
}
function handleopenmamalreportvet(data){
    modalmamalvet.value = true;
    record.value = data;
}
function handleclosemamalreportvet(){
    modalmamalvet.value = false;
    record.value = {};
}
function handlesuccesscreateworkorder(){
    modalworkorder.value = false;
    succes('Success', 'Success create new work order');
    window.location.reload();
}
function handlesuccesscreatedelivery(){
    modaldelivery.value = false;
    succes('Success', 'Success create new delivery');
    window.location.reload();
}
onMounted(()=>{
    if(user.web.includes('specific.bookings')){
        getbooking();
    }
    basic.value = props?.basic;
    console.log(user);
})
</script>

<template>
    <Head title="Basic Detail" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Basic Detail</h1>
        </template>
        <div class="space-y-4 md:space-y-6">
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-slate-900 to-teal-800 p-5 md:p-8 text-white">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-5">
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            <span class="flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1 text-xs md:text-sm">
                            <Calendar class="size-3.5" /> {{ basic?.date }}
                            </span>
                            <span class="flex items-center gap-1.5 rounded-full bg-emerald-400/20 px-3 py-1 text-xs md:text-sm text-emerald-300">
                            <Clock class="size-3.5" /> {{ basic?.time }} {{ formatTime(basic?.start) }} - {{ formatTime(basic?.end) }}
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl xl:text-3xl font-semibold">Halo, {{ basic?.name }}!</h1>
                        <p class="mt-1 max-w-md text-sm md:text-base text-slate-300">
                            Start making progress now and complete your tasks!
                        </p>
                    </div>
                    <div>
                        <template v-if="!basic.done">
                            <div class="flex flex-wrap gap-2 md:gap-3 max-w-xl">
                                <Menu :href="route('daily.patrol.create', props?.basic?.id)" class="flex items-center gap-1.5 rounded-lg bg-teal-400 px-3.5 py-2 text-sm md:text-sm font-medium text-slate-900 hover:bg-teal-300 active:scale-95 transition-all duration-300">
                                    <Plus class="size-4" /> Create Patrol
                                </Menu>
                                <button type="button" @click="modalvisitor = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <UserPlus class="size-4" /> Report Visitor
                                </button>
                                <button type="button" @click="modaldelivery = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <Truck class="size-4" /> Report Delivery
                                </button>
                                <Menu :href="route('incident.create', props?.basic?.id)" class="flex items-center gap-1.5 rounded-lg bg-red-400 px-3.5 py-2 text-sm md:text-md font-medium text-slate-900 hover:bg-red-300 active:scale-95 transition-all duration-300">
                                    <TriangleAlert class="size-4" /> Incident
                                </Menu>
                                <button type="button" @click="modalbooking = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <ConciergeBell class="size-4" /> Booking
                                </button>
                                <button type="button" @click="modallogistic = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <Forklift class="size-4" /> Logistic
                                </button>
                                <button type="button" @click="modalorder = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <ShoppingCart class="size-4" /> Purchase Order
                                </button>
                                <button type="button" @click="modalmamal = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <Cat class="size-4" /> Mammals Report
                                </button>
                                <template v-if="user.api.includes('specific.diet.store')">
                                    <button type="button" @click="modaldiet = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                        <FishOff class="size-4" /> Mammals Diet Plan
                                    </button>
                                </template>
                                <button type="button" @click="modalpool = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <WavesLadder class="size-4" /> Pool Report
                                </button>
                                <button type="button" @click="modalplan = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <FolderKanban class="size-4" /> Pool Plan
                                </button>
                                <button type="button" @click="modalblood = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <Syringe class="size-4" /> Blood Cek Quarterly
                                </button>
                                <button type="button" @click="modalblood = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <Syringe class="size-4" /> Blood Cek Insidentil
                                </button>
                                <button type="button" @click="modalworkorder = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <SquareChartGantt class="size-4" /> Work Order
                                </button>
                                <button type="button" @click="modalopeningcheckgear = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <Settings class="size-4" /> Opening Check Gear
                                </button>
                                <button type="button" @click="modalclosecheckgear = true" class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2 text-xs md:text-sm hover:bg-white/20 active:scale-95 transition-all duration-300">
                                    <Settings class="size-4" /> Closing Check Gear
                                </button>
                            </div>
                            <form action="" @submit.prevent="done">
                                <button type="submit" class="w-full py-1 rounded-sm bg-white flex items-center justify-center gap-x-1.5 text-slate-500 font-second text-sm my-5 hover:bg-emerald-100 transition-all duration-300 active:scale-95">
                                    <ClipboardCheck size="15" class="text-slate-500" />
                                    Mark as done
                                </button>
                            </form>
                        </template>
                        <template v-else>
                            <div class="max-w-max px-5 py-1.5 bg-white/10 text-white text-md flex gap-x-2 items-center justify-center rounded-md mx-auto">
                                <FolderCheck size="20" class="text-emerald-300" />
                                Done!
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                <div class="rounded-2xl border border-slate-200 p-4 md:p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-sm md:text-base font-semibold text-slate-900">Patrol</h2>
                            <p class="text-xs md:text-sm text-slate-500">Shift Berjalan (Zona A - D)</p>
                        </div>
                        <span class="rounded-full bg-teal-50 px-2.5 py-1 text-xs font-medium text-teal-600">Aktif</span>
                    </div>

                    <div class="mt-4">
                        <div class="flex items-center justify-between text-xs md:text-sm text-slate-600">
                            <span>Patrol Point Progress</span>
                            <span class="font-semibold text-slate-900">75%</span>
                        </div>
                        <div class="mt-1.5 h-2 rounded-full bg-slate-100">
                            <div class="h-2 rounded-full bg-gradient-to-r from-sky-400 to-blue-600" style="width: 75%" />
                        </div>
                        <div class="mt-1 flex justify-between text-xs text-slate-400">
                            <span>6 dari 8 area</span>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between rounded-xl bg-emerald-50 px-3 py-2.5">
                        <div class="flex items-center gap-2">
                            <CircleCheck class="size-5 text-emerald-500 shrink-0" />
                            <div>
                                <p class="text-xs md:text-sm font-medium text-slate-900">0 Insiden Kritis</p>
                                <p class="text-xs text-slate-500">Semua area dalam batas aman</p>
                            </div>
                        </div>
                        <span class="rounded-full bg-emerald-100 px-2 py-0.5 text-xs font-medium text-emerald-600">Aman</span>
                    </div>

                    <div class="mt-4">
                        <p class="text-xs md:text-sm text-slate-500">Pos terakhir terverifikasi <span class="float-right text-slate-900">10:45 WITA</span></p>
                        <p class="mt-2 flex items-center gap-1.5 text-xs md:text-sm font-medium text-slate-900">
                            <MapPin class="size-4 text-slate-400" /> Pos 6: Kolam Lumba-lumba 1
                        </p>
                        <p class="text-xs text-slate-500 ml-5.5">Petugas: Bripka Made Wira (NIP #8821)</p>
                    </div>
                    <div class="mt-4 flex items-center justify-end border-t border-slate-100 pt-3 text-xs md:text-sm">
                        <Menu :href="route('daily.patrols')" class="flex items-center gap-1 font-medium text-teal-600 hover:underline">Preview all <ArrowRight class="size-3.5" /></Menu>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 md:p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-sm md:text-base font-semibold text-slate-900">Report Visitor</h2>
                            <p class="text-xs md:text-sm text-slate-500">Report visitor at <span class="text-slate-700">{{ props?.basic?.date }}</span></p>
                        </div>
                        <div class="p-2 rounded-sm bg-rose-100">
                            <User size="15" class="text-rose-400" />
                        </div>
                    </div>

                    <div class="mt-3 space-y-3">
                        <div>
                            <div class="flex items-center justify-between">
                                <p class="text-xs md:text-sm font-medium text-slate-900">Bpk. Hendra Gunawan & Tim (4 Pax)</p>
                                <span class="rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-600">Di Area</span>
                            </div>
                            <p class="text-xs text-slate-500">Information: Ruang Rapat Eksekutif & Aquatics</p>
                            <div class="flex justify-between text-xs text-slate-400"><span>In: 09:15 WITA</span><span>ID: #VIP-104</span></div>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 text-xs md:text-sm">
                        <span class="text-slate-500">8 visitors recorded</span>
                        <Menu :href="route('security.visitor')" class="flex items-center gap-1 font-medium text-teal-600 hover:underline">Preview all <ArrowRight class="size-3.5" /></Menu>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 md:p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-sm md:text-base font-semibold text-slate-900">Delivery report</h2>
                            <p class="text-xs md:text-sm text-slate-500">Screening logistik & gate pass</p>
                        </div>
                        <div class="p-2 rounded-sm bg-amber-100">
                            <Truck size="15" class="text-amber-400" />
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <div class="rounded-xl bg-slate-50 p-3 text-center">
                            <p class="text-lg md:text-xl font-semibold text-slate-900">4</p>
                            <p class="text-xs text-slate-500">Received</p>
                        </div>
                        <div class="rounded-xl bg-amber-50 p-3 text-center">
                            <p class="text-lg md:text-xl font-semibold text-amber-600">1</p>
                            <p class="text-xs text-amber-600">Waiting</p>
                        </div>
                    </div>

                    <div class="mt-3 space-y-3">
                        <div>
                            <div class="flex items-center justify-between">
                            <p class="text-xs md:text-sm font-medium text-slate-900">PT Pakan Laut Sejahtera</p>
                            <span class="rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-medium text-emerald-600">Lolos</span>
                            </div>
                            <p class="text-xs text-slate-500">Ikan Segar 250kg & Suplemen</p>
                            <div class="flex justify-between text-xs text-slate-400"><span>Gate 2 Timur (09:40 WITA)</span><span>Oleh: Wayan S.</span></div>
                        </div>
                        <div class="border-t border-slate-100 pt-3">
                            <div class="flex items-center justify-between">
                            <p class="text-xs md:text-sm font-medium text-slate-900">Phyto Marine Biologics</p>
                            <span class="rounded-full bg-amber-50 px-2 py-0.5 text-xs font-medium text-amber-600">Pemeriksaan</span>
                            </div>
                            <p class="text-xs text-slate-500">Filter Kit & Obat Khusus Satwa</p>
                            <div class="flex justify-between text-xs text-slate-400"><span>Gate 1 Timur (10:50 WITA)</span><span>Sedang Scan</span></div>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 text-xs md:text-sm">
                        <span class="text-slate-500">8 Delivery recorded</span>
                        <Menu :href="route('security.delivery')" class="flex items-center gap-1 font-medium text-teal-600 hover:underline">Preview all <ArrowRight class="size-3.5" /></Menu>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 md:p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-sm md:text-base font-semibold text-slate-900">Booking</h2>
                            <p class="text-xs md:text-sm text-slate-500">Shorcut bookings</p>
                        </div>
                        <div class="p-2 rounded-sm bg-amber-100">
                            <ConciergeBell size="15" class="text-amber-400" />
                        </div>
                    </div>
                    <div class="mt-3 space-y-3">
                        <div>
                            <div class="flex items-center justify-between">
                                <p class="text-xs md:text-sm font-medium text-slate-900">Shinta</p>
                                <span class="rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-medium text-emerald-600">1 person</span>
                            </div>
                            <p class="text-xs text-slate-500">50% Payment</p>
                            <div class="text-sm text-slate-400 flex items-end justify-start gap-x-2"><CalendarCheck class="size-4" /><span>12 nov</span></div>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 text-xs md:text-sm">
                        <span class="text-slate-500">8 Bookings</span>
                        <Menu :href="route('specific.bookings')" class="flex items-center gap-1 font-medium text-teal-600 hover:underline">Preview all <ArrowRight class="size-3.5" /></Menu>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 md:p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-sm md:text-base font-semibold text-slate-900">Purchase Order</h2>
                            <p class="text-xs md:text-sm text-slate-500">Purchase order today</p>
                        </div>
                        <div class="p-2 rounded-sm bg-sky-100">
                            <ShoppingCart size="15" class="text-sky-400" />
                        </div>
                    </div>
                    <div class="mt-3 space-y-3">
                        <div>
                            <div class="flex items-center justify-between">
                                <p class="text-xs md:text-sm font-medium text-slate-900">Shinta</p>
                                <span class="rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-medium text-emerald-600">1 person</span>
                            </div>
                            <p class="text-xs text-slate-500">50% Payment</p>
                            <div class="text-sm text-slate-400 flex items-end justify-start gap-x-2"><CalendarCheck class="size-4" /><span>12 nov</span></div>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 text-xs md:text-sm">
                        <span class="text-slate-500">8 Purchase orders</span>
                        <Menu :href="route('specific.purchase.order')" class="flex items-center gap-1 font-medium text-teal-600 hover:underline">Preview all <ArrowRight class="size-3.5" /></Menu>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 md:p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-sm md:text-base font-semibold text-slate-900">Diet Plan</h2>
                            <p class="text-xs md:text-sm text-slate-500">Purchase order today</p>
                        </div>
                        <div class="p-2 rounded-sm bg-sky-100">
                            <ShoppingCart size="15" class="text-sky-400" />
                        </div>
                    </div>
                    <div class="mt-3 space-y-3">
                        <div>
                            <div class="flex items-center justify-between">
                                <p class="text-xs md:text-sm font-medium text-slate-900">Shinta</p>
                                <span class="rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-medium text-emerald-600">1 person</span>
                            </div>
                            <p class="text-xs text-slate-500">50% Payment</p>
                            <div class="text-sm text-slate-400 flex items-end justify-start gap-x-2"><CalendarCheck class="size-4" /><span>12 nov</span></div>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 text-xs md:text-sm">
                        <span class="text-slate-500">8 Purchase orders</span>
                        <Menu :href="route('specific.purchase.order')" class="flex items-center gap-1 font-medium text-teal-600 hover:underline">Preview all <ArrowRight class="size-3.5" /></Menu>
                    </div>
                </div>
            </div>
        </div>

        <section v-if="user.web.includes('specific.bookings')" class="my-5">
            <h4 class="text-2xl font-semibold">Activity Today</h4>
            <p class="text-sm md:text-md text-slate-500">Activity booking today</p>
            <section class="my-5">
                <template v-if="!loadingbooking">
                    <template v-if="bookingtoday?.length > 0">
                        <div class="space-y-4">
                            <Card v-for="booking in bookingtoday" :key="booking?.id" :booking="booking" />
                        </div>
                    </template>
                    <template v-else>
                        <p class="text-center font-primary tex-md text-red-500">No activity booking today</p>
                    </template>
                </template>
                <template v-else>
                    <LoadingPrimary />
                </template>
            </section>
            <PaginationNumber :pagination="pagination" :name="'Bookings'" @next="next" @page="page" @prev="prev" />
        </section>

        <section v-if="user.web.includes('specific.diet')" class="my-5">
            <Table :basic="props?.basic" :mamals="props?.mamals" />
        </section>

        <section v-if="user.web.includes('specific.mammal.report')">
            <ReportMamalToday @open="handleopenmamalreportvet" />
        </section>

        <Create v-if="modalvisitor" @close="modalvisitor = false" :basic="basic?.id" :suppliers="props?.suppliers" :bookings="bookingtoday" @success="handlesuccesscreatevisitor" />
        <Alert v-if="modalalert" :tipe="tipe" @close="handleclosealert" />
        <CreateDelevery v-if="modaldelivery" @close="modaldelivery = false" :basic="props?.basic" @success="handlesuccesscreatedelivery" />
        <BookingCreate v-if="modalbooking" @close="modalbooking = false" @success="handlesuccesscreatebooking" :programcategories="props?.programcategories" :bookingmethodes="props?.bookingmethodes" :basic="props?.basic" />
        <LogisticsCreate v-if="modallogistic" @close="modallogistic = false" />
        <OrderCreate v-if="modalorder" @close="modalorder = false" />
        <PoolCreate v-if="modalpool" @close="modalpool = false" :basic="props?.basic" :pools="props?.pools" />
        <PoolPlanCreate v-if="modalplan" @close="modalplan = false" :basic="props?.basic" :pools="props?.pools" @success="handlesuccesscreatepoolplan" />
        <MamalReportCreate v-if="modalmamal" @close="modalmamal = false" :basic="props?.basic" :mamals="props?.mamals" @success="handlesuccesscreatemamalreport" />
        <MamalReportVet v-if="modalmamalvet" @close="handleclosemamalreportvet" :basic="props?.basic" :report="record" :programs="props?.programs" @success="handlesuccesscreatemamalvet" />
        <MamalDietCreate v-if="modaldiet" @close="modaldiet = false" :mamals="props?.mamals" :basic="props?.basic" @success="handlesuccesscreatedietplan" />
        <WorkOrderCreate v-if="modalworkorder" @close="modalworkorder = false" :basic="props?.basic" @success="handlesuccesscreateworkorder" />

        <FullScreenLoading v-if="loading">
            <LoadingPrimary />
        </FullScreenLoading>

    </AuthenticatedLayout>
</template>