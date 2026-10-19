<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import axios from 'axios';
import { eror, succes } from '@/Helper/Toast';
import Create from '@/Components/Layout/Admin/Contract/Create.vue';
import SearchAnimation from '@/Components/SearchAnimation.vue';
import { ArrowLeft } from 'lucide-vue-next';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import Card from '@/Components/Layout/Admin/Contract/Card.vue';
import LoadingCard from '@/Components/LoadingCard.vue';
import Update from '@/Components/Layout/Admin/Contract/Update.vue';
import Delete from '@/Components/Layout/Admin/Contract/Delete.vue';
ChartJS.register( Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale )
const colors = [
    "#ef4444", // merah
    "#3b82f6", // biru
    "#22c55e", // hijau
    "#f59e0b", // kuning
    "#8b5cf6", // ungu
    "#06b6d4", // cyan
    "#ec4899", // pink
    "#14b8a6", // teal
    "#f97316", // orange
    "#84cc16", // lime
];
const backgroundColor = Array.from({ length: 12 }, () => {
    return colors[Math.floor(Math.random() * colors.length)];
});

const props = defineProps(['user']);
const target = ref([5,10])
const search = ref('');
const contracts = ref([]);
const loading = ref(false);
const pagination = ref({});
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const record = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('super.admin.contract.index'),{
            params: {
                page: page,
                search: search.value,
            }
        });
        contracts.value = response?.data?.data;
        pagination.value = response?.data?.meta;
    }catch(error){
        console.log(error?.response);
        eror(error?.response?.status, error?.response?.statusText);
    }finally{
        loading.value = false;
    }
}
const data = ref({
    labels: ["Probation", "PKWT"],
    datasets: [
        {
            label: "Users : ",
            data: [],
            backgroundColor: backgroundColor,
            borderRadius: 0,
            borderSkipped: false,
            barThickness: 20
        }
    ]
})
const options = {
    responsive: true,
    maintainAspectRatio: false,

    animation: {
        duration: 1500,
        easing: 'easeOutQuart'
    },

    plugins: {
        legend: {
            display: false
        }
    },

    scales: {
        x: {
            grid: {
                display: false
            },
            ticks: {
                color: '#ffffff'
            }
        },

        y: {
            beginAtZero: true,
            grid: {
                color: 'rgba(255, 255, 255, 0.15)'
            },
            ticks: {
                color: '#ffffff'
            }
        }
    }
}
function next(page){
    if(page){
        get(page)
    }
}
function page(page){
    if(page){
        get(page)
    }
}
function prev(page){
    if(page){
        get(page)
    }
}

function handlesearching(value){
    search.value = value;
    get();
}

//FUNCTION EMIT CRUD
function handlesuccescreate(data){
    modalcreate.value = false;
    contracts.value.unshift(data);
    succes('Success', 'New contract successfully added.');
}
function handleopenupdate(data){
    if(data){
        record.value = data;
        modalupdate.value = true;
    }
}
function handlecloseupdate(){
    modalupdate.value = false;
    record.value = {}
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', 'contract has been successfully updated.');
    record.value = {};
    get();
}
function handleopendelete(data){
    if(data){
        record.value = data;
        modaldelete.value = true;
    }
}
function handleclosedelete(){
    modaldelete.value = false;
    record.value = {}
}
function handlesuccessdelete(){
    modaldelete.value = false;
    succes('Success', 'contract has been successfully deleted.');
    record.value = {};
    get();
}
watch(() => search.value, (newfilter) => {
    setTimeout(() => {
        get();
    }, 500);
}, {immediate:true});

onMounted(()=>{
    data.value = {
        ...data.value,
        datasets: [{
            ...data.value.datasets[0],
            data: target.value
        }
        ]
    }
})
</script>

<template>
    <Head title="Contract" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Contract</h1>
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

        <header>
            <h3 class="text-slate-400 text-sm font-second">Master <span class="text-thrid-admin">> Contract</span></h3>
            <div class="my-5">
                <div class="relative overflow-hidden rounded-3xl px-9 py-8 text-white" style="background:linear-gradient(135deg,#0C0C2B 0%,#1E1B4B 50%,#0A2540 100%)">
                    <div class="absolute -right-16 -top-16 h-72 w-72 rounded-full border border-white/10"/>
                    <div class="absolute right-10 -top-5 h-40 w-40 rounded-full border border-violet-500/20"/>
                    <div class="absolute right-24 -bottom-10 h-52 w-52 rounded-full" style="background:radial-gradient(circle,rgba(99,102,241,.12),transparent 70%)"/>
                    <div class="relative z-10 flex flex-wrap items-center justify-between gap-5">
                        <div>
                            <div data-aos="zoom-in" class="mb-3 inline-flex items-center gap-2 rounded-full border border-violet-400/40 bg-violet-500/20 px-3 py-1">
                                <div class="h-1.5 w-1.5 rounded-full bg-violet-300"/>
                                <span class="text-xs font-bold tracking-[0.15em] text-violet-200 uppercase">
                                    Management Contract
                                </span>
                            </div>
                            <h2 data-aos="fade-up" class="text-3xl font-extrabold">
                                Employment Contract Agreement
                            </h2>
                            <p data-aos="fade-down" class="mt-2 max-w-md text-sm text-white/60">
                                Centrally manage organizational units, access rights, and the distribution of BEMP team members.
                            </p>
                        </div>
                        <div class="flex gap-8">
                            <Bar :data="data" :options="options" class="max-h-40" />
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section>
            <div class="flex items-center justify-between flex-wrap bg-white shadow-sm p-3 rounded-lg">
                <div class="flex items-center justify-start gap-x-3">
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
                </div>
                <div>
                    <button type="button" @click="modalcreate = true" class="flex items-center justify-center text-white bg-thrid-admin hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 gap-x-1.5 active:scale-95 transition-all duration-100">
                        <svg width="18px" height="18px" viewBox="0 0 24 24" id="plus" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color fill-current"><path id="primary" d="M12,20a1,1,0,0,1-1-1V13H5a1,1,0,0,1,0-2h6V5a1,1,0,0,1,2,0v6h6a1,1,0,0,1,0,2H13v6A1,1,0,0,1,12,20Z"></path></svg>
                        <p>
                            Add Contract
                        </p>
                    </button>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <template v-if="loading">
                    <LoadingCard />
                    <LoadingCard />
                    <LoadingCard />
                </template>
                <template v-else>
                    <template v-if="contracts.length > 0">
                        <Card v-for="contract in contracts" :key="contract?.id" :contract="contract" @delete="handleopendelete" @update="handleopenupdate" />
                    </template>
                    <template>
                        <div class="md:col-span-2 lg:col-span-3">
                            <p class="text-center font-primary tex-md text-red-500">No contract available</p>
                        </div>
                    </template>
                </template>
            </div>
        </section>
        
        <PaginationNumber :pagination="pagination" :name="'Contracts'" @next="next" @page="page" @prev="prev" />

        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccescreate" />
        <Update v-if="modalupdate" @close="handlecloseupdate" @success="handlesuccessupdate" :contract="record" />
        <Delete v-if="modaldelete" @close="handleclosedelete" @success="handlesuccessdelete" :contract="record" />
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