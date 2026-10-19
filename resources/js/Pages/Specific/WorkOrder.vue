<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ClipboardList, FileText, CheckCheck, X, Zap, Check, CalendarDays, ArrowRight, Funnel, ArrowLeft, RotateCcw } from "lucide-vue-next";
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
import Card from '@/Components/Layout/Specific/WorkOrder/Card.vue';

const counttotal = useCounter();
const search = ref('');
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const loading = ref(false);
const openMenu = ref(null);
const workorders = ref([]);
const pagination = ref({});
const from = ref('');
const to = ref('');
const record = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('specific.work.order.index'), {
            params: {
                page: page,
                search: search.value
            }
        })
        pagination.value = response?.data?.meta ?? {};
        workorders.value = response?.data?.data ?? [];
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
watch(search, (val) => {
    setTimeout(()=>{
        get();
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
    get();
    document.addEventListener('click', handleClickOutside);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
})
</script>

<template>
    <Head title="Work Order" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Work Order</h1>
        </template>

        <section>
            <div class="flex flex-col gap-5 rounded-xl border border-sky-200 bg-sky-100/70 p-4 sm:p-6 md:flex-row md:items-center md:justify-between lg:px-8 lg:py-7">
                <div class="max-w-md">
                    <p class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-sky-500 sm:text-sm">
                        <ClipboardList class="size-4 sm:size-5" /> Workforce Management
                    </p>
                    <h1 class="mt-2 text-2xl font-bold text-slate-800 sm:text-3xl lg:text-4xl">Work Order</h1>
                    <p class="mt-2 text-xs leading-6 text-slate-500 sm:text-sm lg:text-base lg:leading-7">
                        Pengajuan dari Head of Division yang telah ditinjau dan dikonfirmasi oleh supervisor.
                    </p>
                </div>
                <div class="flex divide-x divide-slate-300/70">
                    <div class="flex-1 pr-3 sm:pr-5 md:flex-none">
                        <p class="flex items-center gap-1.5 whitespace-nowrap text-xs text-slate-500 sm:text-sm"><FileText class="size-3.5 sm:size-4" /> Total pengajuan</p>
                        <p class="mt-1 text-3xl font-bold text-slate-800 sm:text-4xl lg:text-5xl">06</p>
                        <p class="text-xs text-slate-500 sm:text-sm">Work order</p>
                    </div>
                    <div class="flex-1 px-3 sm:px-5 md:flex-none">
                        <p class="flex items-center gap-1.5 whitespace-nowrap text-xs text-emerald-600 sm:text-sm"><CheckCheck class="size-3.5 sm:size-4" /> Disetujui (ACC)</p>
                        <p class="mt-1 text-3xl font-bold text-emerald-600 sm:text-4xl lg:text-5xl">04</p>
                        <p class="text-xs text-slate-500 sm:text-sm">Confirmed</p>
                    </div>
                    <div class="flex-1 pl-3 sm:pl-5 md:flex-none">
                        <p class="flex items-center gap-1.5 whitespace-nowrap text-xs text-red-500 sm:text-sm"><X class="size-3.5 sm:size-4" /> Ditolak</p>
                        <p class="mt-1 text-3xl font-bold text-red-500 sm:text-4xl lg:text-5xl">02</p>
                        <p class="text-xs text-slate-500 sm:text-sm">Rejected</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-3.5 relative overflow-visible">
            <div class="flex items-center justify-between flex-wrap gap-3 bg-white p-3 rounded-t-lg">
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
                <form action="" @submit.prevent="filter" class="flex items-center justify-start gap-x-2 flex-wrap font-second">
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
            <template v-if="loading">
                <LoadingPrimary />
            </template>
            <template v-else>
                <template v-if="workorders.length > 0">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        <Card v-for="(order, index) in workorders" :order="order" :key="index" />
                    </div>
                </template>
                <template v-else>
                    <p class="text-center font-primary tex-md text-red-500">No Work Orders available.</p>
                </template>
            </template>
        </section>
        
        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Work Orders'" @next="next" @page="page" @prev="prev" />
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>