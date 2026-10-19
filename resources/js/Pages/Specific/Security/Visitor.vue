<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { ArrowLeft, Search, Plus, UsersRound, ShieldCheck, ClipboardCheck, Star, TrendingUp } from 'lucide-vue-next';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import Card from '@/Components/Layout/Specific/Security/Visitor/Card.vue';
import Create from '@/Components/Layout/Specific/Security/Visitor/Create.vue';
import Alert from '@/Components/Layout/Specific/Security/Visitor/Alert.vue';

const user = usePage().props?.auth;
const modalcreate = ref(false);
const search = ref('');
const visitors = ref([]);
const loading = ref(false);
const pagination = ref({});
const modalalert = ref(false);
const tipe = ref('');
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('specific.security.visitor.index'), {
            params: {
                page: page
            }
        });
        visitors.value = response?.data?.data ?? [];
        pagination.value = response?.data?.meta ?? {};
        console.log(response?.data);
    }catch(error){
        console.log(error?.response?.data);
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
function handlesuccesscreate (data){
    modalcreate.value = false;
    tipe.value = data;
    succes('Success', 'Success create new basic information');
    get();
    setTimeout(() => {
        modalalert.value = true;
    }, 500);
}
function handleclosealert (){
    modalalert.value = false;
    tipe.value = '';
}
onMounted(()=>{
    get()
})
</script>

<template>
    <Head title="Visitor" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Visitor</h1>
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
        
        <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4 my-5">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 sm:text-sm">
                            Total Visitors Today
                        </p>

                        <div class="mt-2 flex flex-wrap items-center gap-2">
                            <h2 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                                1,420
                            </h2>
                        </div>
                    </div>

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-500 sm:h-11 sm:w-11">
                        <UsersRound :size="20" />
                    </div>
                </div>
                <div class="my-4 h-px bg-slate-100" />
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 sm:text-sm">
                            Active On-Site
                        </p>
                        <div class="mt-2 flex flex-wrap items-center gap-2">
                            <h2 class="text-2xl font-bold text-cyan-600 sm:text-3xl">
                                385
                            </h2>
                        </div>
                    </div>
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-500 sm:h-11 sm:w-11">
                        <ShieldCheck :size="20" />
                    </div>
                </div>
                <div class="my-4 h-px bg-slate-100" />
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 sm:text-sm">
                            Security Cleared
                        </p>

                        <div class="mt-2 flex flex-wrap items-center gap-2">
                            <h2 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                                99.4%
                            </h2>

                            <span class="rounded-full border border-emerald-100 bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-600">
                                Optimal
                            </span>
                        </div>
                    </div>
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-500 sm:h-11 sm:w-11">
                        <ClipboardCheck :size="20" />
                    </div>
                </div>
                <div class="my-4 h-px bg-slate-100" />
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 sm:text-sm">
                            VIP Delegations
                        </p>

                        <div class="mt-2 flex flex-wrap items-center gap-2">
                            <h2 class="text-2xl font-bold text-amber-500 sm:text-3xl">
                                14
                            </h2>
                        </div>
                    </div>

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-500 sm:h-11 sm:w-11">
                        <Star :size="20" />
                    </div>
                </div>
                <div class="my-4 h-px bg-slate-100" />
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
            <template v-if="loading">
                <div class="my-6">
                    <LoadingPrimary />
                </div>
            </template>
            <template v-else>
                <template v-if="visitors.length > 0">
                    <div class="grid grid-cols-1 gap-4">
                        <Card v-for="visitor in visitors" :key="visitor?.id" :visitor="visitor" />
                    </div>
                </template>
                <template v-else>
                    <div class="my-6">
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed text-center">
                            No visitor report found.
                        </p>
                    </div>
                </template>
            </template>
        </section>
        
        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Visitors'" @next="next" @page="page" @prev="prev" />
        </section>

        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" />
        <Alert v-if="modalalert" @close="handleclosealert" :tipe="tipe" />
    </AuthenticatedLayout>
</template>

