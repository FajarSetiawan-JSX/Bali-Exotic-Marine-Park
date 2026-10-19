<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { CheckCheck, ShoppingBag, Wallet, Clock, Package, ArrowLeft, Ellipsis, Check, Banknote, Zap, Truck } from "lucide-vue-next";
import { onBeforeUnmount, ref, watch } from 'vue';
import { onMounted } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import { formatDateTime } from '@/Helper/FormatDateTime';
import Create from '@/Components/Layout/Admin/Program/Create.vue';
import Update from '@/Components/Layout/Admin/Program/Update.vue';
import Delete from '@/Components/Layout/Admin/Program/Delete.vue';
import { useCounter } from '@/Helper/counter';
import Card from '@/Components/Layout/Specific/Order/Card.vue';

const counttotal = useCounter();
const search = ref('');
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const loading = ref(false);
const openMenu = ref(null);
const programs = ref([]);
const pagination = ref({});
const record = ref({});
const from = ref('');
const to = ref('');
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('super.admin.program.index'), {
            params: {
                page: page,
                search: search.value
            }
        })
        pagination.value = response?.data?.meta;
        programs.value = response?.data?.data;
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
        //get();
    },1000)
},{ immediate: true });
function toggleMenu(id) {
    openMenu.value = openMenu.value === id ? null : id;
}
function closeMenu() {
    openMenu.value = null;
}
const handleClickOutside = () => {
    closeMenu()
}
onMounted(()=>{
    //get();
    document.addEventListener('click', handleClickOutside);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
})
</script>

<template>
    <Head title="Purchase Order" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Purchase Order</h1>
        </template>

        <section class="relative overflow-hidden rounded-xl bg-[#00263a] p-4 text-white shadow-lg sm:p-6 lg:p-8">
            <svg class="pointer-events-none absolute inset-0 h-full w-full text-white/10" fill="none" stroke="currentColor" preserveAspectRatio="none" viewBox="0 0 100 100">
                <path vector-effect="non-scaling-stroke" d="M55 0 L35 100 M62 0 L45 100 M100 22 L72 100 M100 80 L90 100" />
            </svg>
            <div class="relative">
                <p class="flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-teal-300">
                    <ShoppingBag class="size-4" /> Procurement Overview
                </p>
                <h2 class="mt-3 text-2xl font-bold sm:text-3xl lg:text-4xl">Purchase Order</h2>
            
                <div class="mt-6 flex flex-col gap-6 sm:flex-row sm:gap-8">
                    <div class="sm:border-r sm:border-white/15 sm:pr-8 lg:pr-12">
                        <p class="text-xs text-slate-300 sm:text-sm">Total purchase order</p>
                        <div class="mt-1 flex items-end gap-3">
                            <span class="text-5xl font-bold leading-none sm:text-6xl lg:text-7xl">06</span>
                            <span class="text-xs text-slate-300 sm:text-sm">purchase orders</span>
                        </div>
                    </div>
            
                    <div class="sm:pt-1">
                        <p class="flex items-center gap-2 text-xs text-slate-300 sm:text-sm">
                            <Wallet class="size-4" /> Total nominal pengadaan
                        </p>
                        <p class="mt-3 text-2xl font-bold sm:text-3xl lg:text-4xl">Rp 27.900.000</p>
                        <p class="mt-3 text-xs text-slate-400">Seluruh purchase order</p>
                    </div>
                </div>
            
                <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-2 border-t border-white/15 pt-4 text-xs text-slate-300 sm:text-sm">
                    <span class="flex items-center gap-2"><CheckCheck class="size-4 text-teal-300" /><b class="text-teal-300">3</b> Confirmed</span>
                    <span class="flex items-center gap-2"><Clock class="size-4 text-teal-300" /><b class="text-teal-300">2</b> Menunggu konfirmasi</span>
                    <span class="flex items-center gap-2"><Package class="size-4 text-teal-300" /><b class="text-teal-300">1</b> Arrived</span>
                    <span class="text-xs text-slate-400 sm:ml-auto">Data contoh</span>
                </div>
            </div>
        </section>

        <section>
            <div class="flex items-center justify-between flex-wrap gap-3 bg-white p-3 rounded-t-lg my-3">
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

        <section>
            <Card />
            <Card />
        </section>

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Purchase Orders'" @next="next" @page="page" @prev="prev" />
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>