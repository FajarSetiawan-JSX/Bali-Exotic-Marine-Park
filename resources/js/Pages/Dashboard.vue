<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Bar, Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { Users, Flag, UsersRound } from 'lucide-vue-next';
import { onMounted, ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import LoadingCard from '@/Components/LoadingCard.vue';
import Card from '@/Components/Layout/Admin/Users/Card.vue';
import { eror } from '@/Helper/Toast';
import axios from 'axios';
import SearchAnimation from '@/Components/SearchAnimation.vue';
import { ArrowLeft, ChevronDown, ShieldCheck, Download, CalendarDays, BellOff } from 'lucide-vue-next'
import SearchLoad from '@/Components/SearchLoad.vue';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import { formatDateTime } from '@/Helper/FormatDateTime';

ChartJS.register( BarElement, ArcElement, CategoryScale, LinearScale, Tooltip, Legend)

const user = usePage().props?.auth;
const props = defineProps(['datalevel', 'label', 'data', 'user', 'divisions', 'notifications'])
const colors = [
    "#ef4444", // merah
    "#3b82f6", // biru
    "#22c55e", // hijau
    "#f59e0b", // kuning
    "#8b5cf6", // ungu
    "#06b6d4", // cyan
    "#ec4899", // pink
    "#14b8a6", // teal
    "#f97316", // orange
    "#84cc16", // lime
];
const backgroundColor = Array.from({ length: 12 }, () => {
    return colors[Math.floor(Math.random() * colors.length)];
});
const dataBar = ref({
    labels: user?.level == 1 ? ['Level 1', 'Level 2', 'Level 3'] : ['Host', 'Kitchen', 'Security'],
    datasets: [
        {
            label: user?.level == 1 ? "Total division" : "Total user",
            data: [],
            backgroundColor: backgroundColor,
            borderRadius: 0,
            borderSkipped: false,
            barThickness: 20
        }
    ]
})
const doughnutData = ref({
    labels: props?.label ?? [],
    datasets: [{
        label: "Total users",
        data: [],
        backgroundColor: backgroundColor,
        borderWidth: 2
    }]
})

const optionsBar = {
    responsive: true,
    maintainAspectRatio: false,

    animation: {
        duration: 1500,
        easing: 'easeOutQuart'
    },

    plugins: {
        legend: {
            display: false
        }
    },

    scales: {
        x: {
            grid: {
                display: false
            }
        },
        y: {
            beginAtZero: true
        }
    }
}
const doughnutOptions = {
    responsive: true,
    maintainAspectRatio: false,
    animation: {
        duration: 1500,
        easing: 'easeOutQuart'
    },
    cutout: '70%',
    plugins: {
        legend: {
            position: 'bottom'
        }
    }
}

const search = ref('');
const filterdivision = ref('');
const users = ref([]);
const loading = ref(false);
const pagination = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('user.index'),{
            params:{
                page: page,
                search: search.value,
                filter: filterdivision.value
            }
        })
        pagination.value = response?.data?.meta ?? {};
        users.value = response?.data?.data ?? [];
        console.log(response?.data?.data);
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
watch(() => filterdivision.value, (newfilter) => {
    if(newfilter != ''){
        return getusers();
    };
    return getusers();
});
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
const openId = ref(null);
const toggle = (id) => openId.value = openId.value === id ? null : id;

