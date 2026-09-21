<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import { Plus, Trash, SquarePen } from 'lucide-vue-next';
import Card from '@/Components/Layout/Admin/Api/Card.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import { onBeforeUnmount } from 'vue';
import Create from '@/Components/Layout/Admin/Area/Create.vue';
import Update from '@/Components/Layout/Admin/Area/Update.vue';
import Delete from '@/Components/Layout/Admin/Area/Delete.vue';

const user = usePage().props?.auth;
const props = defineProps(['total']);
const search = ref('');
const openMenu = ref(null);
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const areas = ref([]);
const record = ref({});
const pagination = ref({});
const loading = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('super.admin.area.index'), {
            params: {
                page: page,
                search: search.value
            }
        });
        areas.value = response.data.data ?? [];
        pagination.value = response.data.meta;
        console.log(response?.data)
    }catch(error){
        console.log(error.response);
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
watch(()=>search.value, ($newsearch)=>{
    if($newsearch){
        setTimeout(() => {
            get()
        }, 1000);
    }
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
function handlesuccesscreate(data){
    modalcreate.value = false;
    areas.value.unshift(data);
    succes('Success', 'Success created new area');
}
function handleopenupdate(data){
    modalupdate.value = true;
    record.value = data;
}
function handlesuccessupdate(){
    modalupdate.value = false;
    record.value = {};
    succes('Success', 'Success update area');
    get();
}

function handlecloseupdate(){
    modalupdate.value = false;
    record.value = {};
}
function handleopendelete(data){
    modaldelete.value = true;
    record.value = data;
}
function handlesuccessdelete(){
    modaldelete.value = false;
    record.value = {};
    succes('Success', 'Success deleted area');
    get();
}
function handleclosedelete(){
    modaldelete.value = false;
    record.value = {};
}
onMounted(()=>{
    get();
    document.addEventListener('click', handleClickOutside)
})
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
    <Head title="Area" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Area</h1>
        </template>

        <section class="relative overflow-hidden rounded-2xl border border-slate-300/50 bg-gradient-to-br from-[#071b35] via-[#0b416d] to-[#159bd1] px-5 py-5 shadow-[0_10px_30px_rgba(15,23,42,0.18)] sm:px-6 sm:py-6 lg:px-7 lg:py-6">
            <div class="pointer-events-none absolute -right-16 -top-20 h-48 w-48 rounded-full bg-cyan-300/20 blur-3xl"/>
            <div class="pointer-events-none absolute -bottom-20 left-1/3 h-40 w-40 rounded-full bg-blue-400/10 blur-3xl"/>
            <div class="relative z-10">
                <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                    <div class="min-w-0">
                        <div class="mb-3 inline-flex items-center gap-1.5 rounded-full border border-cyan-300/20 bg-cyan-300/10 px-2.5 py-1 text-[9px] font-semibold uppercase tracking-[0.08em] text-cyan-200 sm:text-[10px]">
                            <span class="h-1.5 w-1.5 rounded-full bg-cyan-300 shadow-[0_0_8px_rgba(103,232,249,0.9)]"/>
                            Zone & Facility Infrastructure
                        </div>
                        <h1 class="text-xl font-extrabold tracking-tight text-white sm:text-2xl lg:text-3xl">
                            Area & Zone Management
                        </h1>
                        <p class="mt-1.5 max-w-2xl text-sm leading-relaxed text-slate-300 sm:text-sm">
                            Kelola pemetaan area konservasi, zona interaksi publik,
                            wahana bahari, serta sarana & fasilitas operasional
                            Bali Exotic Marine Park.
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2 sm:gap-2.5">
                            <div class="flex min-w-sm items-center gap-2 rounded-lg border border-white/10 bg-white/[0.07] px-3 py-2 backdrop-blur-sm">
                                <div class="flex h-10 w-1 items-center justify-center rounded-full bg-cyan-400 shadow-[0_0_8px_rgba(34,211,238,0.7)]"/>
                                <div>
                                    <p class="text-sm font-bold leading-none text-white">
                                        {{ props?.total }}
                                    </p>
                                    <p class="mt-1 text-sm font-medium tracking-wide text-slate-400 sm:text-sm">
                                        Total Area
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-2 lg:pt-9">
                        <button type="button" @click="modalcreate = true" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-white px-4 text-sm font-semibold text-slate-700 shadow-lg shadow-black/10 transition-all duration-200 hover:-translate-y-0.5 hover:bg-slate-50 active:translate-y-0 sm:h-11 sm:px-5">
                            <Plus :size="14" :stroke-width="2.5"/>
                            <span class="text-sm">
                                Add new area
                            </span>
                        </button>
                    </div>
                </div>
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
            </div>
            <div class="overflow-x-scroll bg-white mb-4">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-4">No</th>
                            <th scope="col" class="px-4 py-3">Area</th>
                            <th scope="col" class="px-4 py-3">Description</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="loading">
                            <tr>
                                <td colspan="7">
                                    <div class="my-5">
                                        <LoadingPrimary />
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <template v-if="areas.length > 0">
                                <tr v-for="(area, index) in areas" :key="area?.id" class="border-b">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ (pagination.current_page - 1) * pagination.per_page + index + 1 }}</th>
                                    <td class="px-4 py-3">{{ area?.name }}</td>
                                    <td class="px-4 py-3">{{ area?.description }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end relative">
                                        <button @click.stop="toggleMenu(area?.id)" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div v-if="openMenu === area?.id" @click.stop class="absolute right-13 bottom-0  z-[99] w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                            <ul class="py-1 text-sm">
                                                <li>
                                                    <button @click="handleopenupdate(area)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-yellow-50">
                                                        <SquarePen size="15" class="text-yellow-500" />
                                                        Update
                                                    </button>
                                                </li>
                                                <li>
                                                    <button @click="handleopendelete(area)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-red-50">
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
                                    <td colspan="4">
                                        <p class="text-center font-primary tex-md text-red-500">No area available</p>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Area'" @next="next" @page="page" @prev="prev" />
        </section>
        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" />
        <Update v-if="modalupdate" @close="handlecloseupdate" @success="handlesuccessupdate" :area="record" />
        <Delete v-if="modaldelete" @close="handleclosedelete" @success="handlesuccessdelete" :area="record" />
    </AuthenticatedLayout>
</template>