<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { ArrowLeft, Trash2, FileDown, CalendarFold, ChevronDown, Undo2, CalendarDays, Sparkles, Plus } from 'lucide-vue-next';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import { computed } from 'vue';
import Generate from '@/Components/Layout/General/Schedule/Generate.vue';
import { usePage } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import Delete from '@/Components/Layout/General/Schedule/Delete.vue';
import Download from '@/Components/Layout/General/Schedule/Download.vue';
import Absen from '@/Components/Layout/General/Schedule/Absen.vue';
import { formatTime } from '@/Helper/FormatTime';

const user = usePage().props?.auth;
const props = defineProps(['worktime', 'months']);
const weekDays = [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
const search = ref('');
const month = ref({});
const dates = ref([]);
const record = ref({});
const detail = ref(false);
const loading = ref(false);
const modalcreate = ref(false);
const modaldelete = ref(false);
const modaldownload = ref(false);
const modalabsen = ref(false);
const form = ref({
    month: ''
})
async function get() {
    try{
        loading.value = true;
        const response = await axios.get(route('general.months.schedule'));
        month.value = response?.data?.data;
        dates.value = response?.data?.data?.date ?? [];
        console.log(month.value);
    }catch(error){
        console.log(error.response);
        if(error?.response?.status == 404){
            eror(error?.response?.status, '0 data schedule');
        }else{
            eror(error?.response?.status, error?.response?.data?.message);
        }
    }finally{
        loading.value = false;
    }
}
function opendownload(){
    if(!form.value.month){
        eror('Failed download', 'Month not yet selected')
        return ;
    }
    modaldownload.value = true;
}
function handleselecdate(data){
    detail.value = true;
    record.value = data;
}
// hitung berapa sel kosong dibutuhin sebelum tanggal 1
const firstDayOffset = computed(() => {
    if (dates.value.length === 0) return 0
    const firstDayName = dates.value[0].day // "Saturday"
    return weekDays.indexOf(firstDayName)   // "Saturday" ada di index 6
})

// gabungan sel kosong (null) + data tanggal asli
const calendarCells = computed(() => {
    const cells = []
    for (let i = 0; i < firstDayOffset.value; i++) {
        cells.push(null)
    }
    dates.value.forEach(item => {
        cells.push(item)
    })
    return cells
})
function handlesuccescreate(data){
    if(data){
        props?.months?.unshift(data);
    }
    modalcreate.value = false;
    get()
}
function handlesuccesdelete(){
    succes('Success', 'successfully deleted the monthly schedule');
    modaldelete.value = false;
    get()
}
function handlesuccesabsen(){
    succes('Success', 'successfully create submission');
    modalabsen.value = false;
    get()
}
onMounted(()=>{
    get()
})
</script>

<template>
    <Head title="Schedule" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Schedule</h1>
        </template>
        <template #search>
            <SearchAnimation placeholder="Search name" v-model="search">
                <template #search>
                    <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 17L22 22M19.5 10.75C19.5 15.5825 15.5825 19.5 10.75 19.5C5.91751 19.5 2 15.5825 2 10.75C2 5.91751 5.91751 2 10.75 2C15.5825 2 19.5 5.91751 19.5 10.75Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </template>

                <template #back>
                    <ArrowLeft :size="18"/>
                </template>
            </SearchAnimation>
        </template>
        <section v-if="user?.level == 1" class="p-5 bg-white rounded-2xl shadow-sm w-full grid grid-cols-1 lg:grid-cols-2 gap-3">
            <div class="font-second">
                <h1 class="text-xl font-semibold mb-2">Monthly schedule</h1>
                <p class="text-sm text-slate-500">Detailed and complete schedule for the current month</p>
            </div>
            <div class="flex items-center justify-end">
                <input type="month" name="" id="" class="rounded-lg border-0 ring-1 ring-slate-500">
            </div>
        </section>

        <section v-else class="w-full overflow-hidden rounded-xl border border-slate-200 bg-gradient-to-r from-sky-900 via-teal-700 to-teal-500 px-5 py-4 shadow-sm sm:px-6 sm:py-5">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="min-w-0 font-second">
                    <h2 class="text-lg font-bold tracking-tight text-white sm:text-lg">
                        Schedule Management
                    </h2>
                    <p class="mt-1 max-w-xl text-sm leading-relaxed text-slate-100 sm:text-xs">
                        Quickly generate automated schedules or manually create
                        custom shifts for your workforce to ensure optimal daily
                        coverage.
                    </p>
                </div>
                <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row sm:shrink-0 font-second">
                    <template v-if="user?.web.includes('head.schedule.daily.create')">
                        <NavLink v-if="month?.id && user?.user?.id" :href="route('head.schedule.daily.create', {user: user?.user?.id, month: month?.id})" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white/95 px-4 py-2.5 text-sm md:text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-white active:scale-95 sm:w-auto">
                            <Plus class="h-3.5 w-3.5" />
                            Create New Schedule
                        </NavLink>
                    </template>

                    <template v-if="user?.api.includes('specific.months.generate')">
                        <button type="button" @click="modalcreate = true" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-teal-700 shadow-sm transition hover:bg-slate-50 active:scale-[0.98] sm:w-auto">
                            <Sparkles class="h-3.5 w-3.5" />
                            Generate
                        </button>
                    </template>
                </div>
            </div>
        </section>

        <section class=" bg-white rounded-xl overflow-hidden my-5">
            <div class="p-5 grid grid-cols-1 lg:grid-cols-2 gap-3 bg-gradient-to-r from-[#132445] via-[#12304d] to-[#103854]">
                <div class="font-second text-white">
                    <h1 class="text-xl font-semibold mb-2 flex items-center justify-start gap-3"><CalendarDays size="20" class="text-emerald-300" /> Monthly schedule</h1>
                    <p class="text-sm text-slate-300">Detailed and complete schedule for the current month</p>
                </div>
                <div class="flex items-center justify-end gap-x-2">
                    <select name="" id="" v-model="form.month" class="flex rounded-lg">
                        <option value="">Filter Month</option>
                        <option :value="month" v-for="month in props?.months" :key="month?.id">{{ month?.month }}</option>
                    </select>
                    <template v-if="user?.api.includes('specific.months.generate')">
                        <button type="button" @click="opendownload" class="flex items-center justify-center gap-x-2 max-w-max py-1.5 px-3 rounded-lg text-slate-800 bg-white hover:bg-white/90 active:scale-95 transition-all duration-300">
                            <FileDown size="20" />
                            Download
                        </button>
                        <button type="button" @click="modaldelete = true" class="flex items-center justify-center gap-x-2 max-w-max py-1.5 px-3 rounded-lg text-white bg-red-500">
                            <Trash2 size="20" />
                        </button>
                    </template>
                </div>
            </div>

            <div class="w-full">
                <div class="w-full p-3">
                    <div class="overflow-x-auto">
                        <div class="min-w-[900px]">
                            <div class="grid grid-cols-7 border border-gray-200 rounded-t-xl overflow-hidden">
                                <div v-for="day in weekDays" :key="day" class="bg-gray-50 border-r border-gray-200 py-3 text-center text-xs font-semibold uppercase">
                                    {{ day }}
                                </div>
                            </div>
                            <template v-if="!loading">
                                <template v-if="calendarCells.length > 0">
                                    <div class="grid grid-cols-7 border-x border-b border-gray-200 rounded-b-xl overflow-hidden">
                                        <button v-for="(date, index) in calendarCells" :key="date ? date.id : `empty-${index}`" :disabled="!date"  type="button" @click="handleselecdate(date)" :class="[!date ? 'bg-gray-50' : (record?.id === date?.id ? 'bg-sky-100' : 'bg-white')]" class="min-h-[130px] border-r border-b border-gray-200 p-2 hover:bg-sky-50">
                                            <div class="mb-2 text-sm font-semibold text-gray-700">
                                                {{ date?.date }} <br>
                                                <template v-for="schedule in date?.schedule">
                                                    <span v-if="schedule?.work_time == 'Shifting' && schedule?.work == 0" class="text-red-500 block">{{ schedule?.user }}</span>
                                                </template>
                                            </div>
                                        </button>
                                    </div>
                                </template>
                                <template v-else>
                                    <h1 class="text-sm text-center text-red-500 font-primary my-5">0 data schedule</h1>
                                </template>
                            </template>
                            <template v-else>
                                <div class="my-6">
                                    <LoadingPrimary />
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div v-if="detail" class="bg-white shadow-sm rounded-2xl pb-5">
                <div class="p-5 md:flex md:items-center md:justify-between">
                    <div class="font-second flex items-center justify-start flex-wrap gap-5">
                        <div>
                            <div class="py-3 px-5 rounded-lg bg-sky-50">
                                <CalendarFold size="20" class="text-teal-800 mx-auto"/>
                                <span class="text-2xl font-second font-bold text-teal-800">{{ record?.date }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h2 class="text-sm font-semibold">Detailed Daily Information</h2>
                                <span class="text-[11px] font-medium px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">Live Duty</span>
                            </div>
                            <p class="text-sm text-slate-500">Details of employees scheduled on duty / shifting on {{ record?.original }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-3 md:mt-0">
                        <ChevronDown size="20" class="text-teal-800"/>
                    </div>
                </div>
                <div class="px-5 flex flex-col gap-3">
                    <div :class="schedule.work == 1 ? 'bg-white' : 'bg-red-50'" v-for="schedule in record?.schedule" :key="schedule.id" class="border border-slate-200 rounded-xl p-4 grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-2 items-center">
                        <div class="flex items-center gap-3">
                            <img  :src="`https://ui-avatars.com/api/?background=2DD4BF&color=fff&name=${schedule?.user?.name}`"  class="h-11 w-11 rounded-full object-cover border-2">
                            <div>
                                <p class="text-sm text-slate-400 uppercase tracking-wide">Name</p>
                                <p class="text-sm font-semibold text-slate-800">{{ schedule?.user }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-slate-700">
                                {{ schedule?.division }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-sky-500 uppercase tracking-wide font-medium">Work Time</p>
                            <p class="text-sm font-semibold text-slate-800">
                                {{ schedule?.templete }}
                                <span v-if="schedule.work == 1" :class="schedule.absen ? 'text-red-500 text-sm' : 'text-slate-500 text-xs'" class=" font-normal">
                                    <template v-if="schedule?.absen">
                                        - {{ schedule?.absen }}
                                    </template>
                                    <template v-else>
                                        {{ formatTime(schedule?.start) }} - {{ formatTime(schedule?.end) }}
                                    </template>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="flex-col space-y-2">
                            <div class="mx-auto max-w-max">
                                <NavLink :href="route('reschedule.create', record?.id)" class="flex items-center justify-center px-3 py-1.5 gap-x-2 border border-slate-200 hover:bg-emerald-50 rounded-lg text-slate-700 active:scale-95 transition-all duration-300 text-xs font-second">
                                    <Undo2 size="14" />
                                    <span>Reschedule</span>
                                </NavLink>
                            </div>
                            <button v-if="user?.level == 3" type="button" @click="modalabsen = true" class="flex items-center justify-center px-3 py-1.5 gap-x-2 bg-red-600 hover:bg-red-500 rounded-lg text-white active:scale-95 transition-all duration-300 text-xs font-second">
                                <span>Absence submission</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <Generate v-if="modalcreate" @close="modalcreate = false" @success="handlesuccescreate" />
        <Delete v-if="modaldelete" @close="modaldelete = false" @success="handlesuccesdelete" :id="month?.id" />
        <Download v-if="modaldownload" @close="modaldownload = false" :month="form.month" />
        <Absen v-if="modalabsen" @close="modalabsen = false" @success="handlesuccesabsen" :schedule="record" />
    </AuthenticatedLayout>
</template>