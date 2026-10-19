<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ArrowLeft, Box, SquarePen, Trash, Plus, Waves } from "lucide-vue-next";
import { onBeforeUnmount, ref, watch } from 'vue';
import { onMounted } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import { formatDateTime } from '@/Helper/FormatDateTime';
import { useCounter } from '@/Helper/counter';
import Create from '@/Components/Layout/Admin/Pool/Create.vue';
import Delete from '@/Components/Layout/Admin/Pool/Delete.vue';
import Update from '@/Components/Layout/Admin/Pool/Update.vue';

const search = ref('');
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const loading = ref(false);
const openMenu = ref(null);
const pools = ref([]);
const pagination = ref({});
const record = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('super.admin.pool.index'), {
            params: {
                page: page,
                search: search.value
            }
        })
        pagination.value = response?.data?.meta;
        pools.value = response?.data?.data;
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
    pools.value.unshift(data);
    succes('Success', 'The new pool was successfully added.')
    get()
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', 'pool has been successfully updated.')
    record.value = {}
    get()
}
function handlesuccessdelete(){
    modaldelete.value = false;
    succes('Success', 'pool has been successfully updated.')
    record.value = {}
    get()
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
    <Head title="Pool" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Pool</h1>
        </template>

        <section class="overflow-hidden rounded-2xl border border-sky-100 bg-white font-second">
            <div class="flex flex-col-reverse items-center gap-8 bg-sky-50 px-6 py-10 md:flex-row md:px-12 md:py-16">
                <div data-aos="fade-right" class="w-full text-center md:w-1/2 md:text-left">
                    <p class="flex items-center justify-center gap-2 text-xs font-semibold uppercase tracking-widest text-slate-500 md:justify-start">
                        <span class="size-1.5 rounded-full bg-teal-400"></span>Marine Park Operations
                    </p>
                    <h1 class="mt-3 text-3xl font-bold text-slate-900 md:text-4xl">Pool Management</h1>
                    <p class="mt-4 text-sm text-slate-500 md:text-base">
                        A space for every marine life.<br />Manage all your pools in one place.
                    </p>
                    <button type="button" @click="modalcreate = true" class="mt-6 inline-flex items-center gap-2 rounded-lg bg-sky-500 px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-sky-600">
                        <Plus class="size-5" />Create New Pool
                    </button>
                </div>

                <div data-aos="fade-left" data-aos-delay="150" class="flex w-full flex-col items-center gap-3 md:w-1/2">
                    <img src="/assets/pool.png" alt="Pool" class="w-56 sm:w-72 lg:w-80" />
                    <span class="flex items-center gap-1.5 text-xs uppercase tracking-widest text-slate-400">
                        <Waves class="size-4 text-teal-400" />Central Pool
                    </span>
                </div>
            </div>
            <div data-aos="fade-up" data-aos-delay="250" class="flex items-center justify-between gap-4 px-6 py-5 md:px-12">
                <div class="flex items-center gap-4">
                    <div class="flex size-14 items-center justify-center rounded-xl bg-teal-50">
                        <Waves class="size-7 text-teal-500" />
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Total Pools</p>
                        <p class="flex items-baseline gap-2 text-3xl font-bold text-slate-900">
                            00 <span class="text-sm font-normal text-slate-500">registered pools</span>
                        </p>
                    </div>
                </div>
                <p class="hidden items-center gap-2 text-sm text-slate-500 sm:flex">
                    <span class="size-2 rounded-full bg-teal-400"></span>All pools, one overview
                </p>
            </div>
        </section>
        

        <section class="my-3.5 relative overflow-visible">
            <div class="flex items-center justify-between flex-wrap bg-white p-3 rounded-t-lg">
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
                <h1 class="text-sm md:text-xl font-second font-semibold">Pool lists</h1>
            </div>
            <div class="overflow-x-scroll bg-white mb-4">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-4">No</th>
                            <th scope="col" class="px-4 py-3">Name</th>
                            <th scope="col" class="px-4 py-3">Length</th>
                            <th scope="col" class="px-4 py-3">Width</th>
                            <th scope="col" class="px-4 py-3">Height</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="loading">
                            <tr>
                                <td colspan="6">
                                    <div class="my-5">
                                        <LoadingPrimary />
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <template v-if="pools.length > 0">
                                <tr v-for="(pool, index) in pools" :key="pool?.id" class="border-b">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ (pagination.current_page - 1) * pagination.per_page + index + 1 }}</th>
                                    <td class="px-4 py-3">{{ pool?.name }}</td>
                                    <td class="px-4 py-3">{{ pool?.length }} cm</td>
                                    <td class="px-4 py-3">{{ pool?.width }} cm</td>
                                    <td class="px-4 py-3">{{ pool?.height }} cm</td>
                                    <td class="px-4 py-3 flex items-center justify-end relative">
                                        <button @click.stop="toggleMenu(pool?.id)" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div v-if="openMenu === pool?.id" @click.stop class="absolute right-13 bottom-0  z-[99] w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                            <ul class="py-1 text-sm">
                                                <li>
                                                    <button @click="handleopenupdate(pool)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-yellow-50">
                                                        <SquarePen size="15" class="text-yellow-500" />
                                                        Update
                                                    </button>
                                                </li>
                                                <li>
                                                    <button @click="handleopendelete(pool)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-red-50">
                                                        <Trash size="15" class="text-red-500" />
                                                        Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="6">
                                        <p class="text-center font-primary tex-md text-red-500">No pool available</p>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </section>
        
        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Pools'" @next="next" @page="page" @prev="prev" />
        </section>
        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" />
        <Update v-if="modalupdate" @close="handlecloseupdate" @success="handlesuccessupdate" :pool="record" />
        <Delete v-if="modaldelete" @close="handlclosedelete" @success="handlesuccessdelete" :pool="record" />
    </AuthenticatedLayout>
</template>

<style scoped>

</style>