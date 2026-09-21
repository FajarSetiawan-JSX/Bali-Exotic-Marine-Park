<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import { Plus, Users, SquarePen, ArrowLeft, Trash } from 'lucide-vue-next';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import { onBeforeUnmount } from 'vue';
import Create from '@/Components/Layout/Admin/Supplier/Create.vue';
import Update from '@/Components/Layout/Admin/Supplier/Update.vue';
import Delete from '@/Components/Layout/Admin/Supplier/Delete.vue';
import { useCounter } from '@/Helper/counter';

const user = usePage().props?.auth;
const props = defineProps(['total']);
const total = useCounter();
const search = ref('');
const openMenu = ref(null);
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const suppliers = ref([]);
const record = ref({});
const pagination = ref({});
const loading = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('super.admin.supplier.index'), {
            params: {
                page: page,
                search: search.value
            }
        });
        suppliers.value = response.data.data ?? [];
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
    suppliers.value.unshift(data);
    succes('Success', 'Success created new supplier');
}
function handleopenupdate(data){
    modalupdate.value = true;
    record.value = data;
}
function handlesuccessupdate(){
    modalupdate.value = false;
    record.value = {};
    succes('Success', 'Success update supplier');
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
    succes('Success', 'Success deleted supplier');
    get();
}
function handleclosedelete(){
    modaldelete.value = false;
    record.value = {};
}
onMounted(()=>{
    get();
    total.start(props?.total);
    document.addEventListener('click', handleClickOutside)
})
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
    <Head title="Supplier" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Supplier</h1>
        </template>

        <section>
            <div class="relative w-full overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-900 to-cyan-950 p-6 md:p-8 shadow-xl font-second">
                <div class="pointer-events-none absolute inset-0 opacity-[0.15]" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 18px 18px;"/>
                <div class="relative flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
                    <div class="flex-1">
                        <span class="inline-flex items-center gap-2 rounded-full border border-cyan-400/30 bg-cyan-400/10 px-3 py-1 text-sm font-medium text-cyan-300">
                            <span class="h-1.5 w-1.5 rounded-full bg-cyan-400" />
                                Partner & Procurement Ecosystem
                        </span>
                        <h2 class="mt-4 text-lg md:text-xl font-bold text-white">
                            Supplier Management
                        </h2>
                        <p class="mt-2 max-w-xl text-sm md:text-base leading-relaxed text-slate-300">
                            Kelola data rekanan, vendor pakan biota bahari, logistik pendingin, peralatan konservasi laut, serta mitra operasional Bali Exotic Marine Park secara terpusat dan terverifikasi.
                        </p>
                    </div>
                    <div class="flex flex-col gap-3 md:w-64">
                        <button type="button" @click="modalcreate = true" class="flex items-center justify-center gap-2 rounded-xl bg-white px-4 py-3 text-sm md:text-base font-semibold text-slate-900 shadow-sm hover:bg-slate-100 transition-all duration-300 active:scale-95">
                            <span class="flex h-6 w-6 items-center justify-center rounded-md bg-cyan-500 text-white">
                                <Plus class="h-4 w-4" />
                            </span>
                            Add new supplier
                        </button>
                    </div>
                </div>
                <div class="relative mt-6 grid grid-cols-1 gap-3 sm:grid-cols-3 md:max-w-xl">
                    <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-cyan-500/20">
                            <Users class="h-4 w-4 text-cyan-300" />
                        </span>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-1.5">
                                <span class="text-lg md:text-xl font-bold text-white">{{ total.count }}</span>
                                
                            </div>
                            <span class="text-sm text-slate-400">Total supplier</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5 relative overflow-visible">
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
                            <th scope="col" class="px-4 py-3">Supplier</th>
                            <th scope="col" class="px-4 py-3">Address</th>
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
                            <template v-if="suppliers.length > 0">
                                <tr v-for="(supplier, index) in suppliers" :key="supplier?.id" class="border-b">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ (pagination.current_page - 1) * pagination.per_page + index + 1 }}</th>
                                    <td class="px-4 py-3">{{ supplier?.name }}</td>
                                    <td class="px-4 py-3">{{ supplier?.address }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end relative">
                                        <button @click.stop="toggleMenu(supplier?.id)" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div v-if="openMenu === supplier?.id" @click.stop class="absolute right-13 bottom-0  z-[99] w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                            <ul class="py-1 text-sm">
                                                <li>
                                                    <button @click="handleopenupdate(supplier)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-yellow-50">
                                                        <SquarePen size="15" class="text-yellow-500" />
                                                        Update
                                                    </button>
                                                </li>
                                                <li>
                                                    <button @click="handleopendelete(supplier)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-red-50">
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
                                        <p class="text-center font-primary tex-md text-red-500">No supplier available</p>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Supplier'" @next="next" @page="page" @prev="prev" />
        </section>
        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" />
        <Update v-if="modalupdate" @close="handlecloseupdate" @success="handlesuccessupdate" :suppier="record" />
        <Delete v-if="modaldelete" @close="handleclosedelete" @success="handlesuccessdelete" :supplier="record" />
    </AuthenticatedLayout>
</template>