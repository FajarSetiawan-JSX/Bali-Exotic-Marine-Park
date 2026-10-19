<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import { Send, Clock, CircleCheck, Plus, ArrowLeft, Funnel, RotateCcw, SquarePen, Trash, Eye } from 'lucide-vue-next';
import Card from '@/Components/Layout/Admin/Api/Card.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import { onBeforeUnmount } from 'vue';
import Create from '@/Components/Layout/Specific/Notification/Create.vue';
import { formatDate } from '@/Helper/FormatDate';
import Update from '@/Components/Layout/Specific/Notification/Update.vue';
import Delete from '@/Components/Layout/Specific/Notification/Delete.vue';
import Show from '@/Components/Layout/Specific/Notification/Show.vue';
import { useCounter } from '@/Helper/counter';
const user = usePage().props?.auth;
const props = defineProps(['total']);
const count = useCounter();
const search = ref('');
const notifications = ref([]);
const openMenu = ref(null);
const pagination = ref({});
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const modalshow = ref(false);
const record = ref({});
const from = ref('');
const to = ref('');
const loading = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('general.notification.index'), {
            params: {
                page: page,
                search: search.value,
                from: from.value,
                to: to.value
            }
        });
        notifications.value = response.data.data ?? [];
        pagination.value = response.data.meta ?? {};
    }catch(error){
        console.log(error?.response);
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
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
function handleopenshow(data){
    record.value = data;
    modalshow.value = true;
}
function handlescloseshow(){
    record.value = {};
    modalshow.value = false;
}

function handlesuccesscreate(data){
    modalcreate.value = false;
    notifications.value.unshift(data);
    succes('Success', 'The new notification was successfully added.')
    get()
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', 'notification has been successfully updated.')
    record.value = {}
    get()
}
function handlesuccessdelete(){
    modaldelete.value = false;
    succes('Success', 'notification has been successfully updated.')
    record.value = {}
    get()
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
onMounted(()=>{
    get()
    count.start(props?.total);
    document.addEventListener('click', handleClickOutside);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
})
</script>

<template>
    <Head title="Notification" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Notification</h1>
        </template>

        <div data-aos="fade-up" class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-800 via-sky-900 to-sky-600 p-4 shadow-lg sm:p-6 lg:p-8">
            <div class="pointer-events-none absolute -right-16 -top-16 h-56 w-56 rounded-full bg-white/10 sm:h-72 sm:w-72"/>
            <div class="relative flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                <div data-aos="fade-right" data-aos-delay="100" class="max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1 text-[10px] font-semibold uppercase tracking-wider text-sky-100 sm:text-xs">
                        <span class="h-1.5 w-1.5 rounded-full bg-sky-300"/>
                        Management Notification
                    </span>
                    <h1 class="mt-3 text-xl font-bold text-white sm:text-2xl lg:text-3xl">
                        Notification &amp; Broadcast Center
                    </h1>
                    <p class="mt-2 text-xs text-sky-50/90 sm:text-sm">
                        Manage, send, and track the history of animal operations notifications, visitor promotions, and staff announcements for Bali Exotic Marine Park in one place.
                    </p>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <div data-aos="zoom-in" data-aos-delay="200" class="inline-flex items-center gap-1.5 rounded-lg bg-slate-900/40 px-2.5 py-1.5 text-xs font-medium text-sky-50 sm:text-xs">
                            <Send class="h-3.5 w-3.5 sm:h-4 sm:w-4"/>
                            {{ count.count }} Sent
                        </div>
                    </div>
                </div>

                <button data-aos="fade-left" data-aos-delay="200" type="button" @click="modalcreate = true" class="flex w-full shrink-0 items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-xs font-semibold text-sky-900 shadow-md transition hover:-translate-y-0.5 hover:shadow-xl sm:text-sm md:w-44 active:scale-95">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-sky-100 text-sky-600">
                        <Plus class="h-4 w-4"/>
                    </span>
                    Create New Notification
                </button>
            </div>
        </div>

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
            <div class="overflow-x-scroll bg-white mb-4">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-4">No</th>
                            <th scope="col" class="px-4 py-3">Author</th>
                            <th scope="col" class="px-4 py-3">Position</th>
                            <th scope="col" class="px-4 py-3">Date</th>
                            <th scope="col" class="px-4 py-3">Notification</th>
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
                            <template v-if="notifications.length > 0">
                                <tr v-for="(notif, index) in notifications" :key="notif?.id" class="border-b">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ (pagination.current_page - 1) * pagination.per_page + index + 1 }}</th>
                                    <td class="px-4 py-3">{{ notif?.name }}</td>
                                    <td class="px-4 py-3">{{ notif?.position }}</td>
                                    <td class="px-4 py-3">{{ formatDate(notif?.date) }}</td>
                                    <td class="px-4 py-3">{{ notif?.notification }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end relative">
                                        <button @click.stop="toggleMenu(notif?.id)" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div v-if="openMenu === notif?.id" @click.stop class="absolute right-13 bottom-0  z-[99] w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                            <ul class="py-1 text-sm">
                                                <li v-if="notif?.privillage">
                                                    <button @click="handleopenupdate(notif)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-yellow-50">
                                                        <SquarePen size="15" class="text-yellow-500" />
                                                        Update
                                                    </button>
                                                </li>
                                                <li>
                                                    <button @click="handleopenshow(notif)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-slate-50">
                                                        <Eye size="15" class="text-slate-500" />
                                                        Detail
                                                    </button>
                                                </li>
                                                <li v-if="notif?.privillage">
                                                    <button @click="handleopendelete(notif)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-red-50">
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
                                        <p class="text-center font-primary tex-md text-red-500">No Notification available.</p>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Notifications'" @next="next" @page="page" @prev="prev" />
        </section>
        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" />
        <Update v-if="modalupdate" @close="handlecloseupdate" :notification="record" @success="handlesuccessupdate" />
        <Show v-if="modalshow" @close="handlescloseshow" :notification="record" />
        <Delete v-if="modaldelete" @close="handlclosedelete" @success="handlesuccessdelete" :data="record" />
    </AuthenticatedLayout>
</template>