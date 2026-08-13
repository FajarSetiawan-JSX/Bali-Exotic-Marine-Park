<script setup>
import Header from '@/Components/Header.vue';
import Baner from '@/Components/Layout/Admin/Division/Baner.vue';
import Card from '@/Components/Layout/Admin/Division/Card.vue';
import Create from '@/Components/Layout/Admin/Division/Create.vue';
import LoadingCard from '@/Components/LoadingCard.vue';
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ArrowLeft, Split } from "lucide-vue-next";
import { ref } from 'vue';
import { onMounted } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import Update from '@/Components/Layout/Admin/Division/Update.vue';
import Delete from '@/Components/Layout/Admin/Division/Delete.vue';
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import Empty from '@/Components/Empty.vue';
ChartJS.register( BarElement, ArcElement, CategoryScale, LinearScale, Tooltip, Legend)

const units = [4,3];
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
const doughnut = ref({
    labels: ['Front of House', 'Back of House'],
    datasets: [{
        label: "Total Divisions",
        data: [],
        backgroundColor: backgroundColor,
        borderWidth: 2
    }]
})
const Options = {
    responsive: true,
    maintainAspectRatio: false,
    animation: {
        duration: 1500,
        easing: 'easeOutQuart'
    },
    cutout: '70%',
    plugins: {
        legend: {
            position: 'left'
        }
    }
}
const props = defineProps(['units', 'Positions', 'WorkTime', 'time', 'Totaldivisi', 'levels', 'count']);
const search = ref('');
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const loading = ref(false);

const divisions = ref([]);
const pagination = ref({});
const division = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get('/api/priority-first/divisions', {
            params: {
                page: page,
                search: search.value
            }
        })
        console.log(response?.data);
        pagination.value = response?.data?.meta;
        divisions.value = response?.data?.data;
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
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
function handleopendelete(data){
    division.value = data;
    modaldelete.value = true;
}
function handlclosedelete(){
    modaldelete.value = false;
    division.value = {};
}

function handleopenupdate(data){
    division.value = data;
    modalupdate.value = true;
}
function handlecloseupdate(){
    division.value = {};
    modalupdate.value = false;
}

function handlesuccesscreate(){
    modalcreate.value = false;
    succes('Success', 'The new division was successfully added.')
    get()
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', `The ${division.value.name} division has been successfully updated.`)
    division.value = {}
    get()
}
function handlesuccessdelete(){
    modaldelete.value = false;
    eror('Maintenance', 'Can not delete division');
    //succes('Success', `The ${division.value.name} division has been successfully updated.`)
    division.value = {}
    //get()
}
onMounted(()=>{
    get();
    setTimeout(() => {
        doughnut.value = {
            ...doughnut.value,
            datasets: [
                {
                    ...doughnut.value.datasets[0],
                    data: props?.count
                }
            ]
        }
    }, 100);
})
</script>

<template>
    <Head title="Division" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Divisions</h1>
        </template>

        <header class="flex justify-between mb-5">
            <div class="max-w-max">
                <h3 class="text-slate-400 text-sm font-second">Master <span class="text-thrid-admin">> Management User</span></h3>
                <h4 class="text-black font-semibold font-second my-1.5 text-xl">Overview</h4>
                <h5 class="text-slate-500 text-sm font-second">Manage organizational units and member distribution.</h5>
            </div>
            <div class="max-w-max">
                <button type="button" @click="modalcreate = true" class="flex items-center justify-center text-white bg-thrid-admin hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 gap-x-1.5 active:scale-95 transition-all duration-100">
                    <svg width="18px" height="18px" viewBox="0 0 24 24" id="plus" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color fill-current"><path id="primary" d="M12,20a1,1,0,0,1-1-1V13H5a1,1,0,0,1,0-2h6V5a1,1,0,0,1,2,0v6h6a1,1,0,0,1,0,2H13v6A1,1,0,0,1,12,20Z"></path></svg>
                    <p>
                        Add New Division
                    </p>
                </button>
            </div>
        </header>
        
        <section class="my-3.5 md:my-6">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-1.5 sm:gap-3 md:gap-5">
                <div class="shadow-xl rounded-lg p-2">
                    <div class="flex items-center justify-start gap-x-2">
                        <div class="p-1 rounded-lg bg-emerald-100">
                            <Split size="20" class="text-emerald-300" />
                        </div>
                        <h3 class="font-second text-xl font-semibold">Division Units</h3>
                    </div>
                    <Doughnut :data="doughnut" :options="Options" class="max-h-60" />
                </div>
                <div class="xl:col-span-2 flex items-end">
                    <Baner :positions="props.Positions" :Time="props.time" :division="props.Totaldivisi" />
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 gap-2 md:grid-cols-2 bg-white p-3 my-5 border-1 border-slate-200">
            <div>
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
            <div class="flex gap-x-2 items-center justify-end">
                <select name="" id="" class="gap-x-1.5 rounded-lg border-slate-300">
                    <option disabled selected value="">Filter Level</option>
                </select>
                <select name="" id="" class="gap-x-1.5 rounded-lg border-slate-300">
                    <option disabled selected value="">Filter Unit</option>
                </select>
            </div>
        </div>
        
        <main class="my-3.5 md:my-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-1.5 sm:gap-3 md:gap-5">
            <template v-if="!loading">
                <template v-if="divisions.length > 0">
                    <Card v-for="division in divisions" :key="division.id" :division="division" @delete="handleopendelete" @update="handleopenupdate" />
                </template>
                <template v-else>
                    <div class="w-full sm:col-span-2 md:col-span-3 flex justify-center">
                        <Empty title="No Division Yet"
                            description="You haven't created any Divisions yet."
                            sub-description="Get started by creating your first division."
                            primary-text="Create Division"
                            @primary="modalcreate = true"
                        />
                    </div>
                </template>
            </template>
            <template v-else>
                <LoadingCard />
                <LoadingCard  />
                <LoadingCard />
            </template>
        </main>
        <PaginationNumber :pagination="pagination" :name="'Divisions'" @next="next" @page="page" @prev="prev" />
        <Create v-if="modalcreate" @close="modalcreate = false" :levels="props?.levels" :units="props.units" :worktime="props.WorkTime" @success="handlesuccesscreate" />
        <Update v-if="modalupdate" :division="division" :levels="props?.levels" @close="handlecloseupdate" @success="handlesuccessupdate" />
        <Delete v-if="modaldelete" :division="division" @close="handlclosedelete" @success="handlesuccessdelete" />
    </AuthenticatedLayout>
</template>

<style scoped>

</style>