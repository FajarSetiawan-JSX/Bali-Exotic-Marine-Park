<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js'
import { onMounted, ref, computed, watch, onUnmounted } from 'vue';
import { clearfloor } from '@/Helper/ClearComa';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import axios from 'axios';
import { eror, succes } from '@/Helper/Toast';
import Create from '@/Components/Layout/Admin/Users/Create.vue';
import SearchAnimation from '@/Components/SearchAnimation.vue';
import { Cloud, ArrowLeft } from 'lucide-vue-next'
import PaginationNumber from '@/Components/PaginationNumber.vue';
import SearchLoad from '@/Components/SearchLoad.vue';
import Card from '@/Components/Layout/Admin/Users/Card.vue';
import LoadingCard from '@/Components/LoadingCard.vue';
import Update from '@/Components/Layout/Admin/Users/Update.vue';

const props = defineProps(['divisions', 'users', 'online', 'positions']);
const filterdivision = ref('');
const search = ref('');
const datas = ref([]);
const loading = ref(false);
const pagination = ref({});
const users = ref(0);
const result = ref(0);
const modalcreate = ref(false);
const modalupdate = ref(false);
const person = ref({});
const persen = computed(()=>{
    let persen = (props.online/props.users) * 100;
    return clearfloor(persen);
});
const online = ref(0);
const colors = [
    '#4f46e5',
    '#3b82f6',
    '#0ea5e9',
    '#06b6d4',
    '#14b8a6',
    '#10b981',
    '#84cc16',
    '#eab308',
    '#f59e0b',
    '#f97316',
    '#ef4444',
    '#ec4899',
    '#a855f7',
    '#8b5cf6',
    '#64748b'
]
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement,);

