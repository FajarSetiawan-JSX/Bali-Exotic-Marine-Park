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

        <section class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm sm:p-4 my-5">
            <div class="flex flex-col justify-between gap-3 xl:flex-row xl:items-center">
                <div class="relative w-full xl:max-w-sm">
                    <Search :size="17" class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"/>
                    <input v-model="search" type="text" placeholder="Search by visitor name" class="h-10 w-full rounded-xl border border-slate-200 bg-slate-50 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:bg-white focus:ring-2 focus:ring-cyan-100"/>
                </div>
                <button type="button" @click="modalcreate = true" class="inline-flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 px-4 text-sm font-bold text-white shadow-sm shadow-cyan-500/20 transition hover:from-cyan-600 hover:to-blue-700 active:scale-[0.98]">
                    <Plus :size="17" />
                    <span>
                        Create New Visitor Report
                    </span>
                </button>
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

