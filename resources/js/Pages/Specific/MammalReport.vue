<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Waves, ShieldCheck, FileText, Funnel, RotateCcw } from "lucide-vue-next";
import { ref, watch } from 'vue';
import { onMounted } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import Card from '@/Components/Layout/Specific/Mamals/Card.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';

const search = ref('');
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const loading = ref(false);
const reports = ref([]);
const pagination = ref({});
const record = ref({});
const from = ref('');
const to = ref('');
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('specific.mammal.report.index'), {
            params: {
                page: page,
                search: search.value,
                from: from.value,
                to: to.value
            }
        })
        pagination.value = response?.data?.meta ?? {};
        reports.value = response?.data?.data ?? [];
    }catch(error){
        eror(error?.response?.status, error?.response?.statusText);
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
function filter(){
    if(!from.value || !to.value){
        eror('Failed filter', 'field from and to is required!');
        return
    }
    if(from.value > to.value){
        eror('Failed filter', 'Overlap field!');
        return
    }
    get();
}
function clear(){
    from.value = '';
    to.value = '';
    get();
}
function handleopendelete(data){
    record.value = data;
    modaldelete.value = true;
}
function handlclosedelete(){
    modaldelete.value = false;
    record.value = {};
}

function handleopenupdate(data){
    record.value = data;
    modalupdate.value = true;
}
function handlecloseupdate(){
    record.value = {};
    modalupdate.value = false;
}

function handlesuccesscreate(data){
    modalcreate.value = false;
    programs.value.unshift(data);
    succes('Success', 'The new program was successfully added.')
    get()
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', 'program has been successfully updated.')
    record.value = {}
    get()
}
function handlesuccessdelete(){
    modaldelete.value = false;
    succes('Success', 'program has been successfully updated.')
    record.value = {}
    get()
}
watch(search, (val) => {
    setTimeout(()=>{
        get();
    },1000)
},{ immediate: true });
onMounted(()=>{
    get();
})
</script>

<template>
    <Head title="Mammal Report" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Mammal Report</h1>
        </template>

        <section class="flex w-full flex-col gap-8 overflow-hidden rounded-2xl bg-gradient-to-r from-blue-950 via-sky-800 to-teal-600 p-8 shadow-lg md:flex-row md:items-center md:justify-between md:p-12">
            <div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 text-xs font-semibold uppercase text-sky-100">
                        <Waves class="h-4 w-4" />
                        Animal Welfare Division
                    </div>
                    <span class="rounded-md border border-white/30 bg-white/10 px-3 py-1.5 text-xs font-semibold text-white">
                        AWF
                    </span>
                </div>
                <h1 class="mt-5 text-5xl font-semibold text-white">Mammals Report</h1>
                <p class="mt-5 text-base leading-7 text-sky-100">
                    Daily care, thoughtfully documented.<br />
                    Mammal observations and veterinary assessments.
                </p>
                <div class="mt-6 flex items-center gap-2 text-sm text-sky-100">
                    <ShieldCheck class="h-4 w-4" />
                    Animal care &amp; wellbeing
                </div>
            </div>
            <div class="border-t border-white/20 pt-6 md:w-64 md:border-l md:border-t-0 md:py-4 md:pl-10 md:pt-4">
                <p class="text-sm text-sky-100">Total Reports</p>
                <p class="mt-2 text-7xl font-medium text-white">03</p>
                <div class="mt-2 flex items-center gap-2 text-sm text-sky-100">
                    <FileText class="h-4 w-4" />
                    Mammal &amp; vet reports
                </div>
            </div>
        </section>

        <section>
            <div class="flex items-center justify-between flex-wrap gap-3 bg-white p-3 rounded-t-lg my-5">
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
                <form action="" @submit.prevent="filter" class="flex items-center justify-start gap-2 flex-wrap font-second">
                    <input type="date" name="" v-model="from" id="" class="rounded-lg border-2 border-slate-300 active:border-sky-500 active:ring-sky-300">
                    <span>-</span>
                    <input type="date" name="" v-model="to" id="" class="rounded-lg border-2 border-slate-300 active:border-sky-500 active:ring-sky-300">
                    <button type="submit" class="flex items-center justify-center gap-2 rounded-xl bg-emerald-400 px-5 py-1 text-white shadow-md transition-all duration-300 active:scale-95">
                        <Funnel size="15" />
                        Filter
                    </button>
                    <button type="button" @click="clear" class="flex items-center justify-center gap-2 rounded-xl bg-slate-500 px-5 py-1 text-white shadow-md transition-all duration-300 active:scale-95">
                        <RotateCcw size="15" />
                        Reset
                    </button>
                </form>
            </div>
        </section>

        <section class="space-y-5">
            <template v-if="loading">
                <LoadingPrimary />
            </template>
            <template v-else>
                <template v-if="reports.length > 0">
                    <Card v-for="report in reports" :report="report" />
                </template>
                <template v-else>
                    <p class="text-center font-primary tex-md text-red-500">No Mammal reports available.</p>
                </template>
            </template>
        </section>

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Mammal Reports'" @next="next" @page="page" @prev="prev" />
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>