const chartData = ref({
  labels: [],
  datasets: [{
    label: 'Total',
    data: [],
    backgroundColor: []
  }]
})
const chartOption = {
    responsive: true,
    maintainAspectRatio: false, 
    animation: {
        duration: 2000
    },
    plugins: {
        legend: {
            display: true,
            position: 'right'
        }
    }
}
async function getusers(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(`/api/priority-first/users`,{
            params: {
                page: page,
                search: search.value,
                filter: filterdivision.value
            }
        });
        datas.value = response?.data?.data;
        pagination.value = response?.data?.meta;
    }catch(error){
        console.log(error?.response);
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
function next(page){
    if(page){
        getusers(page)
    }
}
function page(page){
    if(page){
        getusers(page)
    }
}
function prev(page){
    if(page){
        getusers(page)
    }
}
//function handle komponen
function handlepagination(value){
    if(value){
        getusers(value);
    }
}

function handlesearching(value){
    search.value = value;
    getusers();
}

//FUNCTION EMIT CRUD
function handlesuccescreate(){
    modalcreate.value = false;
    succes('Success', 'New user successfully added.');
}
function handleopenupdate(data){
    if(data){
        person.value = data;
        modalupdate.value = true;
    }
}
function handlecloseupdate(){
    modalupdate.value = false;
    person.value = {}
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', `${person.value.name} data has been successfully updated.`);
    person.value = {};
    getusers();
}
watch(() => filterdivision.value, (newfilter) => {
    if(newfilter != ''){
        return getusers();
    };
    return getusers();
});

watch(() => search.value, (newfilter) => {
    setTimeout(() => {
        getusers();
    }, 500);
}, {immediate:true});

onMounted(async () => {
    const backgroundColor = props.divisions.map(() => colors[Math.floor(Math.random() * colors.length)])
    getusers();
    console.log(props.divisions);
    setTimeout(() => {
    chartData.value = {
      labels: props?.divisions?.map((division) => division.nama),
      datasets: [{
        ...chartData.value.datasets[0],
        data: props?.divisions.map((division) => division?.user?.length),
        backgroundColor: backgroundColor
      }]
    }
  }, 0)
    let i = 0
    let a = 0;
    let o = 0;
    const target = props.users
    const online_user = props.online
    const interval = setInterval(() => {
        if (i >= target) return clearInterval(interval)
        users.value++
        i++
    }, 100);
    const online_time = setInterval(() => {
        if(o >= online_user) return clearInterval(online_time)
        online.value++
        o++
    }, 100);
    const presentase = setInterval(()=>{
        if(a >= persen.value) return clearInterval(presentase)
        result.value++
        a++
    }, 20)
})
</script>

<template>
    <Head title="User" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Users</h1>
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
        
        <header class="flex justify-between lg:mx-5">
            <div class="max-w-max">
                <h3 class="text-slate-400 text-sm font-second">Master <span class="text-thrid-admin">> Management User</span></h3>
                <h4 class="text-black font-semibold font-second my-1.5 text-xl">Directory overview</h4>
                <h5 class="text-slate-500 text-sm font-second">Manage organization structure and individual access levels.</h5>
            </div>
            <div class="max-w-max">
                <button type="button" @click="modalcreate = true" class="flex items-center justify-center text-white bg-thrid-admin hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 gap-x-1.5 active:scale-95 transition-all duration-100">
                    <svg width="18px" height="18px" viewBox="0 0 24 24" id="plus" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color fill-current"><path id="primary" d="M12,20a1,1,0,0,1-1-1V13H5a1,1,0,0,1,0-2h6V5a1,1,0,0,1,2,0v6h6a1,1,0,0,1,0,2H13v6A1,1,0,0,1,12,20Z"></path></svg>
                    <p>
                        Add new user
                    </p>
                </button>
            </div>
        </header>

        <main class="lg:mx-5 flex flex-col md:flex-row py-2.5 gap-3.5">
            <div class="bg-white flex inset-0 content-center rounded-lg shadow-lg p-5 w-full md:w-1/2 lg:w-2/3">
                <Doughnut :data="chartData" :options="chartOption" />
            </div>
            <div class="flex w-full md:w-1/2 lg:w-1/3 justify-end">
                <div class="w-full rounded-2xl shadow-lg bg-thrid-admin overflow-hidden max-h-max">
                    <div class="mt-1 p-5 bg-white rounded-2xl h-56">
                        <div class="text-sky-600 flex items-center gap-x-2.5">
                            <svg class="fill-current" width="20px" height="20px" viewBox="0 0 64 64" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"><defs></defs><title/><path class="cls-1" d="M43.62,35H37.16a2,2,0,0,1,0-4h1.63l-14-14a2,2,0,0,1,2.82-2.83L45,31.56A2,2,0,0,1,43.62,35Z"/><path class="cls-1" d="M43.62,35a2,2,0,0,1-2-2V26.3a2,2,0,0,1,4,0V33A2,2,0,0,1,43.62,35Z"/><path class="cls-1" d="M37.84,50.49a2,2,0,0,1-1.41-.59L19,32.44A2,2,0,0,1,20.38,29h6.46a2,2,0,1,1,0,4H25.21l14,14a2,2,0,0,1-1.41,3.42Z"/><path class="cls-1" d="M20.38,39.7a2,2,0,0,1-2-2V31a2,2,0,0,1,4,0V37.7A2,2,0,0,1,20.38,39.7Z"/><path class="cls-2" d="M32,60.21A28.21,28.21,0,1,1,60.21,32a2,2,0,0,1-4,0,24.2,24.2,0,1,0-1.83,9.24,2,2,0,0,1,3.69,1.53A28.12,28.12,0,0,1,32,60.21Z"/></svg>
                            <p class="font-second">Active users</p>
                        </div>
                        <div class="py-3">
                            <h1 class="text-4xl font-bold font-second">{{ online }} <span class="font-normal text-slate-300 text-xl">/ {{ users }}</span></h1>
                            <div class="w-full bg-fifth-admin rounded-lg overflow-hidden">
                                <div class="h-2 bg-thrid-admin" :style="{width: result + '%'}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="lg:mx-5 flex items-center md:justify-between justify-end bg-white p-3 my-5 border-1 border-slate-200">
            <SearchLoad v-model="search" class="w-sm hidden md:block" />
            <vSelect v-model="filterdivision" :options="props.divisions" label="nama" class="division-select" placeholder="All Division" />
        </div>
        <template v-if="!loading">
            <template v-if="datas.length > 0">
                <div class="px-4 lg:px-5 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 my-5">
                    <Card v-for="data in datas" :key="data.id" :user="data" @update="handleopenupdate" />
                </div>
            </template>
            <template v-else>
                <div class="relative min-h-[340px] mx-4 lg:mx-5 overflow-hidden border-y border-white/5 bg-[#0a0a0a] flex flex-col items-center justify-center text-center my-5 rounded-2xl">
                    <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.025),transparent_55%)]"/>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-12 h-12 rounded-xl bg-[#292929] flex items-center justify-center mb-6">
                            <Cloud class="w-7 h-7 text-white" :stroke-width="2" />
                        </div>
                        <h3 class="text-xl font-semibold text-white">
                            Empty
                        </h3>
                        <p class="mt-3 text-[17px] text-gray-400">
                            User data is currently unavailable.
                        </p>
                        <button type="button" class="mt-7 px-4 py-2 rounded-xl border border-white/15 text-white font-semibold hover:bg-white/5 active:scale-95 duration-300 transition-all">
                            Add user
                        </button>
                    </div>
                </div>
            </template>
        </template>
        <template v-else>
            <div class="px-4 lg:px-5 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 my-5">
                <LoadingCard />
                <LoadingCard />
                <LoadingCard />
            </div>
        </template>
        <PaginationNumber :pagination="pagination" :name="'Users'" @next="next" @page="page" @prev="prev" />

        <Create v-if="modalcreate" :divisions="props?.divisions" :positions="props?.positions" @close="modalcreate = false" @success="handlesuccescreate" />
        <Update v-if="modalupdate" :divisions="props?.divisions" :positions="props?.positions" @close="handlecloseupdate" @success="handlesuccessupdate" :user="person" />
    </AuthenticatedLayout>
</template>

<style scoped>
/* Container utama */
:deep(.division-select) {
    width: auto;
    min-width: 180px;
}

/* Tombol select */
:deep(.division-select .vs__dropdown-toggle) {
    background-color: var(--color-primary-admin, #f8fafc);
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    min-height: 42px;

    display: flex;
    align-items: center;

    padding: 0.5rem 1rem;
}

/* Input search */
:deep(.division-select .vs__search) {
    margin: 0;
    padding: 0;
}

/* Hilangkan aneh-aneh */
:deep(.division-select .vs__selected-options) {
    padding: 0;
}

/* Panah */
:deep(.division-select .vs__actions) {
    padding-left: 8px;
}

:deep(.division-select .vs__open-indicator) {
    fill: #6b7280;
}

/* Dropdown */
:deep(.division-select .vs__dropdown-menu) {
    width: 100% !important;
    min-width: 100% !important;

    left: 0;
    margin-top: 6px;

    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0 10px 15px rgb(0 0 0 / 0.1);
}

/* Item */
:deep(.division-select .vs__dropdown-option) {
    padding: 10px 16px;
}

:deep(.division-select .vs__dropdown-option--highlight) {
    background: #f3f4f6;
    color: #111827;
}
</style>