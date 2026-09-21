<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { Plus, Boxes, Trash } from 'lucide-vue-next'
import { onBeforeUnmount, onMounted, ref } from 'vue';
import axios from 'axios';
import { eror, succes } from '@/Helper/Toast';
import { ArrowLeft } from 'lucide-vue-next'
import PaginationNumber from '@/Components/PaginationNumber.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import CreateAPI from '@/Components/Layout/Admin/DivisionPosition/CreateAPI.vue';
import DeleteAPI from '@/Components/Layout/Admin/DivisionPosition/DeleteAPI.vue';

const loading = ref(false);
const search = ref('');
const openMenu = ref(null);
const props = defineProps(['divisionposition', 'apis']);
const apis = ref([]);
const accesses = ref([]);
const pagination = ref({});
const modalcreate = ref(false);
const modaldelete = ref(false);
const record = ref({});
async function get(id, page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('super.admin.accessapi.index', id), {
            params:{
                page: page
            }
        });
        console.log(response.data)
        accesses.value = response?.data?.data ?? [];
        pagination.value = response?.data?.meta;
    }catch(error){
        eror(error.response.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
function next(page){
    if(page){
        get(props?.divisionposition?.id, page)
    }
}
function page(page){
    if(page){
        get(props?.divisionposition?.id, page)
    }
}
function prev(page){
    if(page){
        get(props?.divisionposition?.id, page)
    }
}
function handlesuccesscreate(){
    modalcreate.value = false;
    succes('Success', 'The new permission access API was successfully added.')
    get(props?.divisionposition?.id)
}
function handleopendelete(data){
    if(data){
        modaldelete.value = true;
        record.value = data;
    }
}
function handleclosedelete(){
    record.value = {};
    modaldelete.value = false;
}
function handlesuccessdelete(){
    record.value = {};
    modaldelete.value = false;
    succes('Success', 'The permission API was successfully deleted.');
    get(props?.divisionposition?.id);
}
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
    document.addEventListener('click', handleClickOutside)
    apis.value = props?.apis;
    get(props?.divisionposition?.id);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
    <Head title="Access page" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Permission Access API Management</h1>
        </template>
        <div class="rounded-xl bg-gradient-to-br from-sky-950 via-sky-900 to-sky-700 p-5 sm:p-6 lg:p-7 text-white shadow-sm">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="min-w-0">
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold tracking-tight">
                        API Access Management
                    </h1>

                    <p class="mt-2 max-w-xl text-xs sm:text-sm leading-relaxed text-sky-200">
                        Kelola dan pantau semua akses endpoint API untuk integrasi
                        sistem Bali Exotic Marine Park secara terpusat.
                    </p>
                    <div class="mt-4 inline-flex items-center gap-2 rounded-md bg-sky-950/60 px-3 py-1.5 text-xs font-medium text-sky-100">
                        <Boxes class="h-3.5 w-3.5 text-sky-300" />
                        <span>Total Endpoints :<span class="font-bold">25</span>
                        </span>
                    </div>
                </div>
                <button type="button" @click="modalcreate = true" class="inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2 rounded-lg bg-sky-500 px-4 py-2.5 text-xs font-medium text-white shadow-sm transition hover:bg-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:ring-offset-2 focus:ring-offset-sky-900">
                    <Plus class="h-4 w-4" />
                    <span>Add Access</span>
                </button>
            </div>
        </div>

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
                            <th scope="col" class="px-4 py-3">Title</th>
                            <th scope="col" class="px-4 py-3">Route Name</th>
                            <th scope="col" class="px-4 py-3">Methode</th>
                            <th scope="col" class="px-4 py-3">Scope</th>
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
                            <template v-if="accesses.length > 0">
                                <tr v-for="(access, index) in accesses" :key="access?.id" class="border-b">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ (pagination.current_page - 1) * pagination.per_page + index + 1 }}</th>
                                    <td class="px-4 py-3">{{ access?.name }}</td>
                                    <td class="px-4 py-3">{{ access?.route }}</td>
                                    <template v-if="access?.methode == 'GET'">
                                        <td class="px-4 py-3"><span class="bg-emerald-500 text-white px-3 py-1 rounded-sm">{{ access?.methode }}</span></td>
                                    </template>
                                    <template v-if="access?.methode == 'POST'">
                                        <td class="px-4 py-3"><span class="bg-sky-500 text-white px-3 py-1 rounded-sm">{{ access?.methode }}</span></td>
                                    </template>
                                    <template v-if="access?.methode == 'PATCH'">
                                        <td class="px-4 py-3"><span class="bg-purple-500 text-white px-3 py-1 rounded-sm">{{ access?.methode }}</span></td>
                                    </template>
                                    <template v-if="access?.methode == 'DELETE'">
                                        <td class="px-4 py-3"><span class="bg-red-500 text-white px-3 py-1 rounded-sm">{{ access?.methode }}</span></td>
                                    </template>
                                    <td class="px-4 py-3">{{ access?.scope }}</td>
                                    <td class="px-4 py-3">{{ access?.description }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end relative">
                                        <button @click.stop="toggleMenu(access?.id)" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div v-if="openMenu === access?.id" @click.stop class="absolute right-13 bottom-0  z-[99] w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                            <ul class="py-1 text-sm">
                                                <li>
                                                    <button @click="handleopendelete(access)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-red-50">
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
                                    <td colspan="7">
                                        <p class="text-center font-primary tex-md text-red-500">No access end point API allowed</p>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </section>
        <div class="my-5">
            <PaginationNumber :pagination="pagination" :name="'Access API'" @next="next" @page="page" @prev="prev" />
        </div>

        <CreateAPI v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" :divisionposition="props?.divisionposition" :apis="apis" :my="accesses.map($item => $item?.id_api)" />
        <DeleteAPI v-if="modaldelete" @close="handleclosedelete" @success="handlesuccessdelete" :api="record" />
    </AuthenticatedLayout>
</template>