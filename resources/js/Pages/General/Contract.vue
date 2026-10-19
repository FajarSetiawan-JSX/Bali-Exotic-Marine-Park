<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch, onBeforeUnmount } from 'vue';
import axios from 'axios';
import { eror, succes } from '@/Helper/Toast';
import SearchAnimation from '@/Components/SearchAnimation.vue';
import { FileText, Check, SquarePen, ArrowLeft, Pen, Eye, EyeOff, ShieldX, Trash, Sheet, LucideSheet } from 'lucide-vue-next';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import { usePage } from '@inertiajs/vue3';
import Additional from '@/Components/Layout/Admin/Users/Additional.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import CreateContract from '@/Components/Layout/Admin/Users/CreateContract.vue';
import UpdateContract from '@/Components/Layout/Admin/Users/UpdateContract.vue';
import DeleteContract from '@/Components/Layout/Admin/Users/DeleteContract.vue';
import { formatDate } from '@/Helper/FormatDate';
import FullScreenLoading from '@/Components/FullScreenLoading.vue';

const data = usePage().props?.auth;
const props = defineProps(['user', 'contracts']);
const user = ref({});
const search = ref('');
const contracts = ref([]);
const loading = ref(false);
const loadingfullscreen = ref(false);
const pagination = ref({});
const modaladditional = ref(false);
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const openMenu = ref(null);
const record = ref({});
const shownik = ref(false);
const showbpjskes = ref(false);
const showbpjsker = ref(false);
const showbank = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('user.contract.index', props?.user?.id),{
            params: {
                page: page,
                search: search.value,
            }
        });
        contracts.value = response?.data?.data ?? [];
        pagination.value = response?.data?.meta ?? {};
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
async function pdf() {
    try{
        loadingfullscreen.value = true;
        const response = await axios.get(route('user.download.pdf', props?.user?.id), {
            responseType: 'blob'
        });
        const url = URL.createObjectURL(response.data);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'user.pdf';
        document.body.appendChild(link);
        link.click();
        link.remove();
        URL.revokeObjectURL(url);
    }catch(error){
        const data = JSON.parse(await error.response.data.text());
        eror(error?.response?.status, data?.message);
    }finally{
        loadingfullscreen.value = false;
    }
}
async function excel() {
    loadingfullscreen.value = true;
    setTimeout(()=>{
        loadingfullscreen.value = false;
    }, 2000);
    // try{

    // }catch(error){

    // }finally{
        
    // }
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

//FUNCTION EMIT CRUD
function handlesuccess(data){
    modaladditional.value = false;
    succes('Success', 'Success change additional information.');
    user.value.bank = data?.bank;
    user.value.health = data?.health;
    user.value.work = data?.work;
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
    contracts.value.unshift(data);
    succes('Success', 'New contract was successfully added.')
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', 'contract has been successfully updated.')
    record.value = {}
    get()
}
function handlesuccessdelete(){
    modaldelete.value = false;
    succes('Success', 'contract has been successfully deleted.')
    record.value = {}
    get()
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
watch(() => search.value, (newfilter) => {
    setTimeout(() => {
        get();
    }, 500);
}, {immediate:true});

onMounted(()=>{
    user.value = props?.user;
    get();
    document.addEventListener('click', handleClickOutside);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
})
</script>

<template>
    <Head title="Contract User" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Contract User</h1>
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
            <div class="w-full overflow-hidden rounded-2xl border border-slate-200 border-t-4 border-t-sky-500 bg-white p-4 shadow-sm sm:p-6 lg:p-8 font-second">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4 sm:gap-5">
                        <img  :src="user?.profile ? `/storage/${user?.profile}` :`https://ui-avatars.com/api/?background=2DD4BF&color=fff&name=${user?.name}`"  class="size-20 sm:size-28 rounded-xl object-cover shadow-sm">
                        <div class="min-w-0">
                            <p class="text-xs font-semibold tracking-widest text-slate-500">User Information Career</p>
                            <h2 class="text-xl font-bold text-slate-900 sm:text-2xl lg:text-3xl">{{ user?.name }}</h2>
                            <p class="text-sm text-slate-500 sm:text-base">{{ user?.division }}</p>
                            <span class="mt-2 inline-flex items-center gap-1.5 rounded-lg bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-800 sm:text-sm">
                                {{ user?.position }}
                            </span>
                        </div>
                    </div>
                    <div class="border-t border-slate-200 pt-3 sm:border-l sm:border-t-0 sm:pl-6 sm:pt-0 sm:text-right">
                        <p class="text-xs text-slate-500 sm:text-sm">Joined at</p>
                        <p class="text-xs text-slate-500 sm:text-sm">{{ formatDate(user?.join) }}</p>
                    </div>
                </div>
                <dl class="mt-6 grid grid-cols-1 gap-4 border-t border-slate-200 pt-6 min-[480px]:grid-cols-2 lg:grid-cols-4 [&_dt]:text-xs [&_dt]:font-semibold [&_dt]:text-slate-500 sm:[&_dt]:text-sm [&_dd]:mt-1 [&_dd]:break-words [&_dd]:text-sm [&_dd]:font-bold [&_dd]:text-slate-900 sm:[&_dd]:text-base">
                    <div>
                        <dt>ID</dt>
                        <dd class="flex items-center justify-between">
                            <template v-if="shownik">
                                <span>
                                    {{ user?.nik ?? 'Unknow'}}
                                </span>
                            </template>
                            <template v-else>
                                <span class="text-slate-500">
                                    ****************
                                </span>
                            </template>
                            <button type="button" @click="shownik = !shownik" class="max-w-max max-h-max">
                                <Eye v-if="!shownik" size="15" />
                                <EyeOff v-else size="15" />
                            </button>
                        </dd>
                    </div>
                    <div>
                        <dt>Division</dt>
                        <dd>{{ user?.division }}</dd>
                    </div>
                    <div>
                        <dt>Position</dt>
                        <dd>{{ user?.position }}</dd>
                    </div>
                    <div>
                        <dt>Health Social Security Agency ID</dt>
                        <dd class="flex items-center justify-between">
                            <template v-if="showbpjskes">
                                <span>
                                    {{ user?.health ?? 'Unknow' }}
                                </span>
                            </template>
                            <template v-else>
                                <span class="text-slate-500">
                                    *************
                                </span>
                            </template>
                            <button type="button" @click="showbpjskes = !showbpjskes" class="max-w-max max-h-max">
                                <Eye v-if="!showbpjskes" size="15" />
                                <EyeOff v-else size="15" />
                            </button>
                        </dd>
                    </div>
                    <div>
                        <dt>Employment Social Security Agency ID</dt>
                        <dd class="flex items-center justify-between">
                            <template v-if="showbpjsker">
                                <span>
                                    {{ user?.work ?? 'Unknow' }}
                                </span>
                            </template>
                            <template v-else>
                                <span class="text-slate-500">
                                    ***********
                                </span>
                            </template>
                            <button type="button" @click="showbpjsker = !showbpjsker" class="max-w-max max-h-max">
                                <Eye v-if="!showbpjsker" size="15" />
                                <EyeOff v-else size="15" />
                            </button>
                        </dd>
                    </div>
                    <div>
                        <dt>Bank Account Number</dt>
                        <dd class="flex items-center justify-between">
                            <template v-if="showbank">
                                <span>
                                    {{ user?.bank ?? 'Unknow' }}
                                </span>
                            </template>
                            <template v-else>
                                <span class="text-slate-500">
                                    ***************
                                </span>
                            </template>
                            <button type="button" @click="showbank = !showbank" class="max-w-max max-h-max">
                                <Eye v-if="!showbank" size="15" />
                                <EyeOff v-else size="15" />
                            </button>
                        </dd>
                    </div>
                    <div>
                        <dt>Total Contract</dt>
                        <dd>{{ user?.contract }} contract</dd>
                    </div>
                </dl>
                <div v-if="data.api.includes('super.admin.user.update.additional')" class="my-2">
                    <button type="button" @click="modaladditional = true" class="w-full flex items-center justify-center gap-x-2 bg-emerald-400 text-white py-1.5 rounded-md font-second text-sm hover:bg-emerald-500 active:scale-95 transition-all duration-300">
                        <Pen size="15" />
                        Change Additional Information
                    </button>
                </div>
                <div v-if="data.api.includes('user.download.pdf')" class="my-2">
                    <form action="" @submit.prevent="pdf">
                        <button type="submit" class="w-full flex items-center justify-center gap-x-2 bg-rose-400 text-white py-1.5 rounded-md font-second text-sm hover:bg-rose-500 active:scale-95 transition-all duration-300">
                            <FileText size="15" />
                            Download PDF
                        </button>
                    </form>
                </div>
                <div v-if="data.api.includes('user.download.pdf')" class="my-2">
                    <form action="" @submit.prevent="excel">
                        <button type="submit" class="w-full flex items-center justify-center gap-x-2 bg-green-400 text-white py-1.5 rounded-md font-second text-sm hover:bg-green-500 active:scale-95 transition-all duration-300">
                            <Sheet size="15" />
                            Download .xlsx
                        </button>
                    </form>
                </div>
                <div v-if="user?.last" class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 p-4 sm:gap-4">
                    <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-sky-100 text-sky-800 sm:size-12">
                        <FileText class="size-5 sm:size-6" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-slate-500">Last contract</p>
                        <p class="truncate text-sm font-bold text-slate-900 sm:text-sm lg:text-lg">{{ user?.last?.contract }}</p>
                        <p class="text-xs text-slate-400 sm:text-sm">{{ formatDate(user?.last?.in) }} – {{ formatDate(user?.last?.expired) }}</p>
                    </div>
                    <template v-if="user?.last?.status">
                        <span class="inline-flex shrink-0 items-center gap-1 rounded-lg bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-800 sm:text-sm">
                            <Check class="size-4" /> Active
                        </span>
                    </template>
                    <template v-else>
                        <span class="inline-flex shrink-0 items-center gap-1 rounded-lg bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-800 sm:text-sm">
                            <ShieldX class="size 4" /> Expired
                        </span>
                    </template>
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
                <div v-if="data.api.includes('user.contract.store')">
                    <button type="button" @click="modalcreate = true" class="flex items-center justify-center text-white bg-thrid-admin hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 gap-x-1.5 active:scale-95 transition-all duration-100">
                        <svg width="18px" height="18px" viewBox="0 0 24 24" id="plus" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color fill-current"><path id="primary" d="M12,20a1,1,0,0,1-1-1V13H5a1,1,0,0,1,0-2h6V5a1,1,0,0,1,2,0v6h6a1,1,0,0,1,0,2H13v6A1,1,0,0,1,12,20Z"></path></svg>
                        <p>
                            Add Contract
                        </p>
                    </button>
                </div>
            </div>
            <div class="overflow-x-scroll bg-white mb-4">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-4">No</th>
                            <th scope="col" class="px-4 py-3">Contract</th>
                            <th scope="col" class="px-4 py-3">Duration</th>
                            <th scope="col" class="px-4 py-3">Start</th>
                            <th scope="col" class="px-4 py-3">Expired</th>
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
                            <template v-if="contracts.length > 0">
                                <tr v-for="(contract, index) in contracts" :key="program?.id" class="border-b">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ (pagination.current_page - 1) * pagination.per_page + index + 1 }}</th>
                                    <td class="px-4 py-3">{{ contract?.name }}</td>
                                    <td class="px-4 py-3">{{ contract?.duration }} Months</td>
                                    <td class="px-4 py-3">{{ formatDate(contract?.in) }}</td>
                                    <td class="px-4 py-3">{{ formatDate(contract?.expired) }}</td>
                                    <td v-if="data.api.includes('user.contract.update') || data.api.includes('user.contract.delete')" class="px-4 py-3 flex items-center justify-end relative">
                                        <button @click.stop="toggleMenu(contract?.id)" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div v-if="openMenu === contract?.id" @click.stop class="absolute right-13 bottom-0  z-[99] w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                            <ul class="py-1 text-sm">
                                                <li>
                                                    <button @click="handleopenupdate(contract)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-yellow-50">
                                                        <SquarePen size="15" class="text-yellow-500" />
                                                        Update
                                                    </button>
                                                </li>
                                                <li>
                                                    <button @click="handleopendelete(contract)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-red-50">
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
                                        <p class="text-center font-primary tex-md text-red-500">No contracts available</p>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </section>
        
        <PaginationNumber :pagination="pagination" :name="'Contracts'" @next="next" @page="page" @prev="prev" />

        <Additional v-if="modaladditional" @close="modaladditional = false" @success="handlesuccess" :user="user" />
        <CreateContract v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" :user="user" :contracts="props?.contracts" />
        <UpdateContract v-if="modalupdate" @close="handlecloseupdate" @success="handlesuccessupdate" :contract="record" :contracts="props?.contracts" />
        <DeleteContract v-if="modaldelete" @close="handlclosedelete" @success="handlesuccessdelete" :contract="record" :contracts="props?.contracts" />

        <FullScreenLoading v-if="loadingfullscreen">
            <LoadingPrimary />
        </FullScreenLoading>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Container utama */
:deep(.division-select) {
    width: auto;
    min-width: 180px;
}

/* Tombol select */
:deep(.division-select .vs__dropdown-toggle) {
    background-color: var(--color-primary-admin, #f8fafc);
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    min-height: 42px;

    display: flex;
    align-items: center;

    padding: 0.5rem 1rem;
}

/* Input search */
:deep(.division-select .vs__search) {
    margin: 0;
    padding: 0;
}

/* Hilangkan aneh-aneh */
:deep(.division-select .vs__selected-options) {
    padding: 0;
}

/* Panah */
:deep(.division-select .vs__actions) {
    padding-left: 8px;
}

:deep(.division-select .vs__open-indicator) {
    fill: #6b7280;
}

/* Dropdown */
:deep(.division-select .vs__dropdown-menu) {
    width: 100% !important;
    min-width: 100% !important;

    left: 0;
    margin-top: 6px;

    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0 10px 15px rgb(0 0 0 / 0.1);
}

/* Item */
:deep(.division-select .vs__dropdown-option) {
    padding: 10px 16px;
}

:deep(.division-select .vs__dropdown-option--highlight) {
    background: #f3f4f6;
    color: #111827;
}
</style>