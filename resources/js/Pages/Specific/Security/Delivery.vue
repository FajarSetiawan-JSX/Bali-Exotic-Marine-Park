<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Package, PackageCheck, RotateCcw, Clock, ShieldCheck, ArrowLeft, Funnel } from "lucide-vue-next";
import { onBeforeUnmount, ref, watch } from 'vue';
import { onMounted } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import { formatDateTime } from '@/Helper/FormatDateTime';
import Update from '@/Components/Layout/Admin/Program/Update.vue';
import Delete from '@/Components/Layout/Admin/Program/Delete.vue';
import { useCounter } from '@/Helper/counter';
import Card from '@/Components/Layout/Specific/Security/Delivery/Card.vue';

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
    <Head title="Delivery" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Delivery</h1>
        </template>

       <section class="w-full space-y-4 sm:space-y-6">
            <div class="flex w-full flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div class="min-w-0">
                    <p
                    class="flex items-center gap-2 text-xs font-semibold tracking-widest text-teal-600 uppercase"
                    >
                    <span class="size-1.5 rounded-full bg-teal-600"></span>
                    Penerimaan Barang
                    </p>
            
                    <h1
                    class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl md:text-5xl"
                    >
                    Delivery<span class="text-teal-500">.</span>
                    </h1>
            
                    <p class="mt-2 text-xs text-slate-500 sm:text-sm md:text-base">
                    Monitor setiap pengiriman, dari kedatangan hingga diterima.
                    </p>
                </div>
                <div class="flex shrink-0 items-center gap-3">
                    <ShieldCheck class="size-5 text-teal-700 sm:size-6" :stroke-width="1.75" />
                    <div>
                    <p class="text-xs font-semibold text-slate-900 sm:text-sm">
                        Pos Keamanan Utama
                    </p>
                    <p class="text-xs text-slate-500">Bali Exotic Marine Park</p>
                    </div>
                </div>
            </div>
            <div class="grid w-full grid-cols-2 divide-slate-200 rounded-2xl border border-slate-200 bg-white shadow-sm lg:grid-cols-3 lg:divide-x">
                <div class="border-r border-b border-slate-200 p-4 sm:p-5 md:p-6 lg:border-r-0 lg:border-b-0">
                    <div class="flex items-start justify-between gap-2">
                    <p class="text-xs text-slate-600 sm:text-sm">Total pengiriman</p>
                    <Package class="size-4 shrink-0 text-teal-600 sm:size-5" :stroke-width="1.75" />
                    </div>
                    <p class="mt-3 text-2xl font-bold text-slate-900 sm:mt-4 sm:text-3xl md:text-4xl">
                    06
                    </p>
                    <p class="mt-1 text-xs text-slate-500">Semua pengiriman</p>
                </div>
                <div
                    class="border-b border-slate-200 p-4 sm:p-5 md:p-6 lg:border-b-0"
                >
                    <div class="flex items-start justify-between gap-2">
                    <p class="text-xs text-slate-600 sm:text-sm">Diterima</p>
                    <PackageCheck class="size-4 shrink-0 text-emerald-600 sm:size-5" :stroke-width="1.75" />
                    </div>
                    <p class="mt-3 text-2xl font-bold text-slate-900 sm:mt-4 sm:text-3xl md:text-4xl">
                    04
                    </p>
                    <p class="mt-1 text-xs text-slate-500">Barang telah diserahkan</p>
                </div>
                <div class="p-4 sm:p-5 md:p-6">
                    <div class="flex items-start justify-between gap-2">
                    <p class="text-xs text-slate-600 sm:text-sm">Menunggu</p>
                    <Clock class="size-4 shrink-0 text-amber-600 sm:size-5" :stroke-width="1.75" />
                    </div>
                    <p class="mt-3 text-2xl font-bold text-slate-900 sm:mt-4 sm:text-3xl md:text-4xl">
                    01
                    </p>
                    <p class="mt-1 text-xs text-slate-500">Konfirmasi penerima</p>
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
                    <input type="date" name="" v-model="from" id="" class="rounded-lg border-2 border-slate-300 focus:border-sky-500 focus:ring-sky-300">
                    <span>-</span>
                    <input type="date" name="" v-model="to" id="" class="rounded-lg border-2 border-slate-300 focus:border-sky-500 focus:ring-sky-300">
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
        </section>

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Purchase Orders'" @next="next" @page="page" @prev="prev" />
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>