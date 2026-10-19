<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { ArrowLeft, Search, Plus, FileText } from 'lucide-vue-next';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import Card from '@/Components/Layout/General/Basics/Card.vue';
import Create from '@/Components/Layout/General/Basics/Create.vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import { useCounter } from '@/Helper/counter';

const user = usePage().props?.auth;
const props = defineProps(['templets', 'total']);
const count = useCounter();
const modalcreate = ref(false);
const basics = ref([]);
const loading = ref(false);
const pagination = ref({});

async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('specific.basics.information.daily'), {
            params: {
                page: page
            }
        });
        basics.value = response?.data?.data ?? [];
        pagination.value = response?.data?.meta ?? {};
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
function handlesuccesscreate (data){
    basics.value.unshift(data);
    modalcreate.value = false;
    succes('Success', 'Success create new basic information');
}
onMounted(()=>{
    count.start(props?.total);
    get()
})
</script>

<template>
    <Head title="Basics Information" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Basics Information</h1>
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
        <section>
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm font-second mb-3">
                <div class="relative overflow-hidden bg-linear-to-br from-[#06263f] via-[#073d5d] to-[#075675] px-5 py-6 sm:px-7 sm:py-7">
                    <div class="pointer-events-none absolute -right-16 -top-20 h-48 w-48 rounded-full bg-cyan-400/10 blur-3xl"/>
                    <div class="pointer-events-none absolute -bottom-24 left-1/3 h-40 w-40 rounded-full bg-blue-400/10 blur-3xl"/>
                    <div class="relative flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                        <div class="min-w-0">
                            <div class="mb-3 inline-flex items-center gap-2 rounded-full border border-cyan-300/20 bg-cyan-400/10 px-3 py-1 text-[10px] font-semibold uppercase tracking-wide text-cyan-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-cyan-300 shadow-[0_0_8px_rgba(103,232,249,0.8)]"/>
                                Live Basic Information Monitoring
                            </div>

                            <h1 class="text-xl font-bold tracking-tight text-white sm:text-2xl">
                                Basic Information
                            </h1>

                            <p class="mt-1 max-w-xl text-xs leading-5 text-slate-300 sm:text-sm">
                                Marine enclosure surveillance, water condition logging,
                                and security perimeter control.
                            </p>
                        </div>
                        <div class="flex shrink-0 gap-2 sm:gap-3">
                            <div class="min-w-24 rounded-xl border border-white/10 bg-white/10 px-4 py-3 text-center backdrop-blur-sm">
                                <div class="text-xl font-bold leading-none text-white sm:text-2xl">
                                    {{ count.count }}
                                </div>

                                <div class="mt-1.5 text-xs font-semibold uppercase tracking-wider text-slate-300">
                                    Total Today
                                </div>
                            </div>
                            <div class="min-w-24 rounded-xl border border-white/10 bg-white/10 px-4 py-3 text-center backdrop-blur-sm">
                                <div class="text-xl font-bold leading-none text-emerald-300 sm:text-2xl">
                                    90%
                                </div>

                                <div class="mt-1.5 text-xs font-semibold uppercase tracking-wider text-slate-300">
                                    Clear Rate
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative mt-6 flex flex-col gap-3 border-t border-white/10 pt-5 md:flex-row md:items-center md:justify-between">
                        <div class="relative w-full md:max-w-xs">
                            <Search :size="15" class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"/>
                            <input type="text" placeholder="Search name or date" class="h-9 w-full rounded-lg border border-white/10 bg-white/10 pl-9 pr-3 text-xs text-white outline-none placeholder:text-slate-400 transition focus:border-cyan-400/50 focus:bg-white/15"/>
                        </div>
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between md:justify-end">
                            <span class="text-sm font-semibold text-slate-300">
                                Shift Filter:
                            </span>

                            <div class="flex flex-wrap gap-1.5">
                                <button v-for="templete in props?.templets" :key="templete?.id" type="button" @click="selectedFilter = templete?.id" class="rounded-md border px-3 py-1.5 text-[10px] font-medium transition" :class=" selectedFilter === templete?.id ? 'border-cyan-400/30 bg-cyan-400 text-slate-900' : 'border-white/10 bg-white/5 text-slate-300 hover:bg-white/10'">
                                    {{ templete?.name }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-7">
                    <div class="flex items-center gap-2">
                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-cyan-50 text-cyan-600">
                            <FileText :size="14" />
                        </div>
                        <div>
                            <div class="text-xs font-bold uppercase tracking-wide text-slate-700">
                                All Basics Information
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" @click="modalcreate = true" class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-cyan-500 px-3 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-cyan-600 active:scale-95">
                            <Plus :size="14" />
                            New Basic Report
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <template v-if="loading">
                <div class="my-6">
                    <LoadingPrimary />
                </div>
            </template>
            <template v-else>
                <template v-if="basics.length > 0">
                    <div class="flex-col space-y-2">
                        <Card v-for="basic in basics" :key="basic.id" :basic="basic" />
                    </div>
                </template>
                <template v-else>
                    <div class="my-6">
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed text-center">
                            No basic information found.
                        </p>
                    </div>
                </template>
            </template>
        </section>

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Basics Information'" @next="next" @page="page" @prev="prev" />
        </section>

        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" :templets="props?.templets" />
    </AuthenticatedLayout>
</template>

