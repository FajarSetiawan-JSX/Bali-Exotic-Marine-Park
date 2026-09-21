<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { ArrowLeft, ClipboardList, TriangleAlert, ShieldCheck, CircleCheck, Info, Plus} from 'lucide-vue-next';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import Create from '@/Components/Layout/Specific/Security/Patrol/Create.vue';
import { onBeforeUnmount } from 'vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import Menu from '@/Components/Menu.vue';
import { formatTime } from '@/Helper/FormatTime';

const user = usePage().props?.auth;
const props = defineProps(['basics']);
const modalcreate = ref(false);
const openMenu = ref(null);
const pagination = ref({});

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
        pagination.value = response.data.meta ?? {};
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
function handlesuccesscreate (){
    modalcreate = false;
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
})
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
    <Head title="Patrols" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Patrol</h1>
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
        <section class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 font-primary">
            <div class="w-full rounded-xl border border-slate-200 border-t-[3px] border-t-blue-500 bg-white p-4 shadow-sm font-second">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-400">
                            Total Patrol Today
                        </p>

                        <div class="mt-1 flex items-baseline gap-2">
                            <span class="text-xl font-bold text-slate-900">
                                14
                            </span>

                            <span class="text-sm font-medium text-slate-500">
                                Patrol Routine
                            </span>
                        </div>
                    </div>
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-cyan-50 text-cyan-500">
                        <ClipboardList :size="15" :stroke-width="2" />
                    </div>
                </div>
                <div class="my-3 border-t border-slate-100"/>

                <div class="flex flex-wrap gap-2">
                    <span class="rounded-md border border-emerald-100 bg-emerald-50 px-2 py-1 text-[9px] font-semibold text-emerald-600">
                        ✓ 12 Done
                    </span>

                    <span class="rounded-md border border-blue-100 bg-blue-50 px-2 py-1 text-[9px] font-semibold text-blue-600">
                        2 Coming up
                    </span>
                </div>
            </div>

            <div class="w-full rounded-xl border border-slate-200 border-t-[3px] border-t-rose-500 bg-white p-4 shadow-sm font-second">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-400">
                            Total Incident
                        </p>

                        <div class="mt-1 flex items-baseline gap-2">
                            <span class="text-xl font-bold text-rose-500">
                                3
                            </span>
                        </div>
                    </div>

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-rose-50 text-rose-500">
                        <TriangleAlert :size="15" :stroke-width="2" />
                    </div>
                </div>
                <div class="my-3 border-t border-slate-100"/>
                <!-- <div class="grid grid-cols-2 gap-2">
                    <div class="rounded-md border border-rose-100 bg-rose-50 px-2 py-1.5">
                        <p class="text-sm font-bold text-rose-600">
                            • 1 Kritis
                        </p>

                        <p class="text-sm font-medium leading-tight text-rose-500">
                            (Jaring Enclosure)
                        </p>
                    </div>

                    <div class="rounded-md border border-orange-100 bg-orange-50 px-2 py-1.5">
                        <p class="text-sm font-bold text-orange-600">
                            2 Ringan
                        </p>

                        <p class="text-sm font-medium text-orange-500">
                            Ditangani
                        </p>
                    </div>
                </div> -->
            </div>

            <div class="w-full rounded-xl border border-slate-200 border-t-[3px] border-t-teal-400 bg-white p-4 shadow-sm font-second">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-400">
                            Security Index Today
                        </p>

                        <div class="mt-1 flex items-baseline gap-2">
                            <span class="text-xl font-bold text-emerald-600">
                                98.4%
                            </span>

                            <span class="text-sm font-medium text-emerald-600">
                                Good
                            </span>
                        </div>
                    </div>
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-500">
                        <ShieldCheck :size="15" :stroke-width="2" />
                    </div>
                </div>
                <div class="my-3 border-t border-slate-100"/>
            </div>
        </section>

        <section v-for="(basic, index) in props.basics" :key="index" class="w-full rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5 lg:p-6 my-5">
            <div class="flex flex-col gap-4 border-b border-slate-100 pb-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex min-w-0 items-start gap-3">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-cyan-100 bg-cyan-50 text-cyan-500">
                        <Info :size="17" :stroke-width="2" />
                    </div>
                    <div class="min-w-0 font-second">
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 class="text-sm font-bold uppercase tracking-wide text-slate-800">
                                Basic Information
                            </h2>
                        </div>
                        <p  class="mt-0.5 text-sm leading-relaxed text-slate-400">
                            Matriks parameter operasional pengamanan, progress
                            patrol posko, deteksi insiden, dan proteksi barrier.
                        </p>
                    </div>
                </div>
                <Menu :href="route('security.daily.patrol.create', basic?.id)" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-emerald-400 px-4 py-2.5 text-sm md:text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-emerald-500 active:scale-95 sm:w-auto">
                    <Plus class="h-3.5 w-3.5" />
                    Create Patrol
                </Menu>
            </div>
            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl border border-slate-200 bg-white p-3 shadow-sm">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-wide text-slate-400">
                                Date & Shift
                            </p>
                        </div>

                        <span v-if="basic?.today" class="rounded-md border border-cyan-100 bg-cyan-50 px-2 py-1 text-xs font-bold text-cyan-600">
                            TODAY
                        </span>
                    </div>
                    <div class="mt-3">
                        <p class="text-sm font-bold text-slate-800">
                            {{ basic?.date }}
                        </p>

                        <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-slate-400">
                            <span class="flex items-center gap-1">
                                <span class="h-1.5 w-1.5 rounded-full bg-cyan-500"/>
                                <span class="font-semibold text-slate-600">
                                    {{ basic?.work }}
                                </span>
                            </span>
                            <span>{{ formatTime(basic?.start) }} - {{ formatTime(basic?.end) }}</span>
                        </div>
                    </div>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-3 shadow-sm">
                    <div class="flex items-start justify-between gap-2">
                        <p class="text-sm font-bold uppercase tracking-wide text-slate-400">
                            Progress<br />
                            Patrol Area
                        </p>
                        <span class="inline-flex items-center gap-1 rounded-full border border-cyan-100 bg-cyan-50 px-2 py-1 text-xs font-bold text-cyan-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-cyan-500"/>
                            ON-GOING
                        </span>
                    </div>
                    <div class="mt-3">
                        <div class="flex items-end gap-1">
                            <span class="text-xl font-bold leading-none text-slate-800">
                                82%
                            </span>
                            <span class="pb-0.5 text-xs font-semibold text-cyan-500">
                                20 / {{ basic?.totalarea }} Area
                            </span>
                        </div>
                        <div class="mt-2 h-1.5 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full w-[82%] rounded-full bg-cyan-500"/>
                        </div>
                    </div>
                    <div class="my-3 border-t border-slate-100"/>
                    <div class="flex items-center justify-between gap-2 text-xs">
                        <span class="text-slate-400">
                            Zona Tercover
                        </span>
                        <span class="font-semibold text-cyan-600">
                            4 Titik Tersisa
                        </span>
                    </div>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-3 shadow-sm">
                    <div class="flex items-start justify-between gap-2">
                        <p class="text-sm font-bold uppercase tracking-wide text-slate-400">
                            Total Incident
                        </p>
                    </div>

                    <div class="mt-3 flex items-baseline gap-2">
                        <span
                            class="text-xl font-bold leading-none text-rose-500"
                        >
                            3
                        </span>

                        <span class="text-xs text-slate-400">
                            Incident today
                        </span>
                    </div>

                    <div class="mt-2 flex flex-wrap gap-1.5">
                        <span
                            class="rounded-md border border-rose-100 bg-rose-50 px-2 py-1 text-xs font-bold text-rose-500"
                        >
                            • 1 Kritis
                        </span>

                        <span
                            class="rounded-md border border-amber-100 bg-amber-50 px-2 py-1 text-xs font-bold text-amber-600"
                        >
                            2 Pemantauan
                        </span>
                    </div>

                    <div class="my-3 border-t border-slate-100"/>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-3 shadow-sm">
                    <div class="flex items-start justify-between gap-2">
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                            Level<br />
                            Security
                        </p>

                        <span class="inline-flex items-center gap-1 rounded-full border border-emerald-100 bg-emerald-50 px-2 py-1 text-xs font-bold text-emerald-600">
                            <CircleCheck :size="9" :stroke-width="3"/>
                            Good Condition
                        </span>
                    </div>

                    <div class="mt-3 flex items-baseline gap-2">
                        <span class="text-xl font-bold leading-none text-emerald-600">
                            98.4%
                        </span>

                        <span class="text-xs font-medium text-slate-500">
                            Security Index
                        </span>
                    </div>
                    <div class="my-3 border-t border-slate-100"/>
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
                            <th scope="col" class="px-4 py-3">Date</th>
                            <th scope="col" class="px-4 py-3">Area</th>
                            <th scope="col" class="px-4 py-3">Incident</th>
                            <th scope="col" class="px-4 py-3">Index</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <template v-if="loading">
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
                        </template> -->
                                <tr class="border-b">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">1</th>
                                    <td class="px-4 py-3">25-Ags</td>
                                    <td class="px-4 py-3">Pool</td>
                                    <td class="px-4 py-3">1</td>
                                    <td class="px-4 py-3">100%</td>
                                    <td class="px-4 py-3 flex items-center justify-end relative">
                                        <button @click.stop="toggleMenu(area?.id)" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <!-- <div v-if="openMenu === area?.id" @click.stop class="absolute right-13 bottom-0  z-[99] w-44 bg-white rounded divide-y divide-gray-100 shadow">
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
                                        </div> -->
                                    </td>
                                </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Patrols'" @next="next" @page="page" @prev="prev" />
        </section>

        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" />
    </AuthenticatedLayout>
</template>