onMounted(()=>{
    if(user.api.includes('user.index')){
        get();
    }
    setTimeout(() => {
        dataBar.value = {
            ...dataBar.value,
            datasets: [{
                ...dataBar.value.datasets[0],
                data: user?.level == 1 ? props?.datalevel : [3,6,4]
            }
            ]
        }
        doughnutData.value = {
            ...doughnutData.value,
            datasets: [
                {
                    ...doughnutData.value.datasets[0],
                    data: props?.data ?? []
                }
            ]
        }
    }, 100);
})
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-second text-slate-800 text-lg font-semibold">
                Dashboard
            </h1>
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

        <template v-if="user?.level === 1">
            <section class="relative flex items-center h-80 overflow-hidden bg-[#F8FEFF]">
                <svg data-aos="zoom-in" data-aos-delay="100" data-aos-offset="0"
                    class="absolute bottom-0 w-full opacity-40"
                    viewBox="0 0 1440 320"
                    preserveAspectRatio="none">
                    <path
                        fill="#8ADFD8"
                        d="M0,224L80,213.3C160,203,320,181,480,176C640,171,800,181,960,202.7C1120,224,1280,256,1360,272L1440,288L1440,320L0,320Z">
                    </path>
                </svg>
                <svg data-aos="fade-up" data-aos-delay="200" data-aos-offset="0"
                    class="absolute bottom-0 w-full"
                    viewBox="0 0 1440 320"
                    preserveAspectRatio="none">

                    <path
                        fill="#55C9C7"
                        d="M0,192L80,202.7C160,213,320,235,480,218.7C640,203,800,149,960,144C1120,139,1280,181,1360,202.7L1440,224L1440,320L0,320Z">
                    </path>

                </svg>
                <div class="p-5 max-w-md z-10">
                    <p data-aos="fade-up" class="font-primary text-sm text-[#7B93A7]">System overview</p>
                    <h1 data-aos="fade-down" class="text-3xl font-semibold text-[#102A43]">Hello Administrator!</h1>
                    <p data-aos="zoom-in-down" class="text-[#526D82] text-lg">
                        Manage employees, divisions, schedules, and daily operations of
                        <span class="text-[#0EA5E9] font-exotic1 text-2xl font-semibold">Bali Exotic </span><span class="font-exotic2 text-black text-lg">Marine Park</span>
                        from one centralized dashboard.
                    </p>
                </div>
            </section>
            <section class="my-6 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                <div data-aos="zoom-in" data-aos-offset="0" class="font-second shadow-lg rounded-lg overflow-hidden bg-emerald-400 max-h-max">
                    <div class="p-3 bg-white ml-1 flex items-center gap-4 w-full rounded-lg">
                        <div class="p-2 rounded-lg bg-emerald-200">
                            <UsersRound size="30" class=" text-emerald-500" />
                        </div>
                        <div class="text-md">
                            <div>Total Division</div>
                            <div class="text-sm text-emerald-500">{{ props?.label?.length }}</div>
                        </div>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0" class="flex items-center gap-4 font-second shadow-lg p-3 rounded-lg">
                    <div class="p-2 rounded-lg bg-cyan-200">
                        <Users size="30" class=" text-cyan-500" />
                    </div>
                    <div class="text-lg">
                        <div>Total users</div>
                        <div class="text-sm text-cyan-500">{{ props?.user }}</div>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="600" data-aos-offset="0" class="flex items-center gap-4 font-second shadow-lg p-3 rounded-lg">
                    <div class="p-2 rounded-lg bg-teal-200">
                        <Users size="30" class=" text-teal-500" />
                    </div>
                    <div class="text-lg">
                        <div>Attachment</div>
                        <div class="text-sm text-teal-500">19 %</div>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="900" data-aos-offset="0" class="flex items-center gap-4 font-second shadow-lg p-3 rounded-lg">
                    <div class="p-2 rounded-lg bg-red-200">
                        <Flag size="30" class=" text-red-400" />
                    </div>
                    <div class="text-lg">
                        <div>Total Report</div>
                        <div class="text-sm text-red-500">12</div>
                    </div>
                </div>
            </section>
            <section class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="p-5 shadow-xl rounded-xl">
                    <h2 class="text-xl font-semibold font-second text-slate-900">Level's Division</h2>
                    <div class="h-80">
                        <Bar :data="dataBar" :options="optionsBar" />
                    </div>
                </div>
                <div class="p-5 shadow-xl rounded-xl">
                    <h2 class="text-xl font-semibold font-second text-slate-900">Division's User</h2>
                    <div class="h-80">
                        <Doughnut
                            :data="doughnutData"
                            :options="doughnutOptions"
                        />
                    </div>
                </div>
            </section>
        </template>
        <template v-else-if="user?.level === 2">
            <section class="my-5">
                <div class="border-l-3 border-sky-500 pl-3 w-full font-second">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Welcome, Supervisor!
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Here is a summary of your monitoring activities for today.
                    </p>
                </div>
            </section>
            <section class="my-5">
                <div class="bg-white rounded-lg p-3 shadow-lg">
                    <h1 class="font-second text-lg">Users Division</h1>
                    <Bar :data="dataBar" :options="optionsBar" class="max-h-80" />
                </div>
            </section>
            <section class="my-5">
                <div class="flex items-center md:justify-between justify-end bg-white p-3 my-5 border-1 border-slate-200">
                    <SearchLoad v-model="search" class="w-sm hidden md:block" />
                    <div class="flex items-center justify-start gap-x-2">
                        <vSelect v-model="filterdivision" :options="props.divisions" label="nama" class="division-select" placeholder="All Division" />
                    </div>
                </div>
                <div class="my-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-1.5 sm:gap-3 md:gap-5">
                    <template v-if="!loading">
                        <template v-if="users.length > 0">
                            <Card v-for="user in users" :key="user.id" :user="user" />
                        </template>
                        <template>
                            <div class="my-3">
                                <h1>0 data users</h1>
                            </div>
                        </template>
                    </template>
                    <template v-else>
                        <LoadingCard />
                    </template>
                </div>
                <PaginationNumber :pagination="pagination" :name="'Users'" @next="next" @page="page" @prev="prev" />
            </section>
        </template>
        <template v-else-if="user?.level === 3">
            <section>
                <div class="w-full rounded-xl bg-[#0b1d35] p-4 sm:p-5 text-white shadow-sm">
                    <h2 class="text-2xl font-bold">
                        Welcome to Division<br />
                        Dashboard
                    </h2>
                    <p class="mt-2 max-w-2xl text-sm sm:text-xs leading-[1.4] text-blue-300">
                        Manage your workforce efficiently. Track schedules, monitor security
                        alerts, and oversee daily operations from one central hub.
                    </p>
                </div>
            </section>
            <template v-if="user?.api?.includes('user.index')">
                <section class="my-5">
                    <div class="flex items-center md:justify-between justify-end bg-white p-3 my-5 border-1 border-slate-200">
                        <SearchLoad v-model="search" class="w-sm hidden md:block" />
                        <div class="flex items-center justify-start gap-x-2">
                            <vSelect v-model="filterdivision" :options="props.divisions" label="nama" class="division-select" placeholder="All Division" />
                            
                        </div>
                    </div>

                    <div class="my-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-1.5 sm:gap-3 md:gap-5">
                        <template v-if="!loading">
                            <template v-if="users.length > 0">
                                <Card v-for="user in users" :key="user.id" :user="user" />
                            </template>
                            <template>
                                <div class="my-3">
                                    <h1>0 data users</h1>
                                </div>
                            </template>
                        </template>
                        <template v-else>
                            <LoadingCard />
                        </template>
                    </div>
                    <PaginationNumber :pagination="pagination" :name="'Users'" @next="next" @page="page" @prev="prev" />
                </section>
            </template>
            <template v-if="!user?.api?.includes('specific.notification.store')">
                <section class="my-5 font-second">
                    <h4 class="text-2xl font-semibold">latest notification</h4>
                    <p class="text-sm md:text-md text-slate-500">Monitor the latest notifications from division heads, HR Admins, and Super Admins to stay informed about broadcasted information.</p>
                </section>
                <div class="w-full space-y-3 font-second">
                    <template v-if="props?.notifications?.length > 0">
                        <div v-for="(n, index) in props?.notifications" class="w-full rounded-2xl border border-slate-200 bg-white shadow-sm">
                            <div class="flex items-center gap-x-3 p-3 md:p-4">
                                <div class="relative shrink-0">
                                    <img :src="n?.avatar ? `storage/${n?.avatar}` : `https://ui-avatars.com/api/?background=2DD4BF&color=fff&name=${n?.name}`" alt="" class="rounded-full size-10 md:size-12 object-cover">
                                    <span class="absolute bottom-0 right-0 size-3 rounded-full border-2 border-white bg-emerald-500"></span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                                        <h3 class="text-sm font-bold text-slate-900">{{ n?.name }}</h3>
                                        <span class="rounded-md bg-slate-100 px-2 py-0.5 text-xs text-slate-600">{{ n?.position }}</span>
                                        <span class="hidden md:inline text-xs text-slate-400">• 10 mnt lalu</span>
                                    </div>
                                    <span class="hidden md:flex items-center gap-x-1 rounded-md bg-sky-50 px-2 py-0.5 text-xs font-medium text-sky-700 max-w-max my-1"><ShieldCheck class="size-3.5" />{{ n?.division }}</span>
                                </div>
                                <button type="button" @click="toggle(index)" class="flex shrink-0 items-center gap-x-1.5 rounded-xl bg-slate-100 p-2 md:px-3 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                                    <span class="hidden md:inline">{{ openId === index ? 'Minimize' : 'Maximize' }}</span>
                                    <ChevronDown class="size-4 md:size-5 transition-transform duration-300" :class="openId === index && 'rotate-180'" />
                                </button>
                            </div>
                            <transition enter-active-class="transition-all duration-300 ease-out overflow-hidden" enter-from-class="max-h-0 opacity-0" enter-to-class="max-h-[600px] opacity-100" leave-active-class="transition-all duration-200 ease-in overflow-hidden" leave-from-class="max-h-[600px] opacity-100" leave-to-class="max-h-0 opacity-0">
                                <div v-if="openId === index">
                                    <div class="space-y-3 border-t border-slate-200 p-3 md:p-4">
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-y-1 text-xs text-slate-500">
                                            <p>Detail Notification</p>
                                        </div>
                                        <p class="text-sm leading-relaxed text-slate-700">{{ n?.notification }}</p>
                                        <template v-if="n?.img">
                                            <p class="pt-1 text-xs font-semibold uppercase tracking-wide text-slate-400">Photo</p>
                                            <div class="flex max-w-max items-center gap-x-3 rounded-xl border border-slate-200 p-2.5 mx-auto">
                                                <img :src="`storage/${n?.img}`" alt="" class="size-60 md:size-96 shrink-0 rounded-lg object-cover">
                                            </div>
                                        </template>
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-y-3 border-t border-slate-200 pt-3">
                                            <p class="text-xs text-slate-500 flex items-center justify-start gap-x-2.5"><CalendarDays size="17" />{{ formatDateTime(n?.date) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </transition>
                        </div>
                    </template>
                    <template v-else>
                        <h1 class="text-md text-slate-500 flex items-center justify-center gap-x-2"><BellOff size="15" />No notification available</h1>
                    </template>
                </div>
            </template>
        </template>
        <template v-else>

        </template>
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
