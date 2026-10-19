<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ArrowLeft, Box, SquarePen, Trash } from "lucide-vue-next";
import { onBeforeUnmount, ref, watch } from 'vue';
import { onMounted } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import { formatDateTime } from '@/Helper/FormatDateTime';
import Create from '@/Components/Layout/Admin/BookingMethode/Create.vue';
import Update from '@/Components/Layout/Admin/BookingMethode/Update.vue';
import Delete from '@/Components/Layout/Admin/BookingMethode/Delete.vue';
import { useCounter } from '@/Helper/counter';

const counttotal = useCounter();
const props = defineProps(['total']);
const search = ref('');
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const loading = ref(false);
const openMenu = ref(null);
const methodes = ref([]);
const pagination = ref({});
const record = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('super.admin.methode.booking.index'), {
            params: {
                page: page,
                search: search.value
            }
        })
        console.log(response?.data);
        pagination.value = response?.data?.meta;
        methodes.value = response?.data?.data;
    }catch(error){
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
    methodes.value.unshift(data);
    succes('Success', 'The new booking methode was successfully added.')
    get()
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', 'Booking methode has been successfully updated.')
    record.value = {}
    get()
}
function handlesuccessdelete(){
    modaldelete.value = false;
    succes('Success', 'methode has been successfully updated.')
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
    counttotal.start(props?.total, 50);
    document.addEventListener('click', handleClickOutside);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
})
</script>

<template>
    <Head title="Booking Methode" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Booking Methode</h1>
        </template>

        <section>
             <div class="w-full mx-auto rounded-2xl bg-[#0b1120] p-5 sm:p-8 font-second">
                <span data-aos="flip-up" class="inline-flex items-center gap-2 rounded-full bg-cyan-400/10 px-3 py-1 text-[11px] font-semibold tracking-wide text-cyan-300">
                    <span class="h-1.5 w-1.5 rounded-full bg-cyan-400"></span>
                    MANAGEMENT RESERVATION METHODE
                </span>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex items-start gap-3">
                        <div data-aos="flip-up" class="mt-1 shrink-0 h-9 w-9 rounded-lg bg-cyan-400/10 flex items-center justify-center">
                            <Box class="h-5 w-5 text-cyan-300" />
                        </div>
                        <div>
                            <h1 data-aos="flip-up" class="text-2xl sm:text-3xl font-bold text-white">BOOKING METHODE</h1>
                            <p class="mt-2 max-w-md text-sm sm:text-md text-slate-400 leading-relaxed">
                                This page lists all booking methode available in the system and manages access based on user scope to ensure security and navigation relevance.
                            </p>
                        </div>
                    </div>
                    <div class="text-white flex items-center justify-center">
                        <div>
                            <h1 class="text-5xl font-semibold text-center">{{ counttotal.count }}</h1>
                            <p class="text-sm">Available Booking Methode</p>
                        </div>
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
                <div>
                    <button type="button" @click="modalcreate = true" class="flex items-center justify-center text-white bg-thrid-admin hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 gap-x-1.5 active:scale-95 transition-all duration-100">
                        <svg width="18px" height="18px" viewBox="0 0 24 24" id="plus" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color fill-current"><path id="primary" d="M12,20a1,1,0,0,1-1-1V13H5a1,1,0,0,1,0-2h6V5a1,1,0,0,1,2,0v6h6a1,1,0,0,1,0,2H13v6A1,1,0,0,1,12,20Z"></path></svg>
                        <p>
                            Add Booking Methode
                        </p>
                    </button>
                </div>
            </div>
            <div class="overflow-x-scroll bg-white mb-4">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-4">No</th>
                            <th scope="col" class="px-4 py-3">Name</th>
                            <th scope="col" class="px-4 py-3">Description</th>
                            <th scope="col" class="px-4 py-3">Created at</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="loading">
                            <tr>
                                <td colspan="5">
                                    <div class="my-5">
                                        <LoadingPrimary />
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <template v-if="methodes.length > 0">
                                <tr v-for="(methode, index) in methodes" :key="methode?.id" class="border-b">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ (pagination.current_page - 1) * pagination.per_page + index + 1 }}</th>
                                    <td class="px-4 py-3">{{ methode?.name }}</td>
                                    <td class="px-4 py-3">{{ methode?.description }}</td>
                                    <td class="px-4 py-3">{{ formatDateTime(methode?.date) }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end relative">
                                        <button @click.stop="toggleMenu(methode?.id)" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div v-if="openMenu === methode?.id" @click.stop class="absolute right-13 bottom-0  z-[99] w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                            <ul class="py-1 text-sm">
                                                <li>
                                                    <button @click="handleopenupdate(methode)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-yellow-50">
                                                        <SquarePen size="15" class="text-yellow-500" />
                                                        Update
                                                    </button>
                                                </li>
                                                <li>
                                                    <button @click="handleopendelete(methode)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-red-50">
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
                                    <td colspan="5">
                                        <p class="text-center font-primary tex-md text-red-500">No booking methode available</p>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </section>
        
        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Methodes'" @next="next" @page="page" @prev="prev" />
        </section>
        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" />
        <Update v-if="modalupdate" @close="handlecloseupdate" @success="handlesuccessupdate" :data="record" />
        <Delete v-if="modaldelete" @close="handlclosedelete" @success="handlesuccessdelete" :data="record" />
    </AuthenticatedLayout>
</template>

<style scoped>

</style>