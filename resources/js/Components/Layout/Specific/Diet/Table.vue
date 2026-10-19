<script setup>
import { onBeforeUnmount, onMounted, watch } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import { ref } from 'vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import SearchAnimation from '@/Components/SearchAnimation.vue';
import { ArrowLeft, Funnel, RotateCcw, SquarePen, Trash, Eye, Check, FileUser } from 'lucide-vue-next';
import LoadingPrimary from '../../LoadingPrimary.vue';
import { formatDate } from '@/Helper/FormatDate';
import { usePage } from '@inertiajs/vue3';
import Preview from './Preview.vue';
import Approve from './Approve.vue';
import Update from './Update.vue';
import Execute from './Execute.vue';

const user = usePage().props?.auth;
const props = defineProps(['basic', 'mamals']);
const openMenu = ref(null);
const search = ref('');
const pagination = ref({});
const diets = ref([]);
const from = ref('');
const to = ref('');
const loading = ref(false);
const modalshow = ref(false);
const modalapprove = ref(false);
const modalupdate = ref(false);
const modalexecute = ref(false);
const record = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('specific.diet.index'), {
            params: {
                page: page,
                search: search.value,
                from: from.value,
                to: to.value
            }
        });
        diets.value = response?.data?.data ?? [];
        pagination.value = response?.data?.meta ?? {};
        console.log(diets?.value)
    }catch(error){
        console.log(error?.response);
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
function handleopenshow(data){
    record.value = data;
    modalshow.value = true;
}
function handleopenapprove(data){
    record.value = data;
    modalapprove.value = true;
}
function handlecloseshow(){
    record.value = {};
    modalshow.value = false;
}
function handlecloseapprove(){
    record.value = {};
    modalapprove.value = false;
}
function handlesuccessaprove(data){
    record.value = {};
    modalapprove.value = false;
    get();
}
function handleopenupdate(data){
    record.value = data;
    modalupdate.value = true;
}
function handlecloseupdate(){
    record.value = {};
    modalupdate.value = false;
}
function handlesuccessupdate(){
    record.value = {};
    modalupdate.value = false;
    get();
}
function handleopenexecute(data){
    record.value = data;
    modalexecute.value = true;
}
function handlecloseexecute(){
    record.value = {};
    modalexecute.value = false;
}
function handlesuccessexecute(){
    record.value = {};
    modalexecute.value = false;
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
    document.addEventListener('click', handleClickOutside);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
})
</script>

<template>
    <section class="my-3.5 relative overflow-visible">
        <div class="flex items-center justify-between flex-wrap gap-3 bg-white p-3 rounded-t-lg">
            <div v-if="!props?.basic" class="flex items-center justify-start gap-x-3">
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
            <form v-if="!props?.basic" action="" @submit.prevent="filter" class="flex items-center justify-start gap-x-2 flex-wrap font-second">
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
                        <th scope="col" class="px-4 py-3">Mamal</th>
                        <th scope="col" class="px-4 py-3">Officer</th>
                        <th scope="col" class="px-4 py-3">Date</th>
                        <th scope="col" class="px-4 py-3">Approval</th>
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
                        <template v-if="diets.length > 0">
                            <tr v-for="(diet, index) in diets" :key="diet?.id" class="border-b">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ (pagination.current_page - 1) * pagination.per_page + index + 1 }}</th>
                                <td class="px-4 py-3">{{ diet?.mamal }}</td>
                                <td class="px-4 py-3">{{ diet?.officer }}</td>
                                <td class="px-4 py-3">{{ formatDate(diet?.date) }}</td>
                                <td class="px-4 py-3" :class="diet?.approval ? 'text-emerald-500' : 'text-rose-500'">{{ diet?.approval ? 'Approved' : 'Waiting Approval' }}</td>
                                <td class="px-4 py-3 flex items-center justify-end relative">
                                    <button @click.stop="toggleMenu(diet?.id)" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div v-if="openMenu === diet?.id" @click.stop class="absolute right-13 bottom-0  z-[999] w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm">
                                            <li v-if="user?.api?.includes('specific.diet.approve') && props?.basic">
                                                <button @click="handleopenapprove(diet)" type="button" :disabled="diet.approval" :class="diet.approval ? 'cursor-not-allowed opacity-50' : 'cursor-pointer opacity-100'" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-emerald-50">
                                                    <Check size="15" class="text-emerald-500" />
                                                    {{ diet.approval == 'Waiting approval' ? 'Approve' : 'Approved' }}
                                                </button>
                                            </li>
                                            <li v-if="user?.api?.includes('specific.diet.execute')">
                                                <button @click="handleopenexecute(diet)" type="button" :disabled="!diet.allow" :class="!diet.allow ? 'cursor-not-allowed opacity-50' : 'cursor-pointer opacity-100'" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-yellow-50">
                                                    <FileUser size="15" class="text-yellow-500" />
                                                    Execute
                                                </button>
                                            </li>
                                            <li v-if="user?.api?.includes('specific.diet.update')">
                                                <button @click="handleopenupdate(diet)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-slate-50">
                                                    <SquarePen size="15" class="text-slate-500" />
                                                    Update
                                                </button>
                                            </li>
                                            <li>
                                                <button @click="handleopenshow(diet)" type="button" class="flex w-full items-center gap-x-2 py-2 px-4 text-gray-700 hover:bg-sky-50">
                                                    <Eye size="15" class="text-sky-500" />
                                                    Preview
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
                                    <p class="text-center font-primary tex-md text-red-500">No Diets plan available.</p>
                                </td>
                            </tr>
                        </template>
                    </template>
                </tbody>
            </table>
        </div>
    </section>

    <section class="mt-6">
        <PaginationNumber :pagination="pagination" :name="'Diets'" @next="next" @page="page" @prev="prev" />
    </section>

    <Preview v-if="modalshow" :diet="record" @close="handlecloseshow" />
    <Update v-if="modalupdate" :diet="record" :mamals="props?.mamals" @close="handlecloseupdate" @success="handlesuccessupdate" />
    <Approve v-if="modalapprove" :diet="record" :basic="props?.basic" @close="handlecloseapprove" @success="handlesuccessaprove" />
    <Execute v-if="modalexecute" :diet="record" :basic="props?.basic" @close="handlecloseexecute" @success="handlesuccessexecute" />
</template